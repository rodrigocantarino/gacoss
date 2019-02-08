<?php

/**
 * Router to be called /Module/Controller/Action 
 */
function router()
{
    
    echo '<h1>Entrou no <i>router()</i> carai!!!!</h1>';

    $uri = $_SERVER['REQUEST_URI'];
    
    $uri = trim(str_replace('/public/', '', $uri));
    
    if(empty($uri) && $uri != '')
    {
        var_dump($uri);
        $uri_path_array = explode('/', $uri);
        $module     = $uri_path_array[0];
        $controller = $uri_path_array[1];
        $action     = $uri_path_array[2];
        
        unset($uri_path_array[0]);
        unset($uri_path_array[1]);
        unset($uri_path_array[2]);
    }
    else
    {
        $uri_path_array = [];
        $module     = 'main';
        $controller = 'index';
        $action     = 'index';
    }
    
    $params = [];
    if(count($uri_path_array) > 0)
    {
        
        $p = 3;
        while ($p)
        {
            if(empty($uri_path_array[3])){
                break;
            }
            
            if( isset($uri_path_array[$p+1]) )
            {
                $params[$uri_path_array[$p]] = $uri_path_array[$p+1];
                $p = $p+2;
            }
            else
            {
                if( isset($uri_path_array[$p]) )
                {
                    $params[$p] = '';
                }
                $p = false;
            }
        }
    }
    
    $pathObj = new stdClass();
    $pathObj->module     = $module;
    $pathObj->controller = $controller;
    $pathObj->action     = $action;
    $pathObj->params     = $params;
    
    $_SESSION['session.path'] = $pathObj;
    
    echo '<br>';
    echo '<h1>$_SESSION[session.path]</h1>';
    echo '<pre>';
    print_r($_SESSION['session.path']);
    echo '</pre>';
    
    /**
     * Include CustomAutoloader file
     */
    include_once APPLICATION_PATH.'/library/customAutoloader.php';
    
    /**
     * Define the autoload function that automatically load the Class files when the class is called
     */
    spl_autoload_register('customAutoloader');
    
    /**
     * Create a Database Access Object with PDO Class
     * See: Singleton Pattern -> see: https://en.wikipedia.org/wiki/Singleton_pattern
     */
    $instance = Config\ConnDb\ConnDb::getInstance();
    $conn = $instance->getConn();
    
    var_dump($conn);
    
    echo '</pre>';
    die();
    
    switch ($module) {
        case '':
        case 'main':


            break;
        
        case 'blog':


            break;

        default:
            break;
    }
    
}