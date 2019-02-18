<?php

namespace Gacoss\Library\View;

use Gacoss\Library\View\AbstractView;
use Gacoss\Library\SessionManager\SessionManager as SessionManager;

/**
 * Description of ViewModel
 *
 * @author rodrigocantarino
 */
class View extends AbstractView 
{
    
    public function __construct($data) 
    {
        
        $this->session_manager = new SessionManager();
        
        $caller_path = $this->session_manager::getSessionContent('called.path');
        
        $view_file_path = APPLICATION_PATH . '/modules/app/view/index.php';
        
        $this->session_manager::setSessionNewContent('config.layoutContent', $view_file_path);
        
    }
}
