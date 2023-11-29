<?php

function db_connect($info) {	
	return new mysqli($info[0], $info[1], $info[2], $info[3]);
}

# /boards/
function get_boards($conn, $user) {
    $my_ships = get_board($conn, $user, 'my_ships');
    $enemy = get_board($conn, $user, 'enemy');
    echo $my_ships . "\n";
    echo $enemy . "\n";
}

function get_board($conn, $user, $board_name) {
    if ($board_name == 'my_ships') {
        $board = $conn->query('select * from player1ships');
        if ($user == 'Player1') {
            $board = $conn->query('select * from player2ships');
        }
    } else if ($board_name == 'enemy'){
        $board = $conn->query('select * from player1attack');
        if ($user == 'Player1') {
            $board = $conn->query('select * from player2attack');
        }
    } else {
        $error = ['Error' => 'Invalid Request'];
		header("Content-Type: application/json");
		echo json_encode($error) . "\n";
		exit;
    }

    if ($board->num_rows > 0) {
        $json_begin = '{"' . $board_name .'":{';
        $json_end = '}';
        $data_json = ''
        while($data = $result->fetch_assoc()) {
            $data_json = $data_json . '"' . $data['row'] . '": {"a": "' . $data['a'] . '","b": "' . $data['b'] . '","c": "' . $data['c'] . '","d": "' . $data['d'] . '","e": "' . $data['e'] . '","f": "' . $data['f'] . '"},';
        }
        $response = substr($data_json, 0, -1);
        $response = $response . "}}}";
        
        $json = $json_begin . $data_json . $json_end;
        
        return json_encode(json_decode($json)) . "\n";
    }
    return json_encode(json_decode($board_json));
}


function reset_boards($conn, $user) {

}

function get_ships($conn, $user) {

}

function get_ship($conn, $user, $ship_name) {

}

function set_ship($conn, $user, $x1, $y1, $x2, $y2) {

}

function get_enemy($conn, $user) {

}

function get_enemy_cell($conn, $user, $x, $y) {

}

function attack_enemy_cell($conn, $user, $x, $y) {

}

function get_status($conn) {
	$result = $conn->query("select * from status");
	$data = array();
	if ($result->num_rows > 0) {
		$count = 0;
		$data_json = '{"Response":{"';
		while($data = $result->fetch_assoc()) {
			$data_json = $data_json . $count . '":{"Game State":"' . $data['gamestate'] . '", "Next Action":"' . $data['next_action'] . '"},';
		}
		$response = substr($data_json, 0, -1);
		$response = $response . "}}";
		
		header("Content-Type: application/json");
		echo json_encode(json_decode($response)) . "\n";
		$conn->close();
		exit;
	} else {
		header("HTTP/1.1 500 Internal Server Error");
		$conn->close();
		exit;
	}
}

function get_players($conn) {

}

function get_player($conn, $player) {

}

function get_player_usernames() {
	return ['Player1', 'Player2'];
}

function can_place_ship($conn, $user, $startNumber, $startLetter, $orientation, $ship) {
	$result = $conn->query("select * from player1ships;");
	if ($user == 'Player2') {
		$result = $conn->query("select * from player2ships;");
	}
	if ($result->num_rows > 0) {
		$count = 0;
		while ($row = $result->fetch_assoc()) {
			
			if ($orientation == 'horizontal') {
				
				if ($row['row'] == $startNumber) {
					$a = $row['a'];
					$b = $row['b'];
					$c = $row['c'];	
					$d = $row['d'];
					$e = $row['e'];
					$f = $row['f'];
					
					switch ($startLetter) {
					case 'a':
						if ($a != 'U' || $b != 'U') {
							return false;
						}
						if ($ship == 'Boat') {
							return true;
						}
						if ($c != 'U') {
							return false;
						}
						if ($ship != 'Carrier') {
							return true;
						}
						if ($d == 'U') {
							return true;
						}
						return false;
					case 'b':
						if ($b != 'U' || $c != 'U') {
							return false;
						}
						if ($ship == 'Boat') {
							return true;
						}
						if ($d != 'U') {
							return false;
						}
						if ($ship != 'Carrier') {
							return true;
						}
						if ($e == 'U') {
							return true;
						}
						return false;
					case 'c':
						if ($c != 'U' || $d != 'U') {
							return false;
						}
						if ($ship == 'Boat') {
							return true;
						}
						if ($e != 'U') {
							return false;
						}
						if ($ship != 'Carrier') {
							return true;
						}
						if ($f == 'U') {
							return true;
						}
						return false;
					case 'd':
						if ($d != 'U' || $e != 'U') {
							return false;
						}
						if ($ship == 'Boat') {
							return true;
						}
						if ($f != 'U') {
							return false;
						}
						if ($ship != 'Carrier') {
							return true;
						}
						return false;		
					case 'e': 
						if ($e != 'U' || $f != 'U') {
							return false;
						}
						if ($ship == 'Boat') {
							return true;
						}
						return false;
					}
					return false;
				}
			} else {
				$col = $row[$startLetter];
				if ($col == 'U') {
					$count = $count + 1;

				} else {
					return false;
				}

				switch ($ship) {
				case 'Carrier':
					if ($count == 4) {
						return true;
					}
					break;
				case 'Battleship':
				case 'Submarine':
					if ($count == 3) {
						return true;
					}
					break;
				case 'Boat':
					if ($count == 2) {
						return true;
					}
					break;
				}
			}
		}
	}

	return false;
}

?>
