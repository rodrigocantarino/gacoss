<?php
/**
 * Define application constants for PATHs and HOST
 * DOCKER configuration               : 'APPLICATION_HOST', 'http://localhost'
 * Apache configuration with vhosts   : 'APPLICATION_HOST', 'http://gacoss.localhost'
 * Apache configuration without vhosts: 'APPLICATION_HOST', 'http://localhost/gacoss/public'
 */
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
defined('APPLICATION_HOST') || define('APPLICATION_HOST', 'http://localhost');

include_once APPLICATION_PATH.'/library/functions.php';
include_once APPLICATION_PATH.'/library/Router.php';

/** * Session Start * */
session_start();

/** * Resolve the routes * */
$router = new \Library\Router\Router();
$router->go();