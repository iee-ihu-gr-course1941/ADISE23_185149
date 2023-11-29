<?php

function create_battlefield($servername, $username, $password, $dbname) {
	$insert = " (row,a,b,c,d,e,f) values(";

	$createAttack = " (
		row int,
		a varchar(1),
		b varchar(1),
		c varchar(1),
		d varchar(1),
		e varchar(1),
		f varchar(1)
	);";
	$createShips = " (
		row int,
		a varchar(10),
		b varchar(10),
		c varchar(10),
		d varchar(10),
		e varchar(10),
		f varchar(10)
	);
	";

	#Connect to MySQL database	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection Error: " . $conn->connect_error);
		exit;
	}

	drop($conn);
	create($conn, $createAttack, $createShips);
	insert_init($conn, $insert);
	
	
	#Close the connection to the server	
	$conn->close();
}

function drop($conn) {
	#Drop if exists all board tables
	try {
		$conn->query("DROP TABLE IF EXISTS player1attack;");
		$conn->query("DROP TABLE IF EXISTS player2attack;");
		$conn->query("DROP TABLE IF EXISTS player1ships;");
		$conn->query("DROP TABLE IF EXISTS player2ships;");
	} catch (Exception $ex) {
		echo $ex;	
	}

}

function create($conn, $createAttack, $createShips) {
	#Create tables
	try {
		$conn->query("CREATE TABLE player1attack" . $createAttack);
		$conn->query("CREATE TABLE player2attack" . $createAttack);
		$conn->query("CREATE TABLE player1ships" . $createShips);
		$conn->query("CREATE TABLE player2ships" . $createShips);

	} catch (Exception $ex) {
		echo $ex;
	}

}

function insert_init($conn, $insert) {
	#Insert initial values
	try {
		$conn->query("INSERT INTO player1attack" . $insert . "1,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player1attack" . $insert . "2,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player1attack" . $insert . "3,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player1attack" . $insert . "4,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player1attack" . $insert . "5,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player1attack" . $insert . "6,'U','U','U','U','U','U')");	
		
		$conn->query("INSERT INTO player2attack" . $insert . "1,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player2attack" . $insert . "2,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player2attack" . $insert . "3,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player2attack" . $insert . "4,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player2attack" . $insert . "5,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player2attack" . $insert . "6,'U','U','U','U','U','U')");	
		
		$conn->query("INSERT INTO player1ships" . $insert . "1,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player1ships" . $insert . "2,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player1ships" . $insert . "3,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player1ships" . $insert . "4,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player1ships" . $insert . "5,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player1ships" . $insert . "6,'U','U','U','U','U','U')");	
	
		$conn->query("INSERT INTO player2ships" . $insert . "1,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player2ships" . $insert . "2,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player2ships" . $insert . "3,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player2ships" . $insert . "4,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player2ships" . $insert . "5,'U','U','U','U','U','U')");	
		$conn->query("INSERT INTO player2ships" . $insert . "6,'U','U','U','U','U','U')");	
		
	} catch (Exception $ex) {
		echo $ex;	
	}
}

function getConnection($servername, $username, $password, $dbname) {
	return new mysqli($servername, $username, $password, $dbname);
}
?>
