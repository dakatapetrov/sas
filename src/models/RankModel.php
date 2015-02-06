<?php

require __DIR__ . '/../../core/Model.php';

class RankModel extends Model
{

    public function getUniqueClasses()
    {
        $query = $this->dbConnection->query(
            'SELECT DISTINCT(class) FROM students'
        );

        $data = array();
        while ($line = $query->fetch_assoc()) {
            $data[(int)$line['class']] = $line['class'];
        }

        return $data;
    }

    public function getUniqueSpecialities()
    {
        $query = $this->dbConnection->query(
            'SELECT * FROM specialities'
        );

        $data = array();
        while ($line = $query->fetch_assoc()) {
            $data[$line['id']] = $line['name'];
        }

        return $data;
    }

    public function getIntervals($period)
    {
        $fromDate = new \DateTime('now', new DateTimeZone('Europe/Sofia'));
        $fromDate->modify('-1 ' . $period);
        $fromDate->setTime(0, 0, 0);

        $toDate = new \DateTime('now', new DateTimeZone('Europe/Sofia'));
        $toDate->setTime(0, 0, 0);

        return array('from' => $fromDate->format('Y-m-d H:i:s'), 'to' => $toDate->format('Y-m-d H:i:s'));
    }

    public function getBestStudents($class, $speciality, $interval)
    {
        $whereCondition = false;

        $sql = 'SELECT s.user_id, s.fn, s.flow, s.group, s.class, sp.name as speciality, u.first_name, u.last_name, SUM(points) as points
                FROM students_achievements AS sa
                INNER JOIN students AS s
                ON sa.student_id = s.user_id
                INNER JOIN users AS u
                ON s.user_id = u.id
                INNER JOIN specialities AS sp
                ON s.speciality_id = sp.id';

        if($class) {
            $whereCondition = true;
            $sql .= ' WHERE class='.$class;
        }

        if($speciality) {
            $whereCondition = true;
            $begining = $whereCondition ? ' AND' : ' WHERE';
            $sql .= $begining . ' speciality_id='.$speciality;
        }

        if($interval) {
            $intervals = $this->getIntervals($interval);
            $begining = $whereCondition ? ' AND' : ' WHERE';
            $sql .= $begining . ' sa.date >= "' . $intervals['from'] . '" AND sa.date <= "' . $intervals['to'] . '"';
        }

        $sql .= ' GROUP BY student_id ORDER BY SUM(points) DESC';

        $query = $this->dbConnection->query(
            $sql
        );

        var_dump($sql);

        $data = array();
        while ($line = $query->fetch_assoc()) {
            $student               = array();
            $student['id']         = $line['user_id'];
            $student['fn']         = $line['fn'];
            $student['flow']       = $line['flow'];
            $student['group']      = $line['group'];
            $student['class']      = $line['class'];
            $student['speciality'] = $line['speciality'];
            $student['name']       = $line['first_name'] . ' ' . $line['last_name'];
            $student['points']     = $line['points'];
            $data[] = $student;
        }

        return $data;
    }

    public function getUserInfo($id)
    {
        $id = $this->sanitize($id);

        $query = $this->dbConnection->query(
            'SELECT * FROM users u, students s
             WHERE u.id='.$id.' AND s.user_id='.$id
        );

        $data = $query->fetch_assoc();

        return $data;
    }

    public function findPointsForUser($id)
    {
        $sql = 'SELECT SUM(points) as points
                FROM students_achievements WHERE student_id='.$id;

        $query = $this->dbConnection->query(
            $sql
        );

        $data = $query->fetch_assoc();

        return $data['points'];
    }

    public function findPlaces($id)
    {
        $student = $this->getUserInfo($id);
        $points = $this->findPointsForUser($id);
        $result = array();

        //Class
        $sql = 'SELECT COUNT(DISTINCT(s.user_id)) as count
                FROM students_achievements AS sa
                INNER JOIN students AS s
                ON sa.student_id = s.user_id
                WHERE s.class="'.$student['class'] . '"
                GROUP BY user_id HAVING SUM(points) > '.$points;

        $query = $this->dbConnection->query($sql);

        $count = 0;
        if($query) {
            while ($line = $query->fetch_assoc()) {
                $count++;
            }

            $result['class']['before'] = $count;
        }

        $sql = 'SELECT COUNT(*) as count FROM students
                WHERE class="'.$student['class'].'"';

        $query = $this->dbConnection->query($sql);

        $count = 0;
        if($query) {
            $count = $query->fetch_assoc()['count'];

        }

        $result['class']['all'] = $count;

        //Flow
        $sql = 'SELECT COUNT(DISTINCT(s.user_id)) as count
                FROM students_achievements AS sa
                INNER JOIN students AS s
                ON sa.student_id = s.user_id
                WHERE s.class="'.$student['class'] . '"
                AND s.flow ="'.$student['flow'] . '"
                GROUP BY user_id HAVING SUM(points) > '.$points;

        $query = $this->dbConnection->query($sql);

        $count = 0;
        if($query) {
            while ($line = $query->fetch_assoc()) {
                $count++;
            }

            $result['flow']['before'] = $count;
        }

        $sql = 'SELECT COUNT(*) as count FROM students
                WHERE class="'.$student['class'].'" AND flow="' . $student['flow'] . '"';

        $query = $this->dbConnection->query($sql);

        $count = 0;
        if($query) {
            $count = $query->fetch_assoc()['count'];

        }

        $result['flow']['all'] = $count;

        //Groups
        /* $sql = 'SELECT COUNT(DISTINCT(s.user_id)) as count */
        /*         FROM students_achievements AS sa */
        /*         INNER JOIN students AS s */
        /*         ON sa.student_id = s.user_id */
        /*         WHERE s.class="'.$student['class'] . '" */
        /*         AND s.flow ="'.$student['flow'] . '" */
        /*         AND s.group ="'.$student['group'] . '" */
        /*         GROUP BY user_id HAVING SUM(points) > '.$points; */

        /* $query = $this->dbConnection->query($sql); */

        /* $count = 0; */
        /* if($query) { */
        /*     while ($line = $query->fetch_assoc()) { */
        /*         $count++; */
        /*     } */

        /*     $result['group']['before'] = $count; */
        /* } */

        /* $sql = 'SELECT COUNT(*) as count FROM students */
        /*         WHERE (class="'.$student['class'].'" AND group="' . $student['group'] . '" AND flow="' . $student['flow'] . '")'; */

        /* var_dump($sql); */

        /* $query = $this->dbConnection->query($sql); */

        /* echo $this->dbConnection->error; */
        /* die(); */


        /* $count = 0; */
        /* if($query) { */
        /*     $count = $query->fetch_assoc()['count']; */

        /* } */

        /* $result['group']['all'] = $count; */

        return $result;
    }
}
