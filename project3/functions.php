<?php
	function selectUsers($strpesquisa = ''){
		include ('connection.php');
		require_once 'model/User.php';
		$arrayUsers = array();

		if ($strpesquisa==''){
			$sql = "SELECT * FROM User order by username asc";
			$stmt = $conn->prepare($sql);
		}
		else {
			$sql = "SELECT * FROM User WHERE username like ? order by username asc";

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
			$sql = "SELECT * FROM Message order by date_time desc";
			$stmt = $conn->prepare($sql);
		}
		else if ($strname != '' && $strmsg == '') { //Se pesquisar apenas pelo nome
			$sql = "SELECT * FROM message JOIN user ON message.userid = user.userid WHERE username like ? order by date_time desc";

			$stmt = $conn->prepare($sql);
			$strname = '%' . $strname . '%';
			$stmt->bind_param("s", $strname);

		}
		else if($strname == '' && $strmsg != ''){ //Se pesquisar apenas pela mensagem
			$sql = "SELECT * FROM message JOIN user ON message.userid = user.userid WHERE msg like ? order by date_time desc";

			$stmt = $conn->prepare($sql);
			$strmsg = '%' . $strmsg . '%';
			$stmt->bind_param("s", $strmsg);
		}
		else if($strname != '' && $strmsg != ''){ //Se pesquisar pelos dois campos
			$sql = "SELECT * FROM message JOIN user ON message.userid = user.userid WHERE username like ? and msg like ? order by date_time desc";

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
				$message->img = $row["img"];

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


	function register($u, $name, $p, $password2){
		include ('connection.php');

		if($u == "" || $name == "" || $p == "" || $password2 == ""){
		 	return json_encode("vazio");
		}
		else if( $p != $password2){
			return json_encode("passwords_diferentes");
		}
		else{
			//$hash = password_hash($password, PASSWORD_DEFAULT);	
			$sql = "INSERT INTO User (username, password, name)
			VALUES ('$u', '$p', '$name')";

			if ($conn->query($sql) == TRUE) {
			    return json_encode(true);
			} else {
				return json_encode(false);
			}
		}

	}

	function login($user, $pass){
		include ('connection.php');
		
		$sql = "select * from User where username = '".$user."'"; 
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if (($result->num_rows > 0) && $pass == $row['password'])
		{
			//echo password_verify($password, $row['password']);
			return json_encode(gerarToken($row['userid'], $row['username']));
		}
		else{
			return json_encode(false);
		}	

	}


	function gerarToken($userid, $username){
		require_once 'model/JWT.php';
		$token = array();
		$token['userId'] = $userid;
		$token['userName'] = $username;

		return JWT::encode($token, 'vbyjrygxer57de6dtgy5fhe5866e6v876v6vvd');
	}

	function userInfFromToken($tokenStr){
		require_once 'model/JWT.php';
		$token = JWT::decode($tokenStr, 'vbyjrygxer57de6dtgy5fhe5866e6v876v6vvd');
		return json_encode($token->userName);
		//$token->userId;
	}

	function userIDFromToken($tokenStr){
		require_once 'model/JWT.php';
		$token = JWT::decode($tokenStr, 'vbyjrygxer57de6dtgy5fhe5866e6v876v6vvd');
		return json_encode($token->userId);
	}

	function selectUser($tokenStr){
		include ('connection.php');
		require_once 'model/User.php';

		$userid = userIDFromToken($tokenStr);

		$sql = "SELECT * FROM User WHERE userid=$userid";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if ($result->num_rows > 0) {

	    	$user = new User();
			$user->username = $row["username"];
			$user->name = $row["name"];
			if($row["img_photo"]==null){
				$user->img_photo = 'img_photo/unknown.png';
			}
			else {
				$user->img_photo = $row["img_photo"];
			}

			return json_encode($user);

		} else {
		    return json_encode(null);
		}
	}

	function updateUser($tokenStr, $user, $name, $img){
		include ('connection.php');
		require_once 'model/User.php';

		$userid = userIDFromToken($tokenStr);

		$sql = "UPDATE User SET username='$user', name='$name' WHERE userid=$userid";

		if ($conn->query($sql) == TRUE) {
			return json_encode(true);

		} else {
		   return json_encode(false);
		}

	}

	function updatePass($tokenStr, $old, $new, $repeatnew){
		include ('connection.php');
		require_once 'model/User.php';

		$userid = userIDFromToken($tokenStr);

		$sql = "select * from User WHERE userid=$userid"; 
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if($old == "" || $new == "" || $repeatnew == ""){
			return json_encode("vazio");
		}
		else if($new != $repeatnew){
			return json_encode("passwords_diferentes");
		}
		else if($old != $row['password']){
			return json_encode("password_errada");
		}
		else{
			$sql = "UPDATE User SET password='$new' WHERE userid=$userid";

			if ($conn->query($sql) == TRUE) {
				return json_encode(true);

			} else {
			    return json_encode(false);
			}
		}
	}

	function insertMessage($tokenStr, $msg){

		include ('connection.php');

		$userid = userIDFromToken($tokenStr);


		if($msg == ""){
			return json_encode("vazio");
		}
		else{
			$sql = "INSERT INTO Message (userid, msg)
			VALUES ($userid, '$msg')";

			if ($conn->query($sql) == TRUE) {
				return json_encode(true);
			} else {
			    return json_encode(false);
			}
		}
		
	}


	function selectMessagesUser($tokenStr){

		include ('connection.php');
		require_once 'model/Message.php';

		$userid = userIDFromToken($tokenStr);

		$arrayMessages = array();

		$sql = "SELECT * FROM message WHERE userid=$userid order by date_time desc";
		$result = $conn->query($sql);
	

		if ($result->num_rows > 0) {

		    while($row = $result->fetch_assoc()) {

		    	$message = new Message();

				$message->msg = $row["msg"];
				$message->date_time = $row["date_time"];
				$message->img_photo = $row["img_photo"];
				$message->img = $row["img"];


				array_push($arrayMessages, $message);

		    }
		} else {
		    return json_encode([]);
		}


		return json_encode($arrayMessages);		
	}

	
	function selectFriendsUser($tokenStr){

		include ('connection.php');
		require_once 'model/User.php';

		$userid = userIDFromToken($tokenStr);

		$arrayFriends = array();

		$sql = "SELECT * FROM Friend JOIN User ON userid1=userid WHERE userid1=$userid";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		   
	    		$sqlFriend = "SELECT * FROM User WHERE userid='".$row["userid2"]."'";
				$resultFriend = $conn->query($sqlFriend);
				$rowFriend = $resultFriend->fetch_assoc();

				$user = new User();

				$user->username = $rowFriend["username"];

				if($rowFriend["img_photo"]==null){
					$user->img_photo = 'img_photo/unknown.png';
				}
				else {
					$user->img_photo = $rowFriend["img_photo"];
				}

		    	array_push($arrayFriends, $user);

		    }
		} else {
		    return json_encode([]);
		}

		return json_encode($arrayFriends);	

	}

	function addRequest($token, $id){

		include ('connection.php');

		$userid = userIDFromToken($tokenStr);


		$sql = "INSERT INTO friend_request (userid1, userid2)
		VALUES ($userid, '$id')";

		if ($conn->query($sql) == TRUE) {
			return json_encode(true);
		} else {
		    return json_encode(false);
		}

	}

?>