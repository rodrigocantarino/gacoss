<?php

namespace App\Factory;

use Library\Factory\AbstractFactory;
use \App\Controller\IndexController;

/**
 * Description of IndexFactory
 *
 * @author rodrigocantarino
 */
class IndexFactory extends AbstractFactory
{

    public function __construct(string $action)
    {
        new \App\Controller\IndexController(parent::getConn(), $action);
    }

}