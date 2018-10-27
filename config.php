<?php
	
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(E_ALL);

	//conection
	$dbh = new PDO('mysql:host=localhost;dbname=securelogin', 'root','patrick25');

	//statement
	$stmt = $dbh->prepare("SELECT * FROM users");
	$stmt->execute();	 


	//method of getting results as an array
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

	//for every returned result ... get the array of user_username
	foreach ($rows as $row) {
		echo $row['user_username'];
	}

?>