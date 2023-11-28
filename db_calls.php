<?php



function dbConnect($info) {	
	return new mysqli($info[0], $info[1], $info[2], $info[3]);
}

function canPlaceShip($conn, $user, $startNumber, $startLetter, $orientation, $ship) {
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
