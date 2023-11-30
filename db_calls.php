<?php

function db_connect($info) {	
	return new mysqli($info[0], $info[1], $info[2], $info[3]);
}

# /boards/
function get_boards($conn, $user) {
    $my_ships = get_board($conn, $user, 'my_ships');
    $enemy = get_board($conn, $user, 'enemy');

    $json = substr($my_ships, 0, -2) . ',' . substr($enemy, 1);
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
     	
            COMMIT;";
            
    
	if ($conn -> multi_query($sql)) {
		do {
			if ($result = $conn -> store_result()) {
				while ($row = $result -> fetch_row()) {}		
			}
		} while ($conn -> next_result());
	}

}

function get_ship($conn, $user, $ship_name) {

}

function set_ship($conn, $user, $x1, $y1, $x2, $y2) {

}

function get_enemy_cell($conn, $user, $x, $y) {
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
