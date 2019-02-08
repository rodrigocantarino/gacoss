<?php

namespace Config\ConnDb;

use \PDO;
use \PDOException;

/**
 * Data Access Object - Model Layer
 * Uses: 
 *  - PDO - PHP Data Objects 
 *  - 
 * @author Rodrigo Cantarino <rodrigopcantarino@gmail.com>
 */
class ConnDb extends \PDO
{
    
    private static $instance = null;
    private $conn;
    
    private $dsn;
    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $port;

    private function __construct($type = 'mysql') {
        
        switch ($type) {
            case 'mysql':
                $this->setConfigMysql();
                try 
                {
//                    $this->conn = parent::__construct($this->dsn, $this->user, $this->pass);
                    $this->conn = new \PDO($this->dsn, $this->user, $this->pass);
                } 
                catch( \PDOException $Exception ) 
                {
//                    echo '<pre>';
                    var_dump($Exception);
                    print_r($Exception->xdebug_message);
                    $error_message = '<b>'.$Exception->getMessage( ).' - '.(int)$Exception->getCode( ).'</b>';
                    echo '<p>Couldn\'t connect to MySQL! <br> Error: '.$error_message.' </p>';
                    exit();
                    //throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                }
                break;
            case 'postgresql':
                $this->setConfigPostges();
                try 
                {
                    $this->conn = new \PDO($this->dsn, $this->user, $this->pass);
                } 
                catch( PDOException $Exception ) 
                {
                    $error_message = '<b>'.$Exception->getMessage( ).' - '.(int)$Exception->getCode( ).'</b>';
                    echo '<p>Couldn\'t connect to PostgreSQL! <br> Error: '.$error_message.' </p>';
                    exit();
                    //throw new MyDatabaseException( $Exception->getMessage( ) , (int)$Exception->getCode( ) );
                }
                break;
            case 'mongo':
                $this->setConfigMongoDB();
                break;
            default:
                $this->setConfigMysql();
                $this->conn = new \PDO($this->dsn, $this->user, $this->pass);
                break;
        }
    }
    
    private function setConfigMysql() {
        $this->host   = 'mysql';
        $this->dbname = 'gacoss';
        $this->user   = 'user';
        $this->pass   = 'user12345';
//        $this->user   = 'root';
//        $this->pass   = 'root';
        $this->port   = '3306';
//        $this->dsn    = 'mysql:host='.$this->host.';dbname='.$this->dbname.'';
        $this->dsn    = 'mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->dbname.'';
        echo '<h1>$this->dsn:';
        var_dump($this->dsn);
        echo '</h1>';
    }
    
    private function setConfigPostges() {
        $this->host   = 'localhost';
        $this->dbname = 'gacoss';
        $this->user   = 'postgres';
        $this->pass   = 'root';
        $this->port   = '5432';
        $this->dsn = 'pgsql:dbname='.$this->dbname.';host='.$this->host.';port='.$this->port;
    }
    
    private function setConfigMongoDB() {
        
    }
    
    private function setConfigRedis() {
        
    }
    
    public static function getInstance() {
        if(!self::$instance){
            self::$instance = new ConnDb();
        }
        return self::$instance;
    }
    
    public function getConn() {
        return $this->conn;
    }
    
    // Empty method to prevent to clone the conection
    private function __clone() {}
    
}