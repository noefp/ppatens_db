
<?php include_once 'db_new_instance.php';?>

<?php
header("Access-Control-Allow-Origin: http://localhost:3000");

$msg=1;

error_log("will logged out! ".$auth->id(), 0);

$auth->logOut();
// $_SESSION['userid'] = $auth->id();

if ($auth->isLoggedIn()) {
    $msg="User is logged in";
}
else {
    $msg="logged out";
    error_log("Logged out! ".$auth->id(), 0);
}

echo $msg;

?>
