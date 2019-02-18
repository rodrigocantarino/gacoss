<?php

namespace Gacoss\Library\Factory;

use Gacoss\Config\ConnDb\ConnDb;

/**
 * Description of AbstractFactory
 *
 * @author rodrigocantarino
 */
abstract class AbstractFactory 
{
    protected $controller;
    
    abstract protected function setController($controller);
    
    public function getController() {
        return $this->controller;
    }

}