<?php

namespace Gacoss\App\Factory;

use Gacoss\Library\Factory\AbstractFactory;
use Gacoss\Config\ConnDb as ConnDb;
use Gacoss\App\Controller\IndexController as IndexController;

/**
 * Description of IndexFactory
 *
 * @author rodrigocantarino
 */
class IndexFactory extends AbstractFactory
{
    public function __construct()
    {   
        $this->conn = ConnDb::getInstance()->getConn();
        $this->setController(new IndexController($this->conn));
    }
    
    protected function setController($controller) {
        $this->controller = $controller;
    }
}