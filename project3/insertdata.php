<?php

	function insertUsersManually(){
		include ('connection.php');

		$sql = "INSERT INTO User (username, password, name, img_photo) VALUES ('User A0', '123', 'User A0','img_photo/428.jpg')";
		$conn->query($sql);
		$sql = "INSERT INTO User (username, password, name, img_photo) VALUES ('User A1', '123', 'User A1','img_photo/431.jpg')";
		$conn->query($sql);
		$sql = "INSERT INTO User (username, password, name, img_photo) VALUES ('User A2', '123', 'User A2','img_photo/435.jpg')";
		$conn->query($sql);
		$sql = "INSERT INTO User (username, password, name, img_photo) VALUES ('User A3', '123', 'User A3','img_photo/438.png')";
		$conn->query($sql);
		$sql = "INSERT INTO User (username, password, name, img_photo) VALUES ('User A4', '123', 'User A4','img_photo/443.jpg')";
		$conn->query($sql);
		$sql = "INSERT INTO User (username, password, name, img_photo) VALUES ('User A5', '123', 'User A5','img_photo/431.jpg')";
		$conn->query($sql);
		$sql = "INSERT INTO User (username, password, name, img_photo) VALUES ('User A6', '123', 'User A6','img_photo/512.png')";
		$conn->query($sql);
		$sql = "INSERT INTO User (username, password, name, img_photo) VALUES ('User A7', '123', 'User A7','img_photo/522.jpg')";
		$conn->query($sql);
		$sql = "INSERT INTO User (username, password, name, img_photo) VALUES ('User A8', '123', 'User A8','img_photo/530.jpg')";
		$conn->query($sql);
		$sql = "INSERT INTO User (username, password, name, img_photo) VALUES ('User A9', '123', 'User A9','img_photo/506.jpg')";
		$conn->query($sql);
	}

	function insertUsers(){
		include ('connection.php');

		for ($x = 1; $x <= 20; $x++) { //Mudar para 20000
			$random = rand(10000,90000);

			$sql = "INSERT INTO User (userid_facebook, username, password, name)
			VALUES ($random, 'user $x', '123', 'user $x')";

			if ($conn->query($sql) === TRUE) {
			    echo "New record created successfully <br>";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}

	function insertFriends(){
		include ('connection.php');

		$sql = "select * from user";
		$result= $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) { //Todos os users
				for ($x = 1; $x <= 20; $x++) {
					$friendid = rand(1,20); //Mudar para 20000
				    $sqlFriends = "INSERT INTO Friend (userid1, userid2)
					VALUES ('".$row["userid"]."', '".$friendid."')";
					$conn->query($sqlFriends);
				}
			}
		}
	}


	function insertMessages(){
		include ('connection.php');

		$sql = "select * from user";
		$result= $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) { //Todos os users
				for ($x = 1; $x <= 10; $x++) { //10 sms
					$usersrand = rand(1,20); //Mudar para 20000
				    $sqlMessages = "INSERT INTO Message (userid,msg)
					VALUES ('".$usersrand."', 'message $x')";

					if ($conn->query($sqlMessages) == TRUE) {
					    echo "New record created successfully <br>";
					} else {
					    echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			}
		}
		
	}

