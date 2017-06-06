<?php
	include('functions.php');

	header('Content-Type: application/json');

	echo userInfFromToken($_GET['token']);