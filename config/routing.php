<?php

$routes = array(
    'login' => array(
        'controller' => 'UserController',
        'method' => 'login'
    ),
    'logout' => array(
        'controller' => 'UserController',
        'method' => 'logout'
    ),
    'register' => array(
        'controller' => 'UserController',
        'method' => 'viewUser'
    ),
    'user' => array(
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
