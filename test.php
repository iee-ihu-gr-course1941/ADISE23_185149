<?php
require_once('SECRETS.php');
require_once('dbCalls.php');
require_once('initialize.php');
$info = [$servername, $username, $password, $dbname];

createBattlefield($servername, $username, $password, $dbname);



?>
