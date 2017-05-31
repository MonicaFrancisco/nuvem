<?php
	include('functions.php');

	header('Content-Type: application/json');

	//echo  json_encode($_SERVER);

	if (isset($_GET['name'])) {
		echo selectUsers($_GET['name']);		
	}
	else {
		echo selectUsers('');
	}
	

