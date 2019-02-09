<?php

namespace App\Controller;

use \Config\ConnDb\ConnDb;

/**
 * Description of Index
 *
 * @author rodrigocantarino
 */
class IndexController 
{
    private $conn;

    /**
     * 
     * @param \Config\ConnDb\ConnDb::instance  $conn
     * @param string $action
     * @return type
     */
    public function __construct($conn, string $action = 'index') 
    {    
        $this->conn = $conn;
        $this->{$action}();
    }
    
    /**
     * Index view
     */
    public function index()
    {
        $_SESSION['config.layoutContent'] = APPLICATION_PATH . '/modules/app/view/index.php';
    }
    
}
