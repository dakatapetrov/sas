<?php

require  __DIR__ . '/../models/RankModel.php';

class RankingController
{
    public function rank($criteria)
    {
        if($_POST) {
            if(isset($_POST['class']) && $_POST['class']) {
                $class = $_POST['class'];
            }

            if(isset($_POST['speciality']) && $_POST['speciality']) {
                $speciality = $_POST['speciality'];
            }

            if(isset($_POST['interval']) && $_POST['interval']) {
                $interval = $_POST['interval'];
            }
        }

        $rankModel = new RankModel();
        $classes = $rankModel->getUniqueClasses();
        $specialities = $rankModel->getUniqueSpecialities();
        $students = $rankModel->getBestStudents($class, $speciality, $interval);

        $places = array();
        foreach($students as $student) {
            $results[$student['id']] = $rankModel->findPlaces($student['id']);
        }

        return View::getInstance()->render('ranking', array('criteria' => $criteria), array('students' => $students, 'classes' => $classes, 'specialities' => $specialities, 'results' => $results));
    }

    public function rankQuery($criteria)
    {
        $students = array(1);

        var_dump($_POST);
        die();

        return View::getInstance()->render('ranking', array('criteria' => $criteria), array('students' => $students));
    }
}
