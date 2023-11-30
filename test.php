<?php
require_once('SECRETS.php');

$conn = new mysqli($servername, $username, $password, $username);
if ($conn->query("update player1ships set a = 'T' where row = 1;")) {
	echo "Worked\n";
}
$conn->close();
?>
