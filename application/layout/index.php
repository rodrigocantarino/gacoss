<!DOCTYPE html>
<html>
    <head>
        <!-- Title -->
        <title>GACOSS - Goofin Around Coding Silly Stuff</title>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="GACOSS - Goofin Around Coding Silly Stuff" />
        <meta name="author" content="rodrigopcantarino@gmail.com" />
        <!-- BootstrapCDN got on: http://getbootstrap.com/ -->
        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
        <!-- Javascripts -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    </head>
    <body>
        
        <?php
        
        use Gacoss\Library\SessionManager\SessionManager as SessionManager;
        
        $header = SessionManager::getSessionContent('config.layoutHeader');
        $content = SessionManager::getSessionContent('config.layoutContent');
        $footer = SessionManager::getSessionContent('config.layoutFooter');
        
        $loginError = SessionManager::getSessionContent('config.loginError');
        $errorMessage = SessionManager::getSessionContent('error.message');
        
        include_once $header;
        echo '<div class="container">';
        
        if($loginError){
            echo '<br><br><br>';
            echo '<div class="alert alert-danger" role="alert">';
            echo $loginError;
            echo '</div>';
        }
        
        if($errorMessage){
            echo '<br><br><br>';
            echo '<div class="alert alert-danger" role="alert">';
            echo $errorMessage;
            echo '</div>';
        }
        
        include_once $content; 
        
        echo '<hr>';
        
        include_once $footer; 
        
        echo '</div>';
        
        ?>
        </div>
    </body>
</html>