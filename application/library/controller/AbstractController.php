<?php

namespace Gacoss\Library\Controller;

/**
 * Description of AbstractController
 *
 * @author rodrigocantarino
 */
abstract class AbstractController 
{
    
    protected $conn;
    protected $session_manager;
    
    abstract public function index();
    
}