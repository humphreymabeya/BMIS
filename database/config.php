<?php
    ob_start();
    session_start();
    // $siteName = "Cipet.in";
 
    // DEFINE("BASE_URL","http://localhost/3000/");
 
    // DEFINE ('DB_USER', 'root');
    // DEFINE ('DB_PSWD', 'root'); 
    // DEFINE ('DB_HOST', 'localhost'); 
    // DEFINE ('DB_NAME', 'BMIS'); 
 
    // date_default_timezone_set('Africa/Nairobi'); 
    // $conn =  new mysqli(DB_HOST,DB_USER,DB_PSWD,DB_NAME);
    // if($conn->connect_error)
    //     die("Failed to connect database ".$conn->connect_error );

    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
        
    $conn = new mysqli($server, $username, $password, $db);
?>