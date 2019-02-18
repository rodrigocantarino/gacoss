<?php

namespace Gacoss\Library\Router;

use Gacoss\Library\SessionManager\SessionManager as SessionManager;

class Router 
{
    
    private $uri;
    private $uri_path_array;
    private $module;
    private $controller;
    private $action;
    private $params;
    private $module_config;
    private $session_manager;
    
    private $paths_to_ignore = [
        'favicon.ico',
    ];


    public function __construct() 
    {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->session_manager = new SessionManager();
        $this->prepareRoute();        
        $this->setCustomAutoload();
        $this->setDefaultLayout();
    }
    
    private function prepareRoute() 
    {
        
        $uri = trim(str_replace('/public/', '', $this->uri));
        $uri = ltrim($uri, '/');
        $uri = trim(str_replace('/index.php?module=', '', $uri));
        $uri = trim(str_replace('&controller=', '/', $uri));
        $uri = trim(str_replace('&action=', '/', $uri));
        
        if(!empty($uri)) {
            $this->uri_path_array = explode('/', $uri);
            $this->module = strtolower($this->uri_path_array[0]);
            $this->controller = strtolower($this->uri_path_array[1]);
            $this->action = strtolower($this->uri_path_array[2]);
        } else {
            $this->uri_path_array = [];
            $this->module = 'app';
            $this->controller = 'index';
            $this->action = 'index';
        }
        
        
        $this->params = [];
        if(count($this->uri_path_array) > 0){

            $p = 3;
            while ($p){
                if(empty($this->uri_path_array[3])){
                    break;
                }

                if( isset($uri_path_array[$p+1]) ){
                    $this->params[$this->uri_path_array[$p]] = $this->uri_path_array[$p+1];
                    $p = $p+2;
                } else {
                    if( isset($this->uri_path_array[$p]) ) {
                        $this->params[$p] = '';
                    }
                    $p = false;
                }
            }
        }

        $this->setSessionPath();
        
    }
    
    private function verifyPathsToIgnore($pathObj)
    {
        if(in_array($pathObj->module, $this->paths_to_ignore)){
            exit();
        }
        if(in_array($pathObj->controller, $this->paths_to_ignore)){
            exit();
        }
        if(in_array($pathObj->action, $this->paths_to_ignore)){
            exit();
        }
        
    }

    private function setSessionPath() 
    {
        $pathObj = new \stdClass();
        $pathObj->uri        = $this->uri;
        $pathObj->module     = $this->module;
        $pathObj->controller = $this->controller;
        $pathObj->action     = $this->action;
        $pathObj->params     = $this->params;

        $this->verifyPathsToIgnore($pathObj);
        $this->session_manager::setSessionNewContent('called.path', $pathObj);
    }
    
    /**
     * Set a custom class Autoload function
     */
    private function setCustomAutoload() 
    {
        /**
         * Include CustomAutoloader file
         */
        include_once APPLICATION_PATH.'/library/customAutoloader.php';

        /**
         * Define the autoload function that automatically load the Class files when the class is called
         */
//        spl_autoload_register('customAutoloader');
        spl_autoload_register('customAutoloaderPsr4');
        
    }
    
    /**
     * Set the Default Layout
     */
    private function setDefaultLayout()
    {
        $this->session_manager::setSessionNewContent('config.layout', APPLICATION_PATH.'/layout/index.php');
        $this->session_manager::setSessionNewContent('config.layoutHeader', APPLICATION_PATH.'/layout/_header.php');
        $this->session_manager::setSessionNewContent('config.layoutContent', APPLICATION_PATH.'/layout/_content.php');
        $this->session_manager::setSessionNewContent('config.layoutFooter', APPLICATION_PATH.'/layout/_footer.php');
    }
    
    private function verifyCalledAction() 
    {
        if( in_array($this->action ,$this->module_config[$this->module][$this->controller]['views']) ||
            array_key_exists($this->action ,$this->module_config[$this->module][$this->controller]['views'])    
          ){
            return true;
        }
        return false;
    }
    
    private function goToErrorPage() 
    {
        $this->session_manager::setSessionNewContent('config.layoutContent', APPLICATION_PATH.'/layout/404.php');
    }
    
    private function goToRoute() 
    {
        $filename = APPLICATION_PATH . '/modules/' . $this->module .'/config/module.config.php';
        if(!is_file($filename)){
            $message = 'Module <i><strong>'.$this->module.'</strong></i> config file doesn\'t exists.';
            $this->session_manager::setSessionNewContent('error.message', $message);
            $this->goToErrorPage();
            return;
        }
        
        $this->module_config = include $filename;
        
        if($this->verifyCalledAction())
        {
            $factory = new $this->module_config[$this->module][$this->controller]['factory']();
            $controller = $factory->getController();
            $controller->{$this->action}();
            return;
        }
        $this->goToErrorPage();
        return;
    }
    
    /**
     * "Start" the view layer of the application
     */
    protected function startView() 
    {
        include $this->session_manager::getSessionContent('config.layout');
        exit();
    }
    
    public function go() 
    {
        $this->goToRoute();
        $this->startView();
    }
    
}
