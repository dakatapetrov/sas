<?php

require  __DIR__ . '/../models/RankModel.php';

class RankingController
{
    public function rank($criteria)
    {
        $rankModel = new RankModel();
        $classes = $rankModel->getUniqueClasses();
        $specialities = $rankModel->getUniqueSpecialities();

        $students = array(1, 2 ,3);

        return View::getInstance()->render('ranking', array('criteria' => $criteria), array('students' => $students, 'classes' => $classes, 'specialities' => $specialities));
    }

    public function rankQuery($criteria)
    {
        $students = array(1);

        var_dump($_POST);
        die();

        return View::getInstance()->render('ranking', array('criteria' => $criteria), array('students' => $students));
    }
}
