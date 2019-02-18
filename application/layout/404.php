<main role="main">
    <div class="jumbotron" style="margin-top: 70px; text-align: center;">
        <?php
//            echo '<h1>ERROR 404!!! Page not found!!! :\'(</h1>';
            echo '<h1>The page isn\'t redirecting properly!!!</h1>';
            echo '<h1>Talk to your Administrator!!!</h1>';
            echo '<img src="'.APPLICATION_HOST.'/img/goofy.png" />';
            if(isset($_SESSION['error.message'])){
                echo '<h1>'.$_SESSION['error.message'].'</h1>';
            }
        ?>
    </div>
</main>