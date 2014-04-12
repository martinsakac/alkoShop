<h3>Váš košík</h3>
<table class='table table-striped'>
	<thead>
		<tr>
			<th>#</th>
			<th>Produkt</th>
			<th>Cena</th>
			<th>Počet kusov</th>
			<th>Cena spolu</th>
		</tr>
	</thead>
	<tbody>
	<?php 

		$hostName = "localhost";
		$userName = "root";
		$password = "root";
		$dbName = "alko_shop";

		$connection = mysqli_connect($hostName, $userName, $password, $dbName)
                        or die ('Could not connect: ') . mysql_error();
        $counter = 1;
        $sucetHodnotyTovaru = 0;

        foreach ($_SESSION['basket'] as $item=>$quantity) {
        	$my_query = "SELECT * FROM product as p WHERE p.id_product = " . $item;
        	$result = mysqli_query($connection, $my_query);

        	while ($row = mysqli_fetch_array($result)) {
        		echo "<tr>";
	        	echo "<td>" . $counter++ . "</td>";
	        	echo "<td>" . $row['name'] . "</td>";
	        	echo "<td><span id='price" . $row['id_product'] . "'>" . $row['price'] . "</span><span> Kč</span>" ."</td>";
	        	echo "<td><select id='" . "select" . $row['id_product'] ."' onchange='updateQuantity(" . $row['id_product'] . ")' class='form-control my-numberselect'>";
	        	switch ($quantity) {
	        		case "1": echo "<option selected>1</option><option>2</option><option>3</option>
  									<option>4</option><option>5</option>";
  									break;
  					case "2": echo "<option>1</option><option selected>2</option><option>3</option>
  									<option>4</option><option>5</option>";
  									break;
  					case "3": echo "<option>1</option><option>2</option><option selected>3</option>
  									<option>4</option><option>5</option>";
  									break;
  					case "4": echo "<option>1</option><option selected>2</option><option>3</option>
  									<option selected>4</option><option>5</option>";
  									break;
  					case "5": echo "<option selected>1</option><option>2</option><option>3</option>
  									<option>4</option><option selected>5</option>";
  									break;
	        	}
	        	echo "</select></td>";
	        	echo "<td id='" . "priceSum".$row['id_product'] . "'>" . $row['price']*$quantity . " Kč" . "</td>";
  				echo "<td><button onclick='removeItemFromBasket(" . $row['id_product'] . ", false)' class='btn btn-danger pull-right' title='Zmazať'>";
  				echo "<span class='glyphicon glyphicon-trash'></span></button></td>";
	        	echo "</tr>";
	        	$sucetHodnotyTovaru += $row['price'] * $quantity;
        	}
        }

        echo "<tr><td></td><td class='boldFont'>";
        echo "Súčet celkom";
        echo "</td><td></td><td></td><td id='sucetCelkom' class='boldFont'>";
        echo $sucetHodnotyTovaru . " Kč";
        echo 	"</td><td><button onclick='removeItemFromBasket(0, true)' class='btn btn-danger pull-right'>
							<span>Zmazať všetko </span>
							<span class='glyphicon glyphicon-trash'></span>
						  </button>
				</td></tr>";

	?>
		
	</tbody>
</table>

<!-- <button style='margin-left: 20px;' class='btn btn-primary pull-right'>Objednať</button> -->


<!---------------------------- Spracovanie formularu  ---------------------------------------->
<?php 
	
	$errorsCount = 0;

	$generalSuccess = "";
	$generalError0 = "";

	$generalError1 = "<p class='alert alert-danger my-error-message'>";
	$generalError2 = "</p>";

	$glyphiconOk = "<span class='glyphicon glyphicon-ok form-control-feedback'></span>";
	$glyphiconError = "<span class='glyphicon glyphicon-remove form-control-feedback'></span>";

	$blockGlyphicon = "";
	$roomGlyphicon = "";
	$dateGlyphicon = "";
	$timeGlyphicon = "";
	$emailGlyphicon = "";

	$errorBlockMessage = "";
	$errorRoomMessage = "";
	$errorDateMessage = "";
	$errorTimeMessage = "";
	$errorEmailMessage = "";

	$block = "";
	$room = "";
	$date = "";
	$time = "";
	$email = "";
	$note = "";

// oreze biele znaky, odstrani lomitka, escapuje vsetky funkcne znaky
	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// overenie spravnosti bloku	
		if (empty($_POST['block'])) {
			$errorBlockMessage = $generalError1 . "Blok je povinný údaj!" . $generalError2;
			$blockGlyphicon = $glyphiconError;
			$errorsCount++;
		}
		else {
			$block = test_input($_POST['block']);
			$bloky = array("otava", "vltava", "blanica", "volha", "sazava", "sázava");
			if (in_array(strtolower($block), $bloky)) {
				$blockGlyphicon = $glyphiconOk;
			}
			else {
				$errorBlockMessage = $generalError1 . "Neplatný vstup!" . $generalError2;
				$blockGlyphicon = $glyphiconError;
				$errorsCount++;
			}
		}

	// overenie spravnosti izby
		if (empty($_POST['room'])) {
			$errorRoomMessage = $generalError1 . "Izba je povinný údaj!" . $generalError2;
			$roomGlyphicon = $glyphiconError;
			$errorsCount++;
		}		
		else {
			$room = test_input($_POST['room']);
			if (!preg_match("/^[0-9]*$/", $room)) {
				$errorRoomMessage = $generalError1 . "Neplatný vstup!". $generalError2;
				$roomGlyphicon = $glyphiconError;
				$errorsCount++;
			}
			else {
				$roomGlyphicon = $glyphiconOk;
			}
		}

	// overenie datumu 
		if (empty($_POST['date'])) {
			$errorDateMessage = $generalError1 . "Dátum je povinný údaj!" . $generalError2;
			$dateGlyphicon = $glyphiconError;
			$errorsCount++;
		}
		else {
			$date = test_input($_POST['date']);
			$splitDate = explode("-", $date);
			$today = date("j-n-Y");
			if (!checkdate($splitDate[1], $splitDate[0], $splitDate[2]) || strlen($splitDate[2]) != 4){
				$errorDateMessage = $generalError1 . "Neplatný vstup!!" . $generalError2;
				$dateGlyphicon = $glyphiconError;
				$errorsCount++;
			}
			else {
				if (strtotime($date) < strtotime($today)) {
					$errorDateMessage = $generalError1 . "Neplatný vstup!!" . $generalError2;
					$dateGlyphicon = $glyphiconError;
					$errorsCount++;
				}
				else {
					$dateGlyphicon = $glyphiconOk;
				}
			}
		}

	// overenie casu 
		if (empty($_POST['time'])) {
			$errorTimeMessage = $generalError1 . "Čas je povinný údaj!" . $generalError2;
			$timeGlyphicon = $glyphiconError;
			$errorsCount++;
		}
		else {
			$time = test_input($_POST['time']);
			$splitTime = explode(":", $time);
			if (count($splitTime) == 2 && $splitTime[0] >= 0 && $splitTime[0] <= 24 && strlen($splitTime[0]) == 2 
					&& $splitTime[1] >= 0 && $splitTime[1] <= 60 && strlen($splitTime[1]) == 2){
				$timeGlyphicon = $glyphiconOk;
			}
			else {
				$errorTimeMessage = $generalError1 . "Neplatný vstup!" . $generalError2;
				$timeGlyphicon = $glyphiconError;
				$errorsCount++;
			}
		}
	// overenie emailu
		if (!empty($_POST['email'])) {
			$email = test_input($_POST['email']);
			if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)){
		        $errorEmailMessage = $generalError1 . "Neplatný vstup!" . $generalError2;
		        $emailGlyphicon = $glyphiconError;
		        $errorsCount++;
		    }
		    else {
		    	$emailGlyphicon = $glyphiconOk;
		    }
		}

	// osestrenie a nastavenie poznamky
		if (!empty($_POST['note'])) {
			$note = test_input($_POST['note']);
		}

		if (count($_SESSION['basket']) > 0) {
			if ($errorsCount == 0){
				$insertQuery = "INSERT INTO `order`(order_date, order_time, block, room, chosen_date, chosen_time, email, description) 
					values(current_date(), current_time(), '". $block ."', '". $room ."', str_to_date('". $date ."', '%d-%m-%Y'), str_to_date('". $time ."', '%h:%i:%s'), '". $email ."', '". $note ."')";
				$getIdQuery = "select last_insert_id()";

				mysqli_query($connection, $insertQuery);
				$orderId = mysqli_query($connection, $getIdQuery);
				$orderIdValue = mysqli_fetch_array($orderId);

				foreach ($_SESSION['basket'] as $product => $quantity) {
					$insertQuery2 = "INSERT INTO `order_product`(id_order, id_product, quantity) VALUES('". $orderIdValue[0] ."', '". $product ."', '". $quantity ."')";
					mysqli_query($connection, $insertQuery2);
				}	
				$_SESSION['basket'] = array();
				mysqli_close($connection);
				$generalSuccess = 	"<div style='margin-top: 15px;' class='alert alert-success alert-dismissable'>
	  									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	  									<strong>Gratulujeme!</strong> Vaša objednávka bola spracovaná. Očakávajte jej doručenie.
									</div>";
			}
		}
		else {
			$generalError0 = 	"<div style='margin-top: 15px;' class='alert alert-danger alert-dismissable'>
	  								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	  								<strong>Ups!</strong> Váš košík je prázdny. Objednávka nebola odoslaná.
								</div>";
		}

		
		// $headers = "From: " . $email;
		// $headers = "\nMIME-Version: 1.0\n";
		// $headers .= "Content-Type: text/html; charset=\"utf-8\"\n";
		// $headers .= 'From: sakac.m@hotmail.com' . '\r\n';
		// mail('sakac.m@gmail.com','test subject','test body',$headers);

		// $message = "Ahoj.";
		// mail("sakac.m@gmail.com", "pokus", $message, "From: alkoshop@alkoshop.cz\n");
	// koniec pasaze na spracovanie odoslaneho formulara	
	}

?>


<div class="col-md-12">

	<?php
		echo $generalSuccess;
		echo $generalError0;	
	?>

	<h3>Prosím vyplňte objednávací formulár</h3>

	<form method="post" action="home_cz.php?tab=basket" class="form-horizontal" role="form">
		<div class='form-group'>
			<div class='col-sm-offset-2 col-sm-8'>
				<h6 class='required-field'>(Touto farbou sú vyznačené povinné údaje.)</h6>
			</div>
		</div>
		<div class="form-group">
			<label for="inputBlock" class="col-sm-2 control-label required-field">Blok</label>
			<div class="col-sm-8 has-feedback <?php if($errorBlockMessage != ''){ echo 'has-error';} 
					if ($errorBlockMessage == '' && $errorsCount > 0) { echo 'has-success';}?>">
				<input value="<?php if ($errorsCount > 0){ echo $block; } ?>" name='block' type="text" 
					class="form-control" id="inputBlock" placeholder="Označenie bloku, kde má byť objednávka doručená.">
				<?php 
					if ($errorsCount > 0 && $block != ''){
						echo $blockGlyphicon;	
					}
					echo $errorBlockMessage;
				?>
			</div>
		</div>
		<div class="form-group">
			<label for="inputRoom" class="col-sm-2 control-label required-field">Číslo izby</label>
			<div class="col-sm-8 has-feedback <?php if($errorRoomMessage != ''){ echo 'has-error';} 
					if ($errorRoomMessage == '' && $errorsCount > 0) { echo 'has-success';}?>">
				<input value="<?php if ($errorsCount > 0){ echo $room; } ?>" name='room' type="text" 
					class="form-control" id="inputRoom" placeholder="Číslo izby, kde má byť objednávka doručená.">
				<?php 
					if ($errorsCount > 0 && $room != ''){
						echo $roomGlyphicon;
					}
					echo $errorRoomMessage;
				?>
			</div>
		</div>
		<div class="form-group">
			<label for="datepicker" class="col-sm-2 control-label required-field">Dátum</label>
			<div class="col-md-8 has-feedback <?php if($errorDateMessage != ''){ echo 'has-error';} 
					if ($errorDateMessage == '' && $errorsCount > 0) { echo 'has-success';}?>">
				<input value="<?php if ($errorsCount > 0){ echo $date; } ?>" name='date' type="text" 
					class="form-control" id="datepicker" placeholder="Dátum, kedy má objednávka doručená.">
				<?php 
					if ($errorsCount > 0 && $date != '') {
						echo $dateGlyphicon;
					}
					echo $errorDateMessage;
				?>
			</div>
		</div>
		<div class="form-group">
			<label for="inputTime" class="col-sm-2 control-label required-field">Čas</label>
			<div class="col-md-8 has-feedback <?php if($errorTimeMessage != ''){ echo 'has-error';} 
					if ($errorTimeMessage == '' && $errorsCount > 0) { echo 'has-success';}?>">
				<input value="<?php if ($errorsCount > 0){ echo $time; } ?>" name='time' type="text" 
					class="form-control" id="timepicker" placeholder="Čas, kedy má byť objednávka doručená.">
				<?php
					if ($errorsCount > 0 && $time != '') {
						echo $timeGlyphicon;
					} 
					echo $errorTimeMessage;
				?>
			</div>
		</div>
		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Email</label>
			<div class="col-md-8 has-feedback <?php if($errorEmailMessage != ''){ echo 'has-error';} 
					if ($errorEmailMessage == '' && $errorsCount > 0 && $email != '') { echo 'has-success';}?>">
				<input value="<?php if ($errorsCount > 0){ echo $email; } ?>" name='email' type="email" 
					class="form-control" id="inputEmail" placeholder="Adresa, na ktorú si prajete zaslať sumarizačný mail.">
				<?php 
					if ($errorsCount > 0 && $email != '') {
						echo $emailGlyphicon;
					}
					echo $errorEmailMessage;
				?>
			</div>
		</div>
		<div class="form-group">
			<label for="inputNote" class="col-sm-2 control-label">Poznámka</label>
			<div class="col-md-8">
				<textarea name='note' rows="3" my="params" 
					class="form-control" id="inputNote" ><?php if ($errorsCount > 0){ echo $note; } ?></textarea>
			</div>
		</div>
		<div class='form-group'>
			<div class='col-sm-offset-2 col-sm-10'>
				<button type='submit' class='btn btn-primary'>Odoslať objednávku</button>
				<button type="reset" class='btn btn-default' value="Reset">Reset</button>
			</div>
		</div>
	</form>

</div>


