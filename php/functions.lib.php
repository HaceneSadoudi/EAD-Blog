<?php
define('BD_HOST', 'localhost');
define('BD_USER', 'root');
define('BD_PASS', '');
define('BD_NAME', 'echo_bd');



function connecter() {
    $con = mysqli_connect(BD_HOST,BD_USER,BD_PASS,BD_NAME);

    if($con !== false) {
        mysqli_set_charset($con, 'utf8') or exit("Error while setting charset utf8");
        echo "Connected Successfully";
        return $con;
    }
    
    $msg = 'Database connexion failed: ';
    $msg .= mysqli_connect_error();
    $msg .= ' : ' . mysqli_connect_errno();
    exit($msg);
    
}