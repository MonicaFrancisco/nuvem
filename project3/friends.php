<?php
	include('functions.php');

	header('Content-Type: application/json');

	echo selectFriendsUser($_GET['token']);
	