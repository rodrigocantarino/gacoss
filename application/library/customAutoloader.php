<?php

/**
 * Custom Autoloader Function responsible for automatically include the file of the called Class
 * @param type $class_name
 * @throws Exception
 */
function customAutoloader($class_name)
{
    $folder = '';
    
    $class_namespaces = explode('\\', $class_name);
    
    $module = strtolower($class_namespaces[0]);
    
    if($module != 'library'){
        $folder .= '/modules/'.$module;
    }
    else
    {
        $folder .= '/'.$module;
    }
    
    $last_name = max(array_keys($class_namespaces));
    
    $class_name = trim($class_namespaces[$last_name]);
    
    if(strpos($class_name, 'ConnDb'))     { $folder .= '/../config';}
    if(strpos($class_name, 'Factory'))    { $folder .= '/factory';}
    if(strpos($class_name, 'Controller')) { $folder .= '/controller';}
    if(strpos($class_name, 'Model'))      { $folder .= '/model';}
    if(strpos($class_name, 'Interface'))  { $folder .= '/interface';}
    
    $dir_to_load = APPLICATION_PATH . $folder . '/';
    $class_to_load = APPLICATION_PATH . $folder . '/' . $class_name. '.php';
    
    if(!is_file($class_to_load))
    {
        throw new Exception('Error loading  class (file not found): '.$class_name);
    }
    
    try 
    {
        include $class_to_load;
    } 
    catch (Exception $exc) 
    {
        throw new Exception('Error inclued file class: '.$class_name.'('.$class_to_load.')');
    }

    
}