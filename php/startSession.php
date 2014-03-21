<?php 

	session_start();

	if (!isset($_SESSION['tab']))
	{
		$_SESSION['tab'] = "home";	
	}

	if (!isset($_SESSION['basket']))
	{
		$_SESSION['basket'] = array();
	}

	// if (!isset($_SESSION['selected_tab']))
	// {
	// 	$_SESSION['selected_tab'] = "";
	// }

?>