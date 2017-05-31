<?php
	include('functions.php');

	header('Content-Type: application/json');


	echo register($_GET['username'], $_GET['name'], $_GET['password'], $_GET['password2']);