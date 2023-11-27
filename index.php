<?php
require_once('initialize.php');
require_once('dbCalls.php');
require_once('SECRETS.php');

$info = [$servername, $username,  $password, $dbname];

$user = authenticateUser($info);
showCurrentGameStatus($info, $user);


function authenticateUser($info) {
	$allowedUsers = array('Player1', 'Player2');
	#Checking if user is in array of allowed users
	if (!isset($_GET['username']) || !in_array($_GET['username'], $allowedUsers)) {
		echo "Please specify user\n";
		exit;
	}
	$user = $_GET['username'];
	echo "Hello: " . $user . "\n";
	return $user;
}

function showCurrentGameStatus($info, $user) {
	$conn = dbConnect($info);
	if (isset($_GET['ship'])) {
		if (isset($_GET['orientation'])) {
			if (isset($_GET['start'])) {
				setShipStatus($conn, $user, $_GET['ship'], $_GET['orientation'], $_GET['start']);
			} else {
				echo "Missing Ship Start square. Didn't set ship\n";
			}
		} else {
			echo "Missing Ship Orientation. Didn't set ship\n"; 
		}
	} else {
		echo "Select ship to set\n";
	}
	$playerCarrierStatus = getShipStatus($info, 'Carrier');
	$playerBattleshipStatus = getShipStatus($info, 'Battleship');
	$playerSubmarineStatus = getShipStatus($info, 'Submarine');
	$playerBoatStatus = getShipStatus($info, 'Boat');
	echo "-----YOUR SHIPS-----\nShip           | Location |\nCarrier (C)    | ". $playerCarrierStatus ."  |\nBattleship (B) | ". $playerBattleshipStatus ."  |\nSubmarine (S)  | ". $playerSubmarineStatus ."  |\nBoat (b)       | ". $playerBoatStatus ."  |\n\nYour Board:\n" . getShipBoard($info, $user);
	$conn->close();		
}

?>
