<?php

function authenticate($usernames) {

	if (!isset($_SERVER['PHP_AUTH_USER'])) {
		$error = ['Error' => 'Specify User'];
		echo json_encode($error) . "\n";
		http_response_code(400);
		exit;
	} else if (!in_array($_SERVER['PHP_AUTH_USER'], $usernames)) {
		$error = ['Error' => 'Specified User Does Not Exist'];
		echo json_encode($error) . "\n";
		http_response_code(400);
		exit;
	}
}

?>
