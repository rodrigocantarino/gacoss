<?php
/**
 * Define application constants for PATHs and HOST
 * DOCKER configuration               : 'APPLICATION_HOST', 'http://gacoss.localhost'
 * Apache configuration with vhosts   : 'APPLICATION_HOST', 'http://gacoss.localhost'
 * Apache configuration without vhosts: 'APPLICATION_HOST', 'http://localhost/gacoss/public'
 */
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
defined('APPLICATION_HOST') || define('APPLICATION_HOST', 'http://gacoss.localhost');
//defined('APPLICATION_HOST') || define('APPLICATION_HOST', 'http://localhost/gacoss/public');

/**
 * Include control functions file
 */
include_once APPLICATION_PATH.'/library/functions.php';

/**
 * Include CustomAutoloader file
 */
include_once APPLICATION_PATH.'/library/customAutoloader.php';

/**
 * Include Router file
 */
include_once APPLICATION_PATH.'/library/router.php';

/**
 * Define the autoload function that automatically load the Class files when the class is called
 */
spl_autoload_register('customAutoloader');

/**
 * Session Start
 */
session_start();
/**
 * Define the default layout
 */
$_SESSION['config']['layout'] = APPLICATION_PATH.'/layout/index.php';

/**
 * Define the default layout content
 */
$_SESSION['config']['layoutContent'] = APPLICATION_PATH.'/layout/_content.php';

/**
 * Resolve the routes 
 */
$module     = ($_GET['module']) ?? 'main';
$controller = ($_GET['controller']) ?? 'index';
$action     = ($_GET['action']) ?? 'index';

router($module, $controller,$action);

/**
 * "Start" the view layer of the application
 */
include $_SESSION['config']['layout'];

/**
 * ************************************************************************************************* *
 * 
 * For the Data base connection and configurations see file:
 * APPLICATION_PATH/gacoss/application/config/ConnDB.php
 * 
 * ************************************************************************************************* *
 * 
 * This application uses the MVC - Model-View-Control design pattern with a Router control.
 * 
 * The execution order is:
 * 
 * /public/index.php load the default configurations and "Start" (after the next steps) the view layer of the application -> 
 * /library/functions.php :: router() calls the class and the action passed via $_GET ->
 * /library/functions.php :: customAutoloader() to load the file from the called class ->
 * /application/controller/xxxController.php -> xxxController()::xxxAction() ->
 *      Call if is the case:
 *      /application/model/xxxModel.php -> xxxModel()::xxxMethod() ->
*       Load:
 *      /application/view/xxx/ called_xxxAction_view.php
 * 
 * ************************************************************************************************* *
 * 
 */