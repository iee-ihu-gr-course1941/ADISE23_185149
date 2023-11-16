<html>
<head>
<title>
Authenticate User
</title>
</head>
<body>
<?php

authenticateUser();

function authenticateUser() {
	$allowedUsers = array('Player1', 'Player2');

	#Checking if user is in array of allowed users
	if (!isset($_SERVER['PHP_AUTH_USER']) || !in_array($_SERVER['PHP_AUTH_USER'], $allowedUsers)) {
		authenticate();
	}
	$user = $_SERVER['PHP_AUTH_USER'];
	echo "Hello: " . $user . "\n";
	if ($user == $allowedUsers[1]) {
		echo "Waiting for " . $allowedUsers[0];
	} else {
		echo "Start game?";
	}
	exit;	
}

function add($x = 0, $y = 0) {
	echo $x + $y;
}

function authenticate() {
	header('WWW-Authenticate: Basic realm=:"Battleship User Authentication"');
	header('HTTP/1.0 401 Unauthorized');
	echo "Invalid Username\n";
	exit;
}

?>
</body>
</html>
