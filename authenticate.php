<?php

function authenticate($usernames) {

	if (!isset($_SERVER['PHP_AUTH_USER'])) {
		$error = ['Error' => 'Specify User'];
		header("Content-Type: application/json");
		echo json_encode($error) . "\n";
		exit;
	} else if (!in_array($_SERVER['PHP_AUTH_USER'], $usernames)) {
		$error = ['Error' => 'Specified User Does Not Exist'];
		header("Content-Type: application/json");
		echo json_encode($error) . "\n";
		exit;
	}
	return $_SERVER['PHP_AUTH_USER'];
}

?>
