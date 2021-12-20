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

/**
 * Manage database query errors
 * 
 * @parm object $db     Connection to database
 * @parm string $S      SQL query origin of the error
 */
function db_error($db, $S) {
    $errNo = mysqli_errno($db);
    $errMsg = mysqli_error($db);

    echo '<h2> DataBase Error <h2>',
         'Mysql Error : ', $errNo, ' - ', $errMsg,
         '<br>Query : <pre>', $S, '</pre>',
         '<h3>Stack of functions call</h3>';

    $calls = debug_backtrace();

    for($i=0, $iMax = count($calls);$i<$iMax;$i++) {
        echo $calls[$i]['function'], ' - ',
             $calls[$i]['line'], ' - ',
             $calls[$i]['file'], '<br>';
    }

    exit(); // End of the script
}