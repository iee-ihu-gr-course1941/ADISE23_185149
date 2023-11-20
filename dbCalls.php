<?php

function getShipBoard($info, $user) {
	$conn = dbConnect($info);
	echo "\n";
	$sql = 'select * from player1ships;';
	if ($user == 'Player2') {
		$sql = 'select * from player2ships;';
	}
	$result = $conn->query($sql);
	$board = "+---+---+---+---+---+---+---+\n|   | a | b | c | d | e | f |\n+---+---+---+---+---+---+---+";
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$board = $board . "\n| " . $row["row"] . " | " . $row["a"]. " | " . $row["b"]. " | " . $row["c"]. " | " . $row["d"]. " | " . $row["e"]. " | " . $row["f"] . " |";
			$board = $board . "\n+---+---+---+---+---+---+---+";
		}
	} else {
		$board = "Board Unavailable";
	}

	return "\n" . $board . "\n"; 
}

function dbConnect($info) {	
	return new mysqli($info[0], $info[1], $info[2], $info[3]);
}

function getShipStatus($conn, $ship) {
	return "Not Set";	
}

function setShipStatus($conn, $user, $ship, $orientation, $shipPositionStart) {
	
	#User Check
	$sql = "update player1ships ";
	if ($user == 'Player2') {
		$sql = "update player2ships ";
	}

	$startLetter = strtolower(substr($shipPositionStart, 0, 1));
	$startNumber = substr($shipPositionStart, 1, 1);


	#Orientation Check
	if ($orientation == 'horizontal') {

		if ($startNumber > 6) {
			echo "Ship Position is invalid. Didn't set ship";
			exit;
		}
		#Horizontal Name Check
		if ($ship == 'Carrier') {

			$query = '';
			switch ($startLetter) {
				case 'd':
				case 'e':
				case 'f':
					echo "Ship Position is invalid. Didn't set ship.";
					exit;
				case 'a':
					$query = $sql . "set a = 'C', b = 'C', c = 'C', d = 'C' where row = " . $startNumber . ";"; 
				       break;	

				case 'b':
					$query = $sql . "set b = 'C', c = 'C', d = 'C', e = 'C' where row = " . $startNumber . ";"; 
				       break;	

				case 'c':
					$query = $sql . "set c = 'C', d = 'C', e = 'C', f = 'C' where row = " . $startNumber . ";"; 
				       break;	

			}
			$conn->query($query);


		} else if ($ship == 'Battleship') {

			switch ($startLetter) {
				case 'e':
				case 'f':
					echo "Ship Position is invalid. Didn't set ship.";
					exit;
				case 'a':
					$sql = $sql . "set a = 'B', b = 'B', c = 'B' where row = " . $startNumber . ";";
				       break;	
				case 'b':
					$sql = $sql . "set b = 'B', c = 'B', d = 'B' where row = " . $startNumber . ";"; 
				       break;	

				case 'c':
					$sql = $sql . "set c = 'B', d = 'B', e = 'B' where row = " . $startNumber . ";";
				       break;	

				case 'd':
					$sql = $sql . "set d = 'B', e = 'B', f = 'B' where row = " . $startNumber . ";";
				       break;	

			}
			$conn->query($sql);

		} else if ($ship == 'Submarine') {

				
			switch ($startLetter) {
				case 'e':
				case 'f':
					echo "Ship Position is invalid. Didn't set ship.";
					exit;
				case 'a':
					$sql = $sql . "set a = 'S', b = 'S', c = 'S' where row = " . $startNumber . ";"; 
				       break;	

				case 'b':
					$sql = $sql . "set b = 'S', c = 'S', d = 'S' where row = " . $startNumber . ";"; 
				       break;	

				case 'c':
					$sql = $sql . "set c = 'S', d = 'S', e = 'S' where row = " . $startNumber . ";";
				       break;	

				case 'd':
					$sql = $sql . "set d = 'S', e = 'S', f = 'S' where row = " . $startNumber . ";";
				       break;	

			}
			$conn->query($sql);
			
		} else if($ship == 'Boat') {
							
			switch ($startLetter) {
				case 'f':
					echo "Ship Position is invalid. Didn't set ship.";
					exit;
				case 'a':
					$sql = $sql . "set a = 'b', b = 'b' where row = " . $startNumber . ";"; 
				       break;	

				case 'b':
					$sql = $sql . "set b = 'b', c = 'b' where row = " . $startNumber . ";"; 
				       break;	

				case 'c':
					$sql = $sql . "set c = 'b', d = 'b' where row = " . $startNumber . ";";
				       break;	

				case 'd':
					$sql = $sql . "set d = 'b', e = 'b' where row = " . $startNumber . ";";
				       break;	

				case 'e':
					$sql = $sql . "set e = 'b', f = 'b' where row = " . $startNumber . ";";
				       break;	

			}
			$conn->query($sql);

		}
	} else if ($orientation == 'vertical') {

		if($ship == 'Carrier') {	

			if ($startNumber > 3) {
				echo "Invalid Ship Position. Didn't set ship.";
				exit;
			}

			switch ($startLetter) {
			case 'a':
				$conn->query($sql . "set a = 'C' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . "or row = " . ($startNumber + 3) . ";");
				break;
			case 'b':
				$conn->query($sql . "set b = 'C' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . "or row = " . ($startNumber + 3) . ";");
				break;
			case 'c':
				$conn->query($sql . "set c = 'C' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . "or row = " . ($startNumber + 3) . ";");
				break;
			case 'd':
				$conn->query($sql . "set d = 'C' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . "or row = " . ($startNumber + 3) . ";");
				break;
			case 'e':
				$conn->query($sql . "set e = 'C' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . "or row = " . ($startNumber + 3) . ";");
				break;
			case 'f':
				$conn->query($sql . "set f = 'C' where row = " . $startNumber . "or row = " . ($startNumber + 1) .  "or row = " . ($startNumber + 2) . "or row = " . ($startNumber + 3) . ";");
			}

		}
		else if ($ship == 'Battleship') {

			if ($startNumber > 4) {
				echo "Invalid Ship Position. Didn't set ship.";
				exit;
			}


			switch ($startLetter) {
			case 'a':
				$conn->query($sql . "set a = 'B' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . ";");
				break;
			case 'b':
				$conn->query($sql . "set b = 'B' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . ";");
				break;
			case 'c':
				$conn->query($sql . "set c = 'B' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) .  ";");
				break;
			case 'd':
				$conn->query($sql . "set d = 'B' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . ";");
				break;
			case 'e':
				$conn->query($sql . "set e = 'B' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . ";");
				break;
			case 'f':
				$conn->query($sql . "set f = 'B' where row = " . $startNumber . "or row = " . ($startNumber + 1) .  "or row = " . ($startNumber + 2) . ";");
			}

		}
		else if ($ship == 'Submarine') {

			if ($startNumber > 4) {
				echo "Invalid Ship Position. Didn't set ship.";
				exit;
			}


			switch ($startLetter) {
			case 'a':
				$conn->query($sql . "set a = 'S' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . ";");
				break;
			case 'b':
				$conn->query($sql . "set b = 'S' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . ";");
				break;
			case 'c':
				$conn->query($sql . "set c = 'S' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) .  ";");
				break;
			case 'd':
				$conn->query($sql . "set d = 'S' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . ";");
				break;
			case 'e':
				$conn->query($sql . "set e = 'S' where row = " . $startNumber . "or row = " . ($startNumber + 1)  . "or row = " . ($startNumber + 2) . ";");
				break;
			case 'f':
				$conn->query($sql . "set f = 'S' where row = " . $startNumber . "or row = " . ($startNumber + 1) .  "or row = " . ($startNumber + 2) . ";");
			}

		}
		else if ($ship == 'Boat') {

			if ($startNumber == 6) {
				echo "Invalid Ship Position. Didn't set ship.";
				exit;
			}

			switch ($startLetter) {
			case 'a':
				$conn->query($sql . "set a = 'b' where row = " . $startNumber . "or row = " . ($startNumber + 1) . ";");
				break;
			case 'b':
				$conn->query($sql . "set b = 'b' where row = " . $startNumber . "or row = " . ($startNumber + 1) . ";");
				break;
			case 'c':
				$conn->query($sql . "set c = 'b' where row = " . $startNumber . "or row = " . ($startNumber + 1) . ";");
				break;
			case 'd':
				$conn->query($sql . "set d = 'b' where row = " . $startNumber . "or row = " . ($startNumber + 1) . ";");
				break;
			case 'e':
				$conn->query($sql . "set e = 'b' where row = " . $startNumber . "or row = " . ($startNumber + 1) . ";");
				break;
			case 'f':
				$conn->query($sql . "set f = 'b' where row = " . $startNumber . "or row = " . ($startNumber + 1) . ";");
			}

		}
	}
}

function canPlaceShip($conn, $user, $startumber, $startLetter, $orientation, $shipType) {

}

?>
