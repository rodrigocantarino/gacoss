<?php

/**
 * Project-specific implementation of custom autoloader function on PSR4.
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
function customAutoloaderPsr4($class){
    
    // project-specific namespace prefix
    $prefix = 'Gacoss\\';

    // base directory for the namespace prefix
    $base_dir = APPLICATION_PATH . '/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    
    // get the relative class name
    $relative_class = substr($class, $len);
    
    $class_path = explode('\\', $relative_class);
    $class_name = array_pop($class_path);
    
    foreach ($class_path as $key => $value) {
        $class_path[$key] = strtolower($value);
    }
    
    /**
     * Edit base_dir to modules folder
     */
    if(!in_array('library', $class_path) && !in_array('config', $class_path)){
        $base_dir .= 'modules/';
    }
    
    $class_path = implode('/', $class_path);

    $file = $base_dir . $class_path . '/' . $class_name . '.php';
    
    // Remove IN PRODUCTION ENVIRONMENT
    if(!file_exists($file) && APPLICATION_ENV == 'dev'){
        echo '<p>____________________________________________</p>';
        var_dump('$class');
        var_dump($class);
        var_dump('$file to call:');
        var_dump($file);
        var_dump(file_exists($file));
        die;
    }

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
    
}