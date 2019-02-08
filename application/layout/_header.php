<style>

.bg-dark {
    background-color: #000!important;
}

.bg-gacoss-admin{
    background-color: #3C280D!important;
}

.bg-gacoss-site-user{
    background-color: #35281E!important;
}

.navbar-light{
    background-color: #FAFAFA!important;
}

</style>

<?php

$css_nav_class   = 'navbar-dark bg-dark';

if(isset($_SESSION['config']['statusLogged']) && $_SESSION['config']['statusLogged'] == true)
{
    
    $profile = (int)$_SESSION['config']['user']['id_profile'];
    
    switch ($profile) 
    {
        case 1: // Admin
            $css_nav_class = 'navbar-dark bg-gacoss-admin';
            $link_btn_admin = APPLICATION_HOST.'/index.php?module=admin&controller=admin&action=index';
            break;
        case 2: // Site user
            $css_nav_class = 'navbar-dark bg-gacoss-site-user';
            $link_btn_site_user = APPLICATION_HOST.'/index.php?module=user&controller=user&action=index';
            break;
    }
    
}

$link_btn_home   = APPLICATION_HOST.'/index.php?module=main&controller=index&action=index';
$link_btn_blog   = APPLICATION_HOST.'/index.php?module=blog&controller=blog&action=index';
$link_btn_login  = APPLICATION_HOST.'/index.php?module=user&controller=login&action=login';
$link_btn_logout = APPLICATION_HOST.'/index.php?module=user&controller=login&action=logout';


?>

<nav class="navbar navbar-expand-md fixed-top <?php echo $css_nav_class; ?>">
    <img src="<?php echo APPLICATION_HOST; ?>/img/goofy.png" height="55px" />
    &nbsp;
    <a class="navbar-brand" href="#">Gacoss</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $link_btn_home; ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $link_btn_blog; ?>">Blog</a>
            </li>
            <?php
            if ((!isset($_SESSION['config']) || !isset($_SESSION['config']['statusLogged'])) || $_SESSION['config']['statusLogged'] == false) 
            {
                $html = <<<HTML
<li class="nav-item">
    <a class="nav-link" href="{$link_btn_login}">Sign up</a>
</li>
HTML;
            } 
            else 
            { 
                
                $profile = (int)$_SESSION['config']['user']['id_profile'];
    
                switch ($profile) 
                {
                    case 1: // Admin
                        $html = <<<HTML
<li class="nav-item">
    <a class="nav-link" href="{$link_btn_admin}">Home Admin</a>
</li>
HTML;
                        break;
                    case 2: // Site user
                        $html = <<<HTML
<li class="nav-item">
    <a class="nav-link" href="{$link_btn_site_user}">My profile</a>
</li>
HTML;
                        break;
                }
                
                $html .= <<<HTML
<li class="nav-item">
    <a class="nav-link" href="{$link_btn_logout}">Logout</a>
</li>
HTML;
            }
            
            echo $html;
            
            
            ?>
    </div>
</nav>   