<?php

$routes = array(
    'login' => array(
        'controller' => 'LoginController',
        'method' => 'login'
    ),
    'register' => array(
        'controller' => 'UserController',
        'method' => 'viewUser'
    ),
    'ranking' => array(
        'controller' => 'RankingController',
        'method' => 'rank'
    ),
    'ranking-query' => array(
        'controller' => 'RankingController',
        'method' => 'rankQuery'
    ),
);
