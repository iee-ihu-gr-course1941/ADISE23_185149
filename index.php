<?php
require_once('initialize.php');
require_once('db_calls.php');
require_once('SECRETS.php');
require_once('authenticate.php');

$info = [$servername, $username,  $password, $dbname];

$user = authenticate(get_player_usernames());
#$user = 'Player1';

$method = $_SERVER['REQUEST_METHOD'];
#$method = 'GET';

$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
#$request = array('status');

$conn = db_connect($info);

switch ($r = array_shift($request)) {
case 'boards':
	if ($method == 'GET') {
		get_boards($conn, $user);
	} else if ($method == 'POST') {
		reset_boards($conn, $user);
		get_boards($conn, $user);
	}
	break;
case 'board':
	if ($request[1] == 'my_ships') {
		if ($request == 'GET') {
			if ($request.count == 2) {
				get_ships($conn, $user);
			} else {
				get_ship($conn, $user, $request[2]);
			}
		} else if ($request == 'POST') {
			set_ship($conn, $user, $request[2], $request[3], $request[4], $request[5]);
		}
	} else if ($request[1] == 'enemy') {
		if ($request == 'GET') {
			if ($request.count == 2) {
				get_enemy($conn, $user);
			} else {
				get_enemy_cell($conn, $user, $request[2], $request[3]);
			}
		} else if ($request == 'POST') {
			attack_cell($conn, $user, $request[2], $request[3]);
		}
	}
	break;
case 'status':
	if ($method == 'GET') {
		get_status($conn);
	}
	break;
case 'players':
	if ($method == 'GET') {
		if ($request.count == 1) {
			get_players($conn);
		} else {
			get_player($conn, $request[1]);
		}
	}
	break;
default:
	$conn->close();
	header("HTTP/1.1 404 Not Found");
}
?>
