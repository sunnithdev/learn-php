<?php
    define('DB_USER', 'root');
    define('DB_PASSWORD','');
    define('DB_HOST', 'localhost');
    define('DB_NAME','mobileStore');
    define('CHARSET', 'utf8mb4');


    if(defined("INITIALIZING_DATABASE"))
    {
        $dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD)
            OR die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
        $dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
            OR die("Connection failed: " . mysqli_connect_error());
    }
?>



