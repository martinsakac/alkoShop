<?php 

	session_start();

	if ($_REQUEST['all'] == 'true'){
		$_SESSION['basket'] = array();	
	}
	else {
		$item = $_REQUEST['item_id'];
		if (array_key_exists($item, $_SESSION['basket'])) {
			unset($_SESSION['basket'][$item]);
		}	
	}

	echo "(" . count($_SESSION['basket']) . ")";

?>