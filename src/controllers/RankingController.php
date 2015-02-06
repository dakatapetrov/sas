<?php

class RankingController
{
    public function rank($criteria)
    {
        $students = array(1, 2 ,3);

        return View::getInstance()->render('ranking', array('criteria' => $criteria), array('students' => $students));
    }
}
