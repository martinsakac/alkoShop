<!--  koniec col-md-9 -->
</div>
<!-- koniec row -->
</div>
<!-- koniec container -->
</div>

<?php 
	
	$email = "";
	$message = "";

	$generalSuccess = "";
	$generalError = "";

	$errorMessage = "Vaša správa nebola odoslaná.";
	$successMessage = "Vaša správa bola odoslaná.";

	$emailTo = "info@alko4you.cz";
	$emailSubject = "Dotaz zo stranky";

	function test_input($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		// overenie mailu
		if (empty($_POST['contact-form-email'])) {
			$generalError = $errorMessage . " Email je povinný údaj!";
		}
		else {
			$email = test_input($_POST['contact-form-email']);
			if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
				$generalError = $errorMessage . " Nesprávny formát emailovej adresy.";
			}
		}

		//overenie spravy
		if (empty($_POST['contact-form-message'])) {
			if ($generalError != "") {
				$generalError = $generalError . " Telo správy je prázdne.";
			}
			else {
				$generalError = $errorMessage . " Telo správy je prázdne.";
			}
		}
		else {
			$message = test_input($_POST['contact-form-message']);
		}

		// poslanie mailu
		if ($generalError == "") {
			$generalSuccess = $successMessage;
			$emailHlavicka = "From: " . $email;
			$emailHlavicka .= "\nMIME-Version: 1.0\n";
			$emailHlavicka .= "Content-Type: text/html; charset=\"utf-8\"\n";
			mb_send_mail($emailTo, $emailSubject, $message, $emailHlavicka);
		}
	}

?>

<div id="contact-map" class="map">
    <iframe width="100%" height="300px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
	    src="https://mapsengine.google.com/map/embed?mid=ziyEDp5CV4eI.kH-cyJ3hN4uc"></iframe>
	    <br />
	    <small>
	        <a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a>
	    </small>
    </iframe>
</div>

<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <ul class="list-inline">
                <li><a class="fa fa-facebook fa-3x" title="Naša Facebook stránka"></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
    	<div class="col-md-6 col-md-offset-3 text-center">
    		<h2 class="contact-form-title intro-text">Kontaktný formulár</h2>
	    	<!-- <h5>Nevájte nás kontaktovať pri akomkoľvek dotaze</h5> -->
	    	<?php 
	    		if ($generalError != '') {
	    			echo "<div class='alert alert-danger alert-dismissable'>
				    		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>" . $generalError . "
				    	</div>";	
	    		}
	    		if ($generalSuccess != '') {
	    			echo "<div class='alert alert-success alert-dismissable'>
				    		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>" . $generalSuccess . "
				    	</div>";
	    		}

	    	?>

	    	<form method="post" action="home_cz.php?tab=contact" class="contact-form form-vertical" role="form">
		    	<div class="form-group">
		    		<label for="contact-form-email control-label">Email</label>
		    		<input name="contact-form-email" type="email" class="form-control" placeholder="Adresa. na ktorú Vám odošleme odpoveď" 
		    			value="<?php if ($generalError != '') echo $email; ?>">
		    	</div>
		    	<div class="form-group">
		    		<label for="contact-form-message control-label">Správa</label>
		    		<textarea name="contact-form-message" class="form-control" rows="3" my="params"><?php if ($generalError != '') echo $message; ?></textarea>
		    	</div>
		    	<div class="form-group">
		    		<button type="reset" class='btn btn-default' value="Reset">Reset</button>
		    		<button type='submit' class='btn btn-primary'>Odoslať správu</button>
		    	</div>
	    	</form>
    	</div>
    </div>

</div>

<!-- zaciatok prerusenych divov -->
<div>
<div>
<div>