<?php
	include('functions.php');

	header('Content-Type: application/json');

	echo updateUser($_POST['token'], $_POST['user'], $_POST['name'], $_POST['img']);