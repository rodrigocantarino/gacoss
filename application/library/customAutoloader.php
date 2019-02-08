<?php

/**
 * Custom Autoloader Function responsible for automatically include the file of the called Class
 * @param type $class_name
 * @throws Exception
 */
function customAutoloader($class_name){
    $folder = '/../config';
//    $folder = '';
    
    echo '<h1>customAutoloader($class_name)</h1>';
    echo '<br>'.$class_name.'<br>';
    
    $class_namespaces = explode('\\', $class_name);
    
    echo '<h1>$class_namespaces</h1>';
    echo '<br>';
    var_dump($class_namespaces);
    echo '<br>';
        
    $last_name = max(array_keys($class_namespaces));
    
    $class_name = trim($class_namespaces[$last_name]);
    
    echo '<h1>$class_name</h1>';
    echo '<br>'.$class_name.'<br>';
    
    echo '<br>';
    echo '<pre>';
    print_r($_SESSION['session.path']);
    echo '</pre>';
    
    ///Applications/MAMP/htdocs/gacoss/config/ConnDB.php
    
    if(strpos($class_name, 'ConnDb'))     { $folder = '/../config';}
    if(strpos($class_name, 'Factory'))    { $folder = '/factory';}
    if(strpos($class_name, 'Controller')) { $folder = '/controller';}
    if(strpos($class_name, 'Model'))      { $folder = '/model';}
    if(strpos($class_name, 'Interface'))  { $folder = '/interface';}
    
    $dir_to_load = APPLICATION_PATH . $folder . '/';
    $class_to_load = APPLICATION_PATH . $folder . '/' . $class_name. '.php';
    
    echo '<h1>$folder</h1>';
    echo '<br>'.$folder.'<br>';
    echo '<h1>$class_to_load</h1>';
    echo '<br>'.$class_to_load.'<br>';
    
    echo '<h1>is_dir($dir_to_load)</h1>';
    echo '<br>'.$dir_to_load.'<br>';
    echo '<br>'.var_dump(is_dir($dir_to_load)).'<br>';
    
    echo '<h1>is_file($class_to_load)</h1>';
    echo '<br>'.$class_to_load.'<br>';
    echo '<br>'.var_dump(is_file($class_to_load)).'<br>';
    
    
    
    if(!is_file($class_to_load)){
        //echo $class_to_load;
        //exit;
        throw new Exception('Error loading  class: '.$class_name);
        
    }
    
    include $class_to_load;
    
}