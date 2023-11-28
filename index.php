<?php
require_once('initialize.php');
require_once('db_calls.php');
require_once('SECRETS.php');
require_once('authenticate.php');

$info = [$servername, $username,  $password, $dbname];
$user = authenticate(['Player1','Player2']);
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

switch ($r = array_shift($request)) {
case 'boards':
	if ($method == 'GET') {
		get_boards($user);
	} else if ($method == 'POST') {
		reset_boards($user);
		get_boards($user);
	}
	break;
case 'board':
	if ($request[1] == 'my_ships') {
		if ($request == 'GET') {
			if ($request.count == 2) {
				get_ships($user);
			} else {
				get_ship($user, $request[2]);
			}
		} else if ($request == 'PUT') {
			set_ship($user, $request[2], $request[3], $request[4], $request[5]);
		}
	} else if ($request[1] == 'enemy') {
		if ($request == 'GET') {
			if ($request.count == 2) {
				get_enemy($user);
			} else {
				get_enemy_cell($user, $request[2], $request[3]);
			}
		} else if ($request == 'PUT') {
			attack_cell($user, $request[2], $request[3]);
		}
	}
	break;
case 'status':
	if ($method == 'GET') {
		get_status();
	}
	break;
case 'players':
	if ($method == 'GET') {
		if ($request.count == 1) {
			get_players();
		} else {
			get_player($request[1])
		}
	} else if ($method == 'PUT') {
		put_player($request[0], $request[1]);
	}
	break;
default:
	header("HTTP/1.1 404 Not Found");
	exit;
}
?>
