<!DOCTYPE html>
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

</head>

<body>

<!-------------------------------------------- Top navigation bar ------------------------------------------>
    <?php require "cz_topNavBar.php"; ?>    

    <div class="container">
        <div class="row">

<!-------------------------------------------- Lavy navigacny panel -------------------------------------- -->
        <?php require "cz_leftNavBar.php"; ?>

            <div class="col-md-9">

<!-------------------------------------------- Carousel -------------------------------------------------- -->
                <?php require "carousel.php"; ?>

<!-------------------------------------------- Sekcia oblubene ------------------------------------------- -->
                <?php require "cz_favourites.php"; ?>

<!-------------------------------------------- Sekcia Pivo ----------------------------------------------- -->
                <?php require "cz_beers.php"; ?>

<!-------------------------------------------- Sekcia Vino ----------------------------------------------- -->
                <?php require "cz_wines.php"; ?>

<!-------------------------------------------- Sekcia Liehovin ------------------------------------------- -->
                <?php require "cz_spirits.php"; ?>
                
            </div>

        </div>

    </div> <!-- /.container -->
    
<!-------------------------------------------- Paticka ---------------------------------------------------->
    <?php require "cz_footer.php"; ?>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/myScript.js"></script>

</body>

</html>
