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

        $sql = 'SELECT s.user_id, s.fn, u.first_name, u.last_name, SUM(points) as points
                FROM students_achievements AS sa
                INNER JOIN students AS s
                ON sa.student_id = s.user_id
                INNER JOIN users AS u
                ON s.user_id = u.id';

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
            $student = array();
            $student['id'] = $line['user_id'];
            $student['fn'] = $line['fn'];
            $student['name'] = $line['first_name'] . ' ' . $line['last_name'];
            $student['points'] = $line['points'];
            $data[] = $student;
        }

        return $data;
    }

    public function getUserInfo($id)
    {
        $id = $this->sanitize($id);


        $query = $this->dbConnection->query(
            'SELECT * FROM users'
        );

        if ($query->num_rows != 1) {
            return array('success' => false, 'error' => array('no_record' => true));
        }

        $data = $query->fetch_assoc();

        $count_auctions = $this->dbConnection->query('
            SELECT COUNT(*) FROM auctions WHERE user_id='.$id
        );
        /* $count = $count_auctions->fetch_assoc(); */
        /* $count = $count['COUNT(*)']; */

        /* $data['auctions_count'] = $count; */

        return array('success' => true, 'data' => $data);
    }
}
