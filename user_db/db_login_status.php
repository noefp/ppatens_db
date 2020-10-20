<?php
// require __DIR__ . '/vendor/autoload.php';

// include_once 'db_new_instance.php';
// header("Access-Control-Allow-Origin: http://localhost:3000");

// $_POST['peatmossCookie'];

// $_SESSION['userid'] = $auth->id();


// error_log("COOKIE_Perl: ".$_POST['peatmossCookie'], 0);
// error_log("COOKIE_PHP: ".session_id(), 0);
// session_id($_POST['peatmossCookie']);
// error_log("COOKIE_PHP: ".session_id(), 0);

// if( $_POST['peatmossCookie'] )
// {
//     session_id($_POST['peatmossCookie']);
//     session_start();
// }
// ob_start();
// var_dump( $_SESSION );
// $result = ob_get_clean();
// error_log("COOKIE_PHP: ".$result);


if( $_COOKIE['PHPSESSID'] )
{
    session_id( $_COOKIE['PHPSESSID'] );
    session_start();
}
ob_start();
var_dump( $_SESSION );
$result = ob_get_clean();
error_log("COOKIE_PHP: ".$result);


include_once 'db_new_instance.php';

// \Delight\Cookie\Cookie::setcookie('SID', $_POST['peatmossCookie']);

error_log("Status: ".$auth->id(), 0);

$msg=1;

if ($auth->isLoggedIn()) {
    $msg=1;
}
else {
    $msg=0;
}

echo $msg;

?>
