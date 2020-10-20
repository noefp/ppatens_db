
<?php

$db=null;

include_once 'db_new_instance.php';

try {
      $userId = $auth->register($_POST['email'], $_POST['password'], null, function ($selector, $token) {

      });

      $sql2 = "INSERT INTO user_info (first_name,last_name,institution,department,city,country,user_id) VALUES (?,?,?,?,?,?,?)";
      $db->prepare($sql2)->execute([$_POST['first_name'], $_POST['last_name'],$_POST['university'],$_POST['department'],$_POST['city'],$_POST['country'], $userId]);

      $headers = 'From: '.$contact_email."\r\n".
      'Reply-To:'.$contact_email."\r\n";

      $msg = "Your account in PEATmoss and the PpGML DB was created.\r\n
      We will contact you to confirm your registration.\r\n
      Please contact us if you do not get confirmation in the next 3 days.\r\n\r\n
      Kind regards,\r\n
      The PEATmoss team.\r\n";
      // use wordwrap() if lines are longer than 70 characters
      $msg = wordwrap($msg,70);
      mail($_POST['email'],"your account in PEATmoss was created",$msg, $headers);

    echo 'Your user was created. We will contact you to confirm your registration. Please contact us if you do not get confirmation in the next 3 days.';
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
