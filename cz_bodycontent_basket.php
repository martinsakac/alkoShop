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

		$connection = mysqli_connect('localhost', 'root', 'root', 'alko_shop')
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
        echo "</td><td></td></tr>";

	?>
		
	</tbody>
</table>

<button style='margin-left: 20px;' class='btn btn-primary pull-right'>Objednať</button>
<button onclick='removeItemFromBasket(0, true)' class='btn btn-danger pull-right'>
	<span>Zmazať všetko </span>
	<span class='glyphicon glyphicon-trash'></span>
</button>



<div class="col-md-9">

	<form class="form-horizontal" role="form">
		<div class="form-group">
			<label for="inputBlock" class="col-sm-2 control-label">Blok</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="inputBlock" placeholder="Vložte označenie bloku, kde má byť objednávka doručená">
			</div>
		</div>
	</form>
	<form class="form-horizontal" role="form">
		<div class="form-group">
			<label for="inputRoom" class="col-sm-2 control-label">Číslo izby</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="inputRoom" placeholder="Izba č.">
			</div>
		</div>
	</form>
	<form class="form-horizontal" role="form">
		<div class="form-group">
			<label for="datepicker" class="col-sm-2 control-label">Dátum</label>
			<div class="col-md-10">
				<input type="text" class="form-control" id="datepicker" placeholder="Vyberte dátum, kedy si prajete aby Vám bola objednávka doručená">
			</div>
		</div>
	</form>
	<form class="form-horizontal" role="form">
		<div class="form-group">
			<label for="inputTime" class="col-sm-2 control-label">Čas</label>
			<div class="col-md-8">
				<input type="text" class="form-control" id="inputTime" placeholder="Vyberte čas, kedy si prajete aby Vám bola objednávka doručená">
			</div>
		</div>
	</form>

</div>


