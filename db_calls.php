<?php

function db_connect($info) {	
	return new mysqli($info[0], $info[1], $info[2], $info[3]);
}

# /boards/
function get_boards($conn, $user) {
    $my_ships = get_board($conn, $user, 'my_ships');
    $enemy = get_board($conn, $user, 'enemy');

    $json = '{"Response":' . substr($my_ships, 0, -2) . ',' . substr($enemy, 1) . '}';
    header("Content-Type: application/json");
    $conn->close();
    echo json_encode(json_decode($json)) . "\n";
}

function get_board($conn, $user, $board_name) {
    if ($board_name == 'my_ships') {
        $board = $conn->query('select * from player1ships');
        if ($user == 'Player2') {
            $board = $conn->query('select * from player2ships');
        }
    } else if ($board_name == 'enemy'){
        $board = $conn->query('select * from player1attack');
        if ($user == 'Player2') {
            $board = $conn->query('select * from player2attack');
        }
    } else {
        $error = ['Error' => 'Invalid Request'];
		header("Content-Type: application/json");
		$conn->close();
		echo json_encode($error) . "\n";
		exit;
    }

    if ($board->num_rows > 0) {
        $json_begin = '{"' . $board_name .'":{';
        $json_end = '}';
        $data_json = '';
        while($data = $board->fetch_assoc()) {
            $data_json = $data_json . '"' . $data['row'] . '": {"a": "' . $data['a'] . '","b": "' . $data['b'] . '","c": "' . $data['c'] . '","d": "' . $data['d'] . '","e": "' . $data['e'] . '","f": "' . $data['f'] . '"},';
        }
        $response = substr($data_json, 0, -1);
        $response = $response . "}";
        
        $json = $json_begin . $response . $json_end;
        return json_encode(json_decode($json)) . "\n";
    }
    return json_encode(json_decode($board_json));
}


function reset_boards($conn) {

    $sql = "
            START TRANSACTION;

            drop table if exists player1ships;
            drop table if exists player2ships;
            drop table if exists player1attack;
            drop table if exists player2attack;
            
            create table player1ships(
                row int,
                a varchar(1),
                b varchar(1),
                c varchar(1),
                d varchar(1),
                e varchar(1),
                f varchar(1)
            );
            
            create table player2ships(
                row int,
                a varchar(1),
                b varchar(1),
                c varchar(1),
                d varchar(1),
                e varchar(1),
                f varchar(1)
            );
            
            create table player1attack(
                row int,
                a varchar(1),
                b varchar(1),
                c varchar(1),
                d varchar(1),
                e varchar(1),
                f varchar(1)
            );
            
            create table player2attack(
                row int,
                a varchar(1),
                b varchar(1),
                c varchar(1),
                d varchar(1),
                e varchar(1),
                f varchar(1)
            );
            
            INSERT INTO player1attack(row, a, b, c, d, e, f) values (1,'U','U','U','U','U','U');
            INSERT INTO player1attack(row, a, b, c, d, e, f) values (2,'U','U','U','U','U','U');
            INSERT INTO player1attack(row, a, b, c, d, e, f) values (3,'U','U','U','U','U','U');
            INSERT INTO player1attack(row, a, b, c, d, e, f) values (4,'U','U','U','U','U','U');
            INSERT INTO player1attack(row, a, b, c, d, e, f) values (5,'U','U','U','U','U','U');
            INSERT INTO player1attack(row, a, b, c, d, e, f) values (6,'U','U','U','U','U','U');
                        
            INSERT INTO player2attack(row, a, b, c, d, e, f) values (1,'U','U','U','U','U','U');
            INSERT INTO player2attack(row, a, b, c, d, e, f) values (2,'U','U','U','U','U','U');
            INSERT INTO player2attack(row, a, b, c, d, e, f) values (3,'U','U','U','U','U','U');
            INSERT INTO player2attack(row, a, b, c, d, e, f) values (4,'U','U','U','U','U','U');
            INSERT INTO player2attack(row, a, b, c, d, e, f) values (5,'U','U','U','U','U','U');
            INSERT INTO player2attack(row, a, b, c, d, e, f) values (6,'U','U','U','U','U','U');
                        
            INSERT INTO player1ships(row, a, b, c, d, e, f) values (1,'U','U','U','U','U','U');
            INSERT INTO player1ships(row, a, b, c, d, e, f) values (2,'U','U','U','U','U','U');
            INSERT INTO player1ships(row, a, b, c, d, e, f) values (3,'U','U','U','U','U','U');
            INSERT INTO player1ships(row, a, b, c, d, e, f) values (4,'U','U','U','U','U','U');
            INSERT INTO player1ships(row, a, b, c, d, e, f) values (5,'U','U','U','U','U','U');
            INSERT INTO player1ships(row, a, b, c, d, e, f) values (6,'U','U','U','U','U','U');
                        
            INSERT INTO player2ships(row, a, b, c, d, e, f) values (1,'U','U','U','U','U','U');
            INSERT INTO player2ships(row, a, b, c, d, e, f) values (2,'U','U','U','U','U','U');
            INSERT INTO player2ships(row, a, b, c, d, e, f) values (3,'U','U','U','U','U','U');
            INSERT INTO player2ships(row, a, b, c, d, e, f) values (4,'U','U','U','U','U','U');
            INSERT INTO player2ships(row, a, b, c, d, e, f) values (5,'U','U','U','U','U','U');
            INSERT INTO player2ships(row, a, b, c, d, e, f) values (6,'U','U','U','U','U','U');

	    UPDATE status SET gamestate = 'Ship Setup', next_action = 'Both';

	    UPDATE player_ships SET ship_status = 'Not Set', start_position = NULL, end_position = NULL, first_space = NULL, second_space = NULL, third_space = NULL, fourth_space = NULL;

            COMMIT;";
            
    
	if ($conn -> multi_query($sql)) {
		do {
			if ($result = $conn -> store_result()) {
				while ($row = $result -> fetch_row()) {}		
			}
		} while ($conn -> next_result());
	}

}

function get_ship($conn, $user, $ship) {
    if (in_array(strtolower($ship), ['carrier','battleship','submarine','boat'])) {
        $ship_correct_name = substr(strtoupper($ship), 0 ,1) . substr(strtolower($ship), 1);
	$cell = $conn->query("select * from player_ships where ship_owner = '$user' and ship_name = '$ship_correct_name'");
        $json_begin = '{"Response":';
	$json_end = '}';
        if ($cell->num_rows == 1) {
            $row = $cell->fetch_assoc();

	    if ($row['ship_status'] == 'Not Set') {
		header('Content-Type: application/json');
		http_response_code(400);
		echo json_encode(json_decode('{"Error": "Ship Not Set"}')) . "\n";
	    	exit;
	    }

            $start = $row['start_position'];
            $start_letter = substr($start, 0, 1);
            $start_number = intval(substr($start, 1));
            $end = $row['end_position'];
            $end_letter = substr($end, 0, 1);
	    $end_number = intval(substr($end, 1));
	    
            if ($start_letter == $end_letter) {
                //horizontal handling $json_cell
                switch ($ship_correct_name) {
                    case 'Carrier':
                        $json_cell = '{
                            "Carrier": {
                                "' . $start . '": "' . $row['first_space'] . '",
                                "' . $start_letter . $start_number+1 . '": "' . $row['second_space'] . '",
                                "' . $start_letter . $start_number+2 . '": "' . $row['third_space'] . '",
                                "' . $end . '": "' . $row['fourth_space'] . '"
                            }
			}';
			break;
                    case 'Battleship':
                        $json_cell = '{
                            "Battleship": {
                                "' . $start . '": "' . $row['first_space'] . '",
                                "' . $start_letter . $start_number+1 . '": "' . $row['second_space'] . '",
                                "' . $end . '": "' . $row['third_space'] . '"
                            }
			}';
			break;
                    case 'Submarine':
                        $json_cell = '{
                            "Submarine": {
                                "' . $start . '": "' . $row['first_space'] . '",
                                "' . $start_letter . $start_number+1 . '": "' . $row['second_space'] . '",
                                "' . $end . '": "' . $row['third_space'] . '"
                            }
			}';
			break;
                    case 'Boat':
                        $json_cell = '{
                            "Boat": {
                                "' . $start . '": "' . $row['first_space'] . '",
                                "' . $end . '": "' . $row['second_space'] . '"
                            }
                        }';
                }
            } else {
                $letters = ['a','b','c','d','e','f'];
                for($x = 0; $x < sizeof($letters); $x++) {
                    if ($start_letter == $letters[$x]) {
                        $letter_index = $x;
                    }
                }
                //vertical handling $json_cell
                switch ($ship_correct_name) {
                    case 'Carrier':
                        $json_cell = '{
                            "Carrier": {
                                "' . $start . '": "' . $row['first_space'] . '",
                                "' . $letters[$letter_index+1] . $start_number . '": "' . $row['second_space'] . '",
                                "' . $letters[$letter_index+2] . $start_number . '": "' . $row['third_space'] . '",
                                "' . $end . '": "' . $row['fourth_space'] . '"
                            }
			}';
			break;
                    case 'Battleship':
                        $json_cell = '{
                            "Battleship": {
                                "' . $start . '": "' . $row['first_space'] . '",
                                "' . $letters[$letter_index+1] . $start_number . '": "' . $row['second_space'] . '",
                                "' . $end . '": "' . $row['third_space'] . '"
                            }
			}';
			break;
                    case 'Submarine':
                        $json_cell = '{
                            "Submarine": {
                                "' . $start . '": "' . $row['first_space'] . '",
                                "' . $letters[$letter_index+1] . $start_number . '": "' . $row['second_space'] . '",
                                "' . $end . '": "' . $row['third_space'] . '"
                            }
			}';
			break;
                    case 'Boat':
                        $json_cell = '{
                            "Boat": {
                                "' . $start . '": "' . $row['first_space'] . '",
                                "' . $end . '": "' . $row['second_space'] . '"
                            }
                        }';
                }
            }

            $response = $json_begin . $json_cell . $json_end;
	    header("Content-Type: application/json");
            echo json_encode(json_decode($response)) . "\n";
            exit;
        } else {
            $error = ['Error' => 'Ship not found'];
            header("Content-Type: application/json");
            echo json_encode($error) . "\n";
            exit;
        }
    } else {
        $error = ['Error' => 'Invalid Ship name'];
        header("Content-Type: application/json");
        echo json_encode($error) . "\n";
        exit;
    }
}

function set_ship($conn, $user, $ship, $x1, $y1, $x2, $y2) {
	$x1 = strtolower($x1);
	$x2 = strtolower($x2);
	$ship = strtoupper(substr($ship, 0, 1)) . strtolower(substr($ship, 1));
	$yarray = ['a','b','c','d','e','f'];
	$xarray = ['1','2','3','4','5','6'];
	if (!in_array($y1, $yarray) || !in_array($y2, $yarray) || !in_array($x1, $xarray) || !in_array($x2, $xarray)) {
		$error = ['Error' => 'Ship Coordinates out of range'];
		header('Content-Type: application/json');
		http_response_code(400);
		$conn->close();
		echo json_encode($error) . "\n";
		exit;
	} else if ($x1 != $x2 && $y1 != $y2) {
		$error = ['Error' => 'Ship Position is invalid'];
		header('Content-Type: application/json');
		http_response_code(400);
		$conn->close();
		echo json_encode($error) . "\n";
		exit;
	}
	$result = $conn->query("select * from player_ships where ship_name = '$ship' and ship_owner = '$user';");
	$conn->store_result();

	$row = $result->fetch_assoc();
	if ($row['ship_status'] != 'Not Set') {
		$error = ['Error' => 'Ship already set'];
		header('Content-Type: application/json');
		http_response_code(400);
		$conn->close();
		echo json_encode($error) . "\n";
		exit;	
	}
	$playerboard = 'player1ships';
	if ($user == 'Player2') {
		$playerboard = 'player2ships';
	}

	if ($y1 == $y2) {
		switch ($ship) {
		case 'Carrier': 
			if (($x2 == $x1 + 3) && $x2 <= 6) {
				
				$sql = "
				START TRANSACTION;

				UPDATE $playerboard SET $y1 = 'C' where row = '$x1' or row = '" . $x1+1 . "' or row = '" . $x1+2 . "' or row = '$x2';
				UPDATE player_ships set ship_status = 'Undamaged', start_position = '$y1$x1', end_position = '$y2$x2', first_space = 'OK', second_space = 'OK', third_space = 'OK', fourth_space = 'OK' where ship_name = 'Carrier' and ship_owner = '$user';

				COMMIT;
				";

			} else {
				$error = ['Error' => 'Ship Position is invalid'];
				header('Content-Type: application/json');
				http_response_code(400);
				$conn->close();
				echo json_encode($error);
				exit;
			}
			break;
		case 'Battleship':
			if (($x2 == $x1 + 2) && $x2 <= 6) {
				
				$sql = "
				START TRANSACTION;

				UPDATE $playerboard SET $y1 = 'B' where row = '$x1' or row = '" . $x1+1 . "' or row = '$x2';
				UPDATE player_ships set ship_status = 'Undamaged', start_position = '$y1$x1', end_position = '$y2$x2', first_space = 'OK', second_space = 'OK', third_space = 'OK' where ship_name = 'Battleship' and ship_owner = '$user';

				COMMIT;
				";

			} else {
				$error = ['Error' => 'Ship Position is invalid'];
				header('Content-Type: application/json');
				http_response_code(400);
				$conn->close();
				echo json_encode($error);
				exit;
			}
			break;
		case 'Submarine':
			if (($x2 == $x1 + 2) && $x2 <= 6) {
				
				$sql = "
				START TRANSACTION;

				UPDATE $playerboard SET $y1 = 'S' where row = '$x1' or row = '" . $x1+1 . "' or row = '$x2';
				UPDATE player_ships set ship_status = 'Undamaged', start_position = '$y1$x1', end_position = '$y2$x2', first_space = 'OK', second_space = 'OK', third_space = 'OK' where ship_name = 'Submarine' and ship_owner = '$user';

				COMMIT;
				";

			} else {
				$error = ['Error' => 'Ship Position is invalid'];
				header('Content-Type: application/json');
				http_response_code(400);
				$conn->close();
				echo json_encode($error);
				exit;
			}
			break;
		case 'Boat':
			if ($x2 <= 5 && $x1+1 == $x2) {
				
				$sql = "
				START TRANSACTION;

				UPDATE $playerboard SET $y1 = 'b' where row = '$x1' or row = '$x2';
				UPDATE player_ships set ship_status = 'Undamaged', start_position = '$y1$x1', end_position = '$y2$x2', first_space = 'OK', second_space = 'OK' where ship_name = 'Boat' and ship_owner = '$user';

				COMMIT;
				";

			} else {
				$error = ['Error' => 'Ship Position is invalid'];
				header('Content-Type: application/json');
				http_response_code(400);
				$conn->close();
				echo json_encode($error);
				exit;
			}
			break;
		}
	} else {
		switch ($ship) {
		case 'Carrier':
			if ($y1 == 'a' && $y2 == 'd') {
				$ybetween1 = 'b';
				$ybetween2 = 'c';
			} else if ($y1 == 'b' && $y2 == 'e') {
				$ybetween1 = 'c';
				$ybetween2 = 'd';
			} else if ($y1 == 'c' && $y2 == 'f') {
				$ybetween1 = 'd';
				$ybetween2 = 'e';
			} else {
				$error = ['Error' => 'Ship Position is invalid'];
				header('Content-Type: application/json');
				http_response_code(400);
				$conn->close();
				echo json_encode($error);
				exit;
			}
				
			$sql = "
				START TRANSACTION;

				UPDATE $playerboard SET $y1 = 'C', $ybetween1 = 'C', $ybetween2 = 'C', $y2 = 'C' where row = '$x1';
				UPDATE player_ships set ship_status = 'Undamaged', start_position = '$y1$x1', end_position = '$y2$x2', first_space = 'OK', second_space = 'OK', third_space = 'OK', fourth_space = 'OK' where ship_name = 'Boat' and ship_owner = '$user';

				COMMIT;
			";
			break;

		case 'Battleship':
			if ($y1 == 'a' && $y2 == 'c') {
				$ybetween1 = 'b';
			} else if ($y1 == 'b' && $y2 == 'd') {
				$ybetween1 = 'c';
			} else if ($y1 == 'c' && $y2 == 'e') {
				$ybetween1 = 'd';
			} else if ($y1 == 'd' && $y2 == 'f'){
				$ybetween1 = 'e';
			} else {
				$error = ['Error' => 'Ship Position is invalid'];
				header('Content-Type: application/json');
				http_response_code(400);
				$conn->close();
				echo json_encode($error);
				exit;
			}
			$sql = "
				START TRANSACTION;

				UPDATE $playerboard SET $y1 = 'B', $ybetween1 = 'B', $y2 = 'B' where row = '$x1';
				UPDATE player_ships set ship_status = 'Undamaged', start_position = '$y1$x1', end_position = '$y2$x2', first_space = 'OK', second_space = 'OK', third_space = 'OK' where ship_name = 'Boat' and ship_owner = '$user';

				COMMIT;
			";
			break;

		case 'Submarine':
			if ($y1 == 'a' && $y2 == 'c') {
				$ybetween1 = 'b';
			} else if ($y1 == 'b' && $y2 == 'd') {
				$ybetween1 = 'c';
			} else if ($y1 == 'c' && $y2 == 'e') {
				$ybetween1 = 'd';
			} else if ($y1 == 'd' && $y2 == 'f'){
				$ybetween1 = 'e';
			} else {
				$error = ['Error' => 'Ship Position is invalid'];
				header('Content-Type: application/json');
				http_response_code(400);
				$conn->close();
				echo json_encode($error);
				exit;
			}
			$sql = "
				START TRANSACTION;

				UPDATE $playerboard SET $y1 = 'S', $ybetween1 = 'S', $y2 = 'S' where row = '$x1';
				UPDATE player_ships set ship_status = 'Undamaged', start_position = '$y1$x1', end_position = '$y2$x2', first_space = 'OK', second_space = 'OK', third_space = 'OK' where ship_name = 'Boat' and ship_owner = '$user';

				COMMIT;
			";
			break;

		case 'Boat':
			if ( ($y1 == 'a' && $y2 == 'b') || ($y1 == 'b' && $y2 == 'c') || ($y1 == 'c' && $y2 == 'd') || ($y1 == 'd' && $y2 == 'e') || ($y1 == 'e' && $y2 == 'f') ) {
				
				$sql = "
				START TRANSACTION;

				UPDATE $playerboard SET $y1 = 'b', $y2 = 'b' where row = '$x1';
				UPDATE player_ships set ship_status = 'Undamaged', start_position = '$y1$x1', end_position = '$y2$x2', first_space = 'OK', second_space = 'OK' where ship_name = 'Boat' and ship_owner = '$user';

				COMMIT;
				";

			} else {
				$error = ['Error' => 'Ship Position is invalid'];
				header('Content-Type: application/json');
				http_response_code(400);
				$conn->close();
				echo json_encode($error);
				exit;
			}
			break;

		}
	}

	$conn->multi_query($sql);
	do { $conn->store_result(); }
	while ($conn->next_result());
	get_ship($conn, $user, $ship);
}

function get_enemy_cell($conn, $user, $x, $y) {
    $x = strtolower($x);
    if (in_array($y, ['1','2','3','4','5','6']) && in_array($x, ['a','b','c','d','e','f'])) {
        $cell = $conn->query("select $x from player1attack where row = $y");
        $json_begin = '{"Response":';
        $json_end = '}';
        if ($cell->num_rows == 1) {
            $row = $cell->fetch_assoc();

            $json_cell = "{\"enemy\":{\"$y\":{\"$x\":\"" . $row[$x] . "\"}}}";

            $response = $json_begin . $json_cell . $json_end;
	    header("Content-Type: application/json");
	    $conn->close();
	    echo json_encode(json_decode($response)) . "\n";
            exit;
        } else {
		$error = ['Error' => 'Cell not found'];
		http_response_code(400);
	        header("Content-Type: application/json");
		$conn->close();
		echo json_encode($error) . "\n";
                exit;
        }
    } else {
	    $error = ['Error' => 'Invalid Cell Position'];
	    http_response_code(400);
       	    header("Content-Type: application/json");
	    $conn->close();
	    echo json_encode($error) . "\n";
	    exit;
    }
}

function attack_enemy_cell($conn, $user, $x, $y) {
	$result = $conn->query('select * from status');
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if ($row['gamestate'] != 'Battle') {
				header('Content-Type: application/json');
				http_response_code(400);
				$error = ['Error' => 'Game not in Battle Mode'];
				echo json_encode($error);
				exit;
			} else if ($row['next_action'] != $user) {
				header('Content-Type: application/json');
				http_response_code(400);
				$error = ['Error' => 'Not your turn'];
				echo json_encode($error);
				exit;
			}
		}
	}

	#Attack here
	#Edit the ships table if damaged or sunk ship
	#Edit the playerXtable with the shot
	
	get_board($conn, $user, 'enemy');
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
