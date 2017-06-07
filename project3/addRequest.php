<?php
	include('functions.php');

	header('Content-Type: application/json');

	echo addRequest($_POST['token'],$_POST['id']);
	