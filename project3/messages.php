<?php
	include('functions.php');

	header('Content-Type: application/json');

	if (isset($_GET['username']) && !isset($_GET['msg'])) {
		echo selectMessages( $_GET['username'],'');		
	}
	else if (isset($_GET['msg']) && !isset($_GET['username'])) {
		echo selectMessages( '',$_GET['msg']);		
	}
	else if (isset($_GET['username']) && isset($_GET['msg'])) {
		echo selectMessages($_GET['username'], $_GET['msg']);		
	}
	else {
		echo selectMessages('','');

	}
	
	
	
