<?php
	include('functions.php');

	header('Content-Type: application/json');


	echo register($_POST['username'], $_POST['name'], $_POST['password'], $_POST['password2']);