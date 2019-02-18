<?php

namespace Gacoss\App\Controller;

use Gacoss\Library\Controller\AbstractController;
use Gacoss\Library\View\View as View;

use Gacoss\Library\SessionManager\SessionManager as SessionManager;

/**
 * Description of Index
 *
 * @author rodrigocantarino
 */
class IndexController extends AbstractController
{
    /**
     * 
     * @param \Config\ConnDb\ConnDb::instance  $conn
     * @param string $action
     * @return type
     */
    public function __construct(\PDO $conn) 
    {
        $this->conn = $conn;
        $this->session_manager = new SessionManager();
    }
    
    /**
     * Index view
     */
    public function index()
    {
        new View([]);
//        $this->session_manager::setSessionNewContent('config.layoutContent', APPLICATION_PATH . '/modules/app/view/index.php');
    }
    
    public function index2()
    {
        $this->session_manager::setSessionNewContent('config.layoutContent', APPLICATION_PATH . '/modules/app/view/index.php');
    }
    
}
