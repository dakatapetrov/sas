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
            'SELECT DISTINCT(name) FROM specialities'
        );

        $data = array();
        while ($line = $query->fetch_assoc()) {
            $data[] = $line['name'];
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
