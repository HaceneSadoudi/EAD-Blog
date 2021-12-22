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


/**
 * Protect the output (Generated html code for the user)
 * 
 * @param  mixed $content    An array or a string to be protected
 * @return mixed             The protected string or array
 */
function proteger_sortie($content) {
    if(is_array($content)) {
        foreach($content as &$value) {
            $value = proteger_sortie($value);
        }
        unset($value);
        return $content;
    }
    if(is_string($content)) {
        return htmlentities($content, ENT_QUOTES);
    }
}