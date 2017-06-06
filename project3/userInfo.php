<?php
	include('functions.php');

	header('Content-Type: application/json');

	echo selectUser($_POST['token']);