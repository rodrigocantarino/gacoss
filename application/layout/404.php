<main role="main">
    <div class="jumbotron" style="margin-top: 70px; text-align: center;">
        <?php
            echo '<h1>ERROR 404!!! Page not found!!! :\'(</h1>';
            if(isset($_SESSION['error.message'])){
                echo '<h1>'.$_SESSION['error.message'].'</h1>';
            }
        ?>
        <img src="<?php echo APPLICATION_HOST;?>/img/goofy.png" />
    </div>
</main>