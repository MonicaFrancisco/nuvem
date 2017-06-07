<?php
	include('functions.php');

	header('Content-Type: application/json');

	echo selectMessagesUser($_GET['token']);