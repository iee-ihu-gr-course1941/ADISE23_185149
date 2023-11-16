<?php

function createBattlefield($servername, $username, $password, $dbname) {
	$insert = "
	insert into player1attack(row,a,b,c,d,e,f) values(1,'U','U','U','U','U','U');
	insert into player1attack(row,a,b,c,d,e,f) values(2,'U','U','U','U','U','U');
	insert into player1attack(row,a,b,c,d,e,f) values(3,'U','U','U','U','U','U');
	insert into player1attack(row,a,b,c,d,e,f) values(4,'U','U','U','U','U','U');
	insert into player1attack(row,a,b,c,d,e,f) values(5,'U','U','U','U','U','U');
	insert into player1attack(row,a,b,c,d,e,f) values(6,'U','U','U','U','U','U');
	
	insert into player2attack(row,a,b,c,d,e,f) values(1,'U','U','U','U','U','U');
	insert into player2attack(row,a,b,c,d,e,f) values(2,'U','U','U','U','U','U');
	insert into player2attack(row,a,b,c,d,e,f) values(3,'U','U','U','U','U','U');
	insert into player2attack(row,a,b,c,d,e,f) values(4,'U','U','U','U','U','U');
	insert into player2attack(row,a,b,c,d,e,f) values(5,'U','U','U','U','U','U');
	insert into player2attack(row,a,b,c,d,e,f) values(6,'U','U','U','U','U','U');
	
	insert into player1ships(row,a,b,c,d,e,f) values(1,'U','U','U','U','U','U');
	insert into player1ships(row,a,b,c,d,e,f) values(2,'U','U','U','U','U','U');
	insert into player1ships(row,a,b,c,d,e,f) values(3,'U','U','U','U','U','U');
	insert into player1ships(row,a,b,c,d,e,f) values(4,'U','U','U','U','U','U');
	insert into player1ships(row,a,b,c,d,e,f) values(5,'U','U','U','U','U','U');
	insert into player1ships(row,a,b,c,d,e,f) values(6,'U','U','U','U','U','U');
	
	insert into player2ships(row,a,b,c,d,e,f) values(1,'U','U','U','U','U','U');
	insert into player2ships(row,a,b,c,d,e,f) values(2,'U','U','U','U','U','U');
	insert into player2ships(row,a,b,c,d,e,f) values(3,'U','U','U','U','U','U');
	insert into player2ships(row,a,b,c,d,e,f) values(4,'U','U','U','U','U','U');
	insert into player2ships(row,a,b,c,d,e,f) values(5,'U','U','U','U','U','U');
	insert into player2ships(row,a,b,c,d,e,f) values(6,'U','U','U','U','U','U');
	";

	$create = "
	drop table if exists player1attack;
	create table player1attack(
		row int,
		a varchar(1),
		b varchar(1),
		c varchar(1),
		d varchar(1),
		e varchar(1),
		f varchar(1)
	);";

	$create2 = "
	drop table if exists player2attack;
	create table player2attack(
		row int,
		a varchar(1),
		b varchar(1),
		c varchar(1),
		d varchar(1),
		e varchar(1),
		f varchar(1)
	);
	
	drop table if exists player1ships;
	create table player1ships(
		row int,
		a varchar(10),
		b varchar(10),
		c varchar(10),
		d varchar(10),
		e varchar(10),
		f varchar(10)
	);
	
	drop table if exists player2ships;
	create table player2ships(
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

	#Create and execute the SQL code
	$stmt = $conn->prepare($create);
	$stmt->execute();	
	$stmt = $conn->prepare($create2);
	$stmt->execute();
	$stmt = $conn->prepare($insert);
	$stmt->execute();
	
	#Close the connection to the server	
	$stmt->close();
	$conn->close();
}

?>
