<?php
/**
 * Define application constants for PATHs and HOST
 * DOCKER configuration               : 'APPLICATION_HOST', 'http://localhost'
 * Apache configuration with vhosts   : 'APPLICATION_HOST', 'http://gacoss.localhost'
 * Apache configuration without vhosts: 'APPLICATION_HOST', 'http://localhost/gacoss/public'
 */
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
defined('APPLICATION_HOST') || define('APPLICATION_HOST', 'http://localhost');
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'dev');

include_once APPLICATION_PATH.'/library/functions.php';
include_once APPLICATION_PATH.'/library/Router.php';
include_once APPLICATION_PATH.'/library/SessionManager.php';

/** * Session Start * */
Gacoss\Library\SessionManager\SessionManager::sessionStart('Default');

/** * Resolve the routes * */
try 
{
    $router = new Gacoss\Library\Router\Router();
    $router->go();
} 
catch (Exception $exc) 
{
    echo '<h1>';
    echo $exc->getTraceAsString();
    echo '<pre>';
    print_r($exc);
    echo '</pre>';
    session_destroy();
}

