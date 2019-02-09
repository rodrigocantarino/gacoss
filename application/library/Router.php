<?php

namespace Library\Router;

class Router 
{
    
    private $uri;
    private $uri_path_array;
    private $module;
    private $controller;
    private $action;
    private $module_config;


    public function __construct() 
    {
        $this->uri = $_SERVER['REQUEST_URI'];
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
        
        if(!empty($uri))
        {
            $this->uri_path_array = explode('/', $uri);
            $this->module = strtolower($this->uri_path_array[0]);
            $this->controller = strtolower($this->uri_path_array[1]);
            $this->action = strtolower($this->uri_path_array[2]);
        }
        else
        {
            $this->uri_path_array = [];
            $this->module = 'app';
            $this->controller = 'index';
            $this->action = 'index';
        }
        
        
    $params = [];
    if(count($this->uri_path_array) > 0)
    {
        
        $p = 3;
        while ($p)
        {
            if(empty($this->uri_path_array[3])){
                break;
            }
            
            if( isset($uri_path_array[$p+1]) )
            {
                $params[$this->uri_path_array[$p]] = $this->uri_path_array[$p+1];
                $p = $p+2;
            }
            else
            {
                if( isset($this->uri_path_array[$p]) )
                {
                    $params[$p] = '';
                }
                $p = false;
            }
        }
    }
    
    $pathObj = new \stdClass();
    $pathObj->uri        = $this->uri;
    $pathObj->module     = $this->module;
    $pathObj->controller = $this->controller;
    $pathObj->action     = $this->action;
    $pathObj->params     = $params;
    
    $this->setSessionPath($pathObj);
        
    }
    
    private function setSessionPath($pathObj) 
    {
        $_SESSION['session.path'] = $pathObj;
    }
    
    private function setCustomAutoload() 
    {    
        /**
         * Include CustomAutoloader file
         */
        include_once APPLICATION_PATH.'/library/customAutoloader.php';

        /**
         * Define the autoload function that automatically load the Class files when the class is called
         */
        spl_autoload_register('customAutoloader');
        
    }
    
    private function setDefaultLayout() 
    {
        $_SESSION['config.layout'] = APPLICATION_PATH.'/layout/index.php';
        $_SESSION['config.layoutHeader'] = APPLICATION_PATH.'/layout/_header.php';
        $_SESSION['config.layoutContent'] = APPLICATION_PATH.'/layout/_content.php';
        $_SESSION['config.layoutFooter'] = APPLICATION_PATH.'/layout/_footer.php';
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
        $_SESSION['config.layoutContent'] = APPLICATION_PATH.'/layout/404.php';
    }
    
    private function goToRoute() 
    {
        $filename = APPLICATION_PATH . '/modules/' . $this->module .'/config/module.config.php';
        if(!is_file($filename)){
            $_SESSION['error.message'] = 'Module <i><strong>'.$this->module.'</strong></i> config file doesn\'t exists.';
            $this->goToErrorPage();
            return;
        }
        
        $this->module_config = include $filename;
        
        if($this->verifyCalledAction())
        {
            new $this->module_config[$this->module][$this->controller]['factory']($this->action);
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
        include $_SESSION['config.layout'];
        die();
    }
    
    public function go() 
    {
        $this->goToRoute();
        $this->startView();
    }
    
}
