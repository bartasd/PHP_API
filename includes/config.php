<?php
    $host = 'localhost';
    $db_name = 'phprest';
    $db_user = 'root';
    $db_password = 'xxxxxx';
    $charset = 'utf8mb4';

    
    $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
    ];
    
    
    $db = new PDO($dsn, $db_user, $db_password, $options);
?>