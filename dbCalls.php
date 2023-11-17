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

	return $board; 
}

function dbConnect($info) {	
	return new mysqli($info[0], $info[1], $info[2], $info[1]);
}

function getShipStatus($conn, $ship) {
	return "Not Set";	
}

function setShipStatus($conn, $user, $ship, $orientation, $shipPositionStart) {
	
	#User Check
	$sql = "update table player1ships";
	if ($user == 'Player2') {
		$sql = "update table player2ships";
	}

	$startLetter = strtolower(substr($shipPositionStart, 0, 1));
	$startNumber = substr($shipPositionStart, 1, 1);


	#Orientation Check
	if ($orientation == 'horizontal') {

		#Horizontal Name Check
		if ($ship == 'Carrier') {

			#Check if ship fits
			switch ($startLetter) {
				case 'd':
				case 'e':
				case 'f':
					echo "Ship Position is invalid. Didn't set ship.";
					exit;
				case 'a':
					$sql = $sql . "set a = C, b = C, c = C, d = C where row = " . $startNumber . ";"; 
				case 'b':
					$sql = $sql . "set b = C, c = C, d = C, e = C where row = " . $startNumber . ";"; 
				case 'c':
					$sql = $sql . "set c = C, d = C, e = C, f = C where row = " . $startNumber . ";"; 
			}
			$conn->query($sql);


		} else if ($ship == 'Battleship') {

			switch ($startLetter) {
				case 'e':
				case 'f':
					echo "Ship Position is invalid. Didn't set ship.";
					exit;
				case 'a':
					$sql = $sql . "set a = B, b = B, c = B where row = " . $startNumber . ";"; 
				case 'b':
					$sql = $sql . "set b = B, c = B, d = B where row = " . $startNumber . ";"; 
				case 'c':
					$sql = $sql . "set c = B, d = B, e = B where row = " . $startNumber . ";";
				case 'd':
					$sql = $sql . "set d = B, e = B, f = B where row = " . $startNumber . ";";
			}
			$conn->query($sql);

		} else if ($ship == 'Submarine') {

				
			switch ($startLetter) {
				case 'e':
				case 'f':
					echo "Ship Position is invalid. Didn't set ship.";
					exit;
				case 'a':
					$sql = $sql . "set a = S, b = S, c = S where row = " . $startNumber . ";"; 
				case 'b':
					$sql = $sql . "set b = S, c = S, d = S where row = " . $startNumber . ";"; 
				case 'c':
					$sql = $sql . "set c = S, d = S, e = S where row = " . $startNumber . ";";
				case 'd':
					$sql = $sql . "set d = S, e = S, f = S where row = " . $startNumber . ";";
			}
			$conn->query($sql);
			
		} else ($ship == 'Boat') {
#							
#			switch ($startLetter) {
#				case 'f':
#					echo "Ship Position is invalid. Didn't set ship.";
#					exit;
#				case 'a':
#					$sql = $sql . "set a = b, b = b where row = " . $startNumber . ";"; 
#				case 'b':
#					$sql = $sql . "set b = b, c = b where row = " . $startNumber . ";"; 
#				case 'c':
#					$sql = $sql . "set c = b, d = b where row = " . $startNumber . ";";
#				case 'd':
#					$sql = $sql . "set d = b, e = b where row = " . $startNumber . ";";
#				case 'e':
#					$sql = $sql . "set e = b, f = b where row = " . $startNumber . ";";
#			}
#			$conn->query($sql);

		}
	}
}

?>
