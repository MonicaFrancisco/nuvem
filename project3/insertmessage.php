<?php
	include('functions.php');

	header('Content-Type: application/json');

	echo insertMessage($_POST['token'], $_POST['msg']);