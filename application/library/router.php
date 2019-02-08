<?php

/**
 * Router the called Controller/Action 
 * @param type $controller
 * @param type $action
 */
function router($module, $controller, $action){
    
    /**
     * Create a Database Access Object with PDO Class
     * See: Singleton Pattern -> see: https://en.wikipedia.org/wiki/Singleton_pattern
     */
    $instance = ConnDb::getInstance();
    $conn = $instance->getConn();
    
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