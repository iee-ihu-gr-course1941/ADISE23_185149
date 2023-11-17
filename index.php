<?php
require_once('initialize.php');
require_once('dbCalls.php');
require_once('SECRETS.php');

authenticateUser($servername, $username, $password, $dbanme);

function authenticateUser($servername, $username, $password, $dbname) {
	$allowedUsers = array('Player1', 'Player2');
	#Checking if user is in array of allowed users
	if (!isset($_GET['username']) || !in_array($_GET['username'], $allowedUsers)) {
		echo "Please specify user";
		exit;
	}
	$user = $_GET['username'];	
	echo "Hello: " . $user . "\n";
	if (isset($_GET['ship'])) {
		if (isset($_GET['orientation'])) {
			if (isset($_GET['start'])) {
				setShipStatus($conn, $_GET['ship'], $_GET['orientation'], $_GET['start']);
			} else {
				echo "Missing Ship Start square. Didn't set ship\n";
			}
		} else {
			echo "Missing Ship Orientation. Didn't set ship\n"; 
		}
	} else {
		echo "Select ship to set\n";
	}
	$info = [$servername, $username, $password, $dbname];
	$playerCarrierStatus = getShipStatus($info, 'Carrier');
	$playerBattleshipStatus = getShipStatus($info, 'Battleship');
	$playerSubmarineStatus = getShipStatus($info, 'Submarine');
	$playerBoatStatus = getShipStatus($info, 'Boat');
	echo "-----YOUR SHIPS-----\nShip           | Location |\nCarrier (C)    | ". $playerCarrierStatus ."  |\nBattleship (B) | ". $playerBattleshipStatus ."  |\nSubmarine (S)  | ". $playerSubmarineStatus ."  |\nBoat (b)       | ". $playerBoatStatus ."  |\n\nYour Board:\n" . getShipBoard($info, $user);
	$conn->close();
	
		
}

?>
