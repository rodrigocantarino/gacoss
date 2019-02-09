<?php

namespace Library\Factory;

use Config\ConnDb\ConnDb;

/**
 * Description of AbstractFactory
 *
 * @author rodrigocantarino
 */
abstract class AbstractFactory 
{
    private $conn;

    public function __invoke($action = 'index')
    {
        /**
         * Create a Database Access Object with PDO Class
         * See: Singleton Pattern -> see: https://en.wikipedia.org/wiki/Singleton_pattern
         */
        $instance = Config\ConnDb\ConnDb::getInstance();
        $this->conn = $instance->getConn();
    }
    
    public function getConn() 
    {
        return $this->conn;
    }

}