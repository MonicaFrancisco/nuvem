<?php
	function insertUsers(){
		include ('connection.php');

		for ($x = 1; $x <= 20; $x++) {
			$random = rand(10000,90000);
			//$hash = password_hash('123', PASSWORD_DEFAULT);	

			$sql = "INSERT INTO User (userid_facebook, username, password, name)
			VALUES ($random, 'user $x', '$password', 'user $x')";

			if ($conn->query($sql) === TRUE) {
			    echo "New record created successfully <br>";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		
	}

	function insertMessages(){
		include ('connection.php');

		for ($x = 1; $x <= 20; $x++) {
			$random = rand(10000,90000);
			$sql = "INSERT INTO Message (userid, msg)
			VALUES (1, 'message $x')";

			if ($conn->query($sql) === TRUE) {
			    echo "New record created successfully <br>";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		
	}


	function selectUsers($strpesquisa = ''){
		include ('connection.php');
		require_once 'model/User.php';
		$arrayUsers = array();

		if ($strpesquisa==''){
			$sql = "SELECT * FROM User";
			$stmt = $conn->prepare($sql);
		}
		else {
			$sql = "SELECT * FROM User WHERE username like ?";

			$stmt = $conn->prepare($sql);
			$strpesquisa = '%' . $strpesquisa . '%';
			$stmt->bind_param("s", $strpesquisa);

		}
		
		$stmt->execute();

		$result = $stmt->get_result();

		if ($result->num_rows > 0) {

		    while($row = $result->fetch_assoc()) {

		    	$user = new User();

		    	$user->userid = $row["userid"];
				$user->userid_facebook = $row["userid_facebook"];
				$user->username = $row["username"];
				$user->name = $row["name"];
				if($row["img_photo"]==null){
					$user->img_photo = 'img_photo/unknown.png';
				}
				else {
					$user->img_photo = $row["img_photo"];
				}
				
				
				array_push($arrayUsers, $user);

		    }
		} else {
		    return json_encode([]);
		}


		return json_encode($arrayUsers);

		//var_dump($user);
		
	}


	function selectMessages($strname = '', $strmsg = ''){

		include ('connection.php');
		require_once 'model/Message.php';
		require_once 'model/User.php';

		$arrayMessages = array();

		if ($strname == '' && $strmsg == ''){ //Se não pesquisar
			$sql = "SELECT * FROM Message";
			$stmt = $conn->prepare($sql);
		}
		else if ($strname != '' && $strmsg == '') { //Se pesquisar apenas pelo nome
			$sql = "SELECT * FROM message JOIN user ON message.userid = user.userid WHERE username like ?";

			$stmt = $conn->prepare($sql);
			$strname = '%' . $strname . '%';
			$stmt->bind_param("s", $strname);

		}
		else if($strname == '' && $strmsg != ''){ //Se pesquisar apenas pela mensagem
			$sql = "SELECT * FROM message JOIN user ON message.userid = user.userid WHERE msg like ?";

			$stmt = $conn->prepare($sql);
			$strmsg = '%' . $strmsg . '%';
			$stmt->bind_param("s", $strmsg);
		}
		else if($strname != '' && $strmsg != ''){ //Se pesquisar pelos dois campos
			$sql = "SELECT * FROM message JOIN user ON message.userid = user.userid WHERE username like ? and msg like ?";

			$stmt = $conn->prepare($sql);
			$strname = '%' . $strname . '%';
			$strmsg = '%' . $strmsg . '%';
			$stmt->bind_param("ss", $strname, $strmsg);
		}
		
		$stmt->execute();

		$result = $stmt->get_result();

		if ($result->num_rows > 0) {

		    while($row = $result->fetch_assoc()) {

		    	$message = new Message();

				$message->msgid = $row["msgid"];
		    	$message->userid = $row["userid"];
				$message->msg = $row["msg"];
				$message->date_time = $row["date_time"];

				$queryUser = "select * from user where userid='".$row["userid"]."'";
				$resultUser = $conn->query($queryUser);

				
				if ($resultUser->num_rows > 0) {
					while($rowUser = $resultUser->fetch_assoc()) {
					    $message->username = $rowUser["username"];
						$message->img_photo = $rowUser["img_photo"];

						if($rowUser["img_photo"]==null){
							$message->img_photo = 'img_photo/unknown.png';
						}
						else {
							$message->img_photo = $rowUser["img_photo"];
						}
					}
				}


				array_push($arrayMessages, $message);

		    }
		} else {
		    return json_encode([]);
		}


		return json_encode($arrayMessages);

		//var_dump($user);
		
	}


	function register($username ='', $name='', $password='', $password2=''){
		include ('connection.php');

		if($username == "" || $name == "" || $password == "" || $password2 == ""){
		 	return json_encode("vazio");
		}
		else if( $password != $password2){
			return json_encode("passwords_diferentes");
		}
		else{
			//$hash = password_hash($password, PASSWORD_DEFAULT);	
			$sql = "INSERT INTO User (username, password, name)
			VALUES ('$username', '$password', '$name')";

			if ($conn->query($sql) == TRUE) {
			    return json_encode(true);
			} else {
				 return json_encode(false);
			}
		}

	}

	function login(){
		include ('connection.php');
		
		$username=$_POST ['username'];
		$password=$_POST ['password'];
		
		$sql = "select * from User where username = '".$username."'"; 
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		
		if (($result->num_rows > 0) && $password == $row['password'])
		{
			session_start();

			//echo password_verify($password, $row['password']);

			$_SESSION['user']=$row['username'];
			
			return json_encode(gerarToken());
		}
		else{
			return json_encode(false);
		}	

	}

	function UserInfFromToken ($tokenStr){
		require_once 'model/JWT.php';
		$token = JWT::decode($tokenStr, 'vbyjrygxer57de6dtgy5fhe5866e6v876v6vvd');
		return $token;
		//$token->userId;
		//$token->userName;

	}


	function gerarToken(){
		require_once 'model/JWT.php';
		$token = array();
		$token['userId'] = 22;
		$token['userName'] = "SSSSS";

		return JWT::encode($token, 'vbyjrygxer57de6dtgy5fhe5866e6v876v6vvd');
	}


?>