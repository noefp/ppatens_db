
<?php include_once 'db_new_instance.php';?>

<?php
header("Access-Control-Allow-Origin: http://localhost:3000");

$msg=0;

try {
  // echo "email: ".$_POST['email'];
  // echo " pwd: ".$_POST['password'];
  // limit to 3 attempts in 5 min
  $auth->throttle([ 'attemptToLogin' ], 3, 300);
  $auth->login($_POST['email'], $_POST['password']);

  if ($auth->isLoggedIn()) {

      // $_SESSION['userid'] = $auth->id();

      $msg=$auth->id();
      // $msg="Logged in";
      error_log("Logged in! ".$auth->id(), 0);
  }
  else {
      $msg="an error ocurred";
  }

  echo $msg;

}
catch (\Delight\Auth\InvalidEmailException $e) {
    $msg="Wrong email address";

    echo $msg;
}
catch (\Delight\Auth\InvalidPasswordException $e) {
    $msg="Wrong password";

    echo $msg;
}
catch (\Delight\Auth\EmailNotVerifiedException $e) {
    $msg="Account not verified";

    echo $msg;
}
catch (\Delight\Auth\TooManyRequestsException $e) {
    $msg="Too many requests";

    echo $msg;
}

?>
