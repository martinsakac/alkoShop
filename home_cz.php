<!DOCTYPE html>

<?php require "php/startSession.php"; ?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alko shop</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="favicon/favicon.ico">

    <!-- Jquery UI -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

    <!-- time picker -->
    <link href="css/timepicker-addon.css" rel="stylesheet">

</head>

<body>

<!-------------------------------------------- Top navigation bar ------------------------------------------>
    <?php require "cz_topNavBar.php"; ?>    

    <div class="container">
        <div class="row">

<!-------------------------------------------- Lavy navigacny panel -------------------------------------- -->
        <?php require "cz_leftNavBar.php"; ?>

            <div class="col-md-9">

                <!-- Obsah tela -->
                <?php 
                    if ((!isset($_REQUEST['tab']) && $_SESSION['tab'] == "home") || (isset($_REQUEST['tab']) && $_REQUEST['tab'] == "home")) {
                        require "carousel.php";
                        require "cz_favourites.php";
                        require "cz_beers.php"; 
                        require "cz_wines.php";
                        require "cz_spirits.php";
                    }

                    if (isset($_REQUEST['tab']) && $_REQUEST['tab'] == "about") {
                        require "cz_bodycontent_about.php";
                    }

                    if (isset($_REQUEST['tab']) && $_REQUEST['tab'] == "contact") {
                        require "cz_bodycontent_contact.php";
                    }

                    if (isset($_REQUEST['tab']) && $_REQUEST['tab'] == "basket") {
                        require "cz_bodycontent_basket.php";
                    }
                ?>
                
            </div>

        </div>

    </div> <!-- /.container -->
         
    
<!-------------------------------------------- Paticka ---------------------------------------------------->
    <?php require "cz_footer.php"; ?>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/myScript.js"></script>

    <!--  Jquery + Jquery UI-->
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/timepicker-addon.js"></script>

</body>

</html>
