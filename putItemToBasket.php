<?php 
	
	session_start();
	$item = $_REQUEST['item_id'];
	$_SESSION['basket'][$item] = "1";
	//array_push($_SESSION['basket'], $_REQUEST['item_id']);
	echo "(" . count($_SESSION['basket']) . ")";

?>