<?php
	include('functions.php');

	header('Content-Type: application/json');

	echo updatePass($_POST['token'], $_POST['old'], $_POST['new'], $_POST['repeatnew']);