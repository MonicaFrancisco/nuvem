<?php
	include('functions.php');

	header('Content-Type: application/json');

	echo login($_POST['username'], $_POST['password']);