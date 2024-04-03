<?php
    define('SITE_ROOT', dirname(__DIR__));
    define('CORE_PATH', SITE_ROOT . '/core');
    define('INC_PATH', SITE_ROOT . '/includes');
    
    require(INC_PATH.'/config.php');
    require(CORE_PATH.'/post.php');
?>