<?php

/**
 * Custom Autoloader Function responsible for automatically include the file of the called Class
 * @param type $class_name
 * @throws Exception
 */
function customAutoloader($class_name){
    $folder = '';
    
    $class_namespaces = explode('\\', $class_name);
        
    $last_name = max(array_keys($class_namespaces));
    
    $class_name= $class_namespaces[$last_name];
    
    if(strpos($class_name, 'Controller')) { $folder = '/controller';}
    if(strpos($class_name, 'Model'))      { $folder = '/model';}
    if(strpos($class_name, 'Interface'))  { $folder = '/interface';}
    if(strpos($class_name, 'ConnDb'))     { $folder = '';}
    
    $class_to_load = APPLICATION_PATH . $folder . '/' . $class_name. '.php';
    
    if(!is_file($class_to_load)){
        echo $class_to_load;
        //exit;
        throw new Exception('Error loading  class: '.$class_name);
        
    }
    include $class_to_load;
    
}