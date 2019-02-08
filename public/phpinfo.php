<?php
echo '<pre>';
print_r($_ENV);
echo '<br>';
print_r($_SERVER['REQUEST_URI']);
echo '<br>';
print_r($_SERVER);
echo '</pre>';

phpinfo();