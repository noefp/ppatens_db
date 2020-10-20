
<?php

$db=null;

include_once 'db_new_instance.php';

try {
      $userId = $auth->register($_POST['email'], $_POST['password'], null, function ($selector, $token) {

      });

      $sql2 = "INSERT INTO user_info (first_name,last_name,institution,department,city,country,user_id) VALUES (?,?,?,?,?,?,?)";
      $db->prepare($sql2)->execute([$_POST['first_name'], $_POST['last_name'],$_POST['university'],$_POST['department'],$_POST['city'],$_POST['country'], $userId]);


      $msg = "Your account in PEATmoss and the <i>P. patens</i> Gene Model Lookup DB was created.<br>We will contact you to confirm your registration. Please contact us if you do not get confirmation in the next 3 days.<br><br>Kind regards,<br>PEATmoss team.";
      // use wordwrap() if lines are longer than 70 characters
      $msg = wordwrap($msg,70);
      mail($_POST['email'],"your account in PEATmoss was created",$msg, $contact_email);


    // echo 'Your user was created. We will validate it in the next working hours. Please contact us if you do not get confirmation in the next 3 days.';
    echo 'id: '.$userId.' Your user was created. We will contact you to confirm your registration. Please contact us if you do not get confirmation in the next 3 days.';
}
catch (\Delight\Auth\InvalidEmailException $e) {
    echo 'Invalid email address';
}
catch (\Delight\Auth\InvalidPasswordException $e) {
    echo 'Invalid password';
}
catch (\Delight\Auth\UserAlreadyExistsException $e) {
    echo 'User already exists';
}
catch (\Delight\Auth\TooManyRequestsException $e) {
    echo 'Too many requests';
}

?>
