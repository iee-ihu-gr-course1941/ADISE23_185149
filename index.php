<?php
require_once('initialize.php');
require_once('db_calls.php');
require_once('SECRETS.php');
require_once('authenticate.php');

$info = [$servername, $username,  $password, $dbname];

$user = authenticate(get_player_usernames());
#$user = 'Player1';

$method = $_SERVER['REQUEST_METHOD'];
#$method = 'POST';

$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
#$request = array('board', 'enemy', 'a', '4');

$conn = db_connect($info);

switch ($r = $request[0]) {
case 'boards':
	if ($method == 'GET') {
		get_boards($conn, $user);
	} else if ($method == 'POST') {
		reset_boards($conn);
		get_boards($conn, $user);
	}
	break;
case 'board':
	if ($request[1] == 'my_ships') {
		if ($method == 'GET') {
			if (sizeof($request) == 2) {
				$board = get_board($conn, $user, 'my_ships');
				header("Content-Type: application/json");
				echo '{"Response":' . $board . '}' . "\n";
			} else {
				get_ship($conn, $user, $request[2]);
			}
		} else if ($method == 'POST') {
			set_ship($conn, $user, $request[2], $request[3], $request[4], $request[5], $request[6]);
		}
	} else if ($request[1] == 'enemy') {
		if ($method == 'GET') {
			if (sizeof($request) == 2) {
				$board = get_board($conn, $user, 'enemy');
				header("Content-Type: application/json");
				echo '{"Response":' . $board . '}' . "\n";
			} else {
				get_enemy_cell($conn, $user, $request[2], $request[3]);
			}
		} else if ($method == 'POST') {
			attack_enemy_cell($conn, $user, $request[2], $request[3]);
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
		if (sizeof($request) == 1) {
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
