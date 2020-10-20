<?php

// Connecting to database.
include_once '../pp_database_access.php';

$dbconn = getLoginString();
list($dbname,$dbhost,$dbuser,$dbclave) = explode(";",$dbconn);

require __DIR__.'/vendor/autoload.php';

$db = new \PDO("pgsql:dbname=$dbname;host=$dbhost;", $dbuser, $dbclave);


$auth = new \Delight\Auth\Auth($db);

$contact_email = getContactEmail();

?>
