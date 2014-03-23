<?php 

	session_start();

	$item = $_REQUEST['item_id'];
	$quantity = $_REQUEST['quantity'];
	$_SESSION['basket'][$item] = $quantity;

	$connection = mysqli_connect('localhost', 'root', 'root', 'alko_shop')
                        or die ('Could not connect: ') . mysql_error();
    $sucetCelkom = 0;
    foreach ($_SESSION['basket'] as $item=>$quantity) {
		$my_query = "SELECT * FROM product as p WHERE p.id_product = " . $item;
		$result = mysqli_query($connection, $my_query);
		while ($row = mysqli_fetch_array($result)) {
			$sucetCelkom += $quantity * $row['price'];
		}
	}

	echo $sucetCelkom;
?>