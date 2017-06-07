<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	// Create database
	$sql = "CREATE DATABASE IF NOT EXISTS socialnetwork";
	if ($conn->query($sql) === TRUE) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}


	mysqli_select_db($conn, "socialnetwork");

	// sql to create table user
	$user = "CREATE TABLE IF NOT EXISTS User (
	userid INT NOT NULL AUTO_INCREMENT, 
	userid_facebook INT,
	username VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL,
	name VARCHAR(50),
	img_photo VARCHAR(100),
	PRIMARY KEY (userid)
	)";

	if ($conn->query($user) === TRUE) {
	    echo "Table user created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	// sql to create table message
	$message = "CREATE TABLE IF NOT EXISTS Message (
	msgid INT NOT NULL AUTO_INCREMENT, 
	userid INT NOT NULL,
	date_time timestamp NOT NULL default CURRENT_TIMESTAMP,
	msg VARCHAR(500) NOT NULL,
	img VARCHAR(100),
	img_original VARCHAR(100),
	PRIMARY KEY (msgid),
	FOREIGN KEY (userid) REFERENCES User(userid)
	)";

	if ($conn->query($message) === TRUE) {
	    echo "Table message created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	// sql to create table friend
	$friend = "CREATE TABLE IF NOT EXISTS Friend (
	userid1 INT NOT NULL, 
	userid2 INT NOT NULL,
	FOREIGN KEY (userid1) REFERENCES User(userid),
	FOREIGN KEY (userid2) REFERENCES User(userid)
	)";

	if ($conn->query($friend) === TRUE) {
	    echo "Table friend created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	// sql to create table friend_request
	$friend_request = "CREATE TABLE IF NOT EXISTS Friend_request (
	userid1 INT NOT NULL, 
	userid2 INT NOT NULL,
	FOREIGN KEY (userid1) REFERENCES User(userid),
	FOREIGN KEY (userid2) REFERENCES User(userid)
	)";

	if ($conn->query($friend_request) === TRUE) {
	    echo "Table Friend_request created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	include ('insertdata.php');
	insertUsersManually();
	insertUsers();
	insertFriends();
	insertMessages();

	$conn->close();
?>