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

function setShipStatus($conn, $ship, $orientation, $shipPositionStart) {

}

?>
