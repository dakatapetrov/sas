<?php

class Model
{
    private static $connection = null;
    protected $dbConnection = null;

    public function __construct()
    {
        if (self::$connection == null) {
            $config = Config::getInstance();

            $parameters = $config->getParameter('db');

            self::$connection = new mysqli(
                $parameters['host'],
                $parameters['user'],
                $parameters['password'],
                $parameters['database'],
                $parameters['port']
            );

            if (self::$connection->connect_error) {
                die('Connect Error');
            }

            self::$connection->set_charset("utf8");
        }

        $this->dbConnection = self::$connection;
    }

    protected function sanitize($input)
    {
        $input = htmlspecialchars(trim($input));
        return mysqli_real_escape_string($this->dbConnection, $input);
    }
}

