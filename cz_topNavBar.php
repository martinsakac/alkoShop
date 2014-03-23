<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home_cz.php?tab=home">Alko shop</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">  
                <li><a href="home_en.php">English</a></li>
                <?php
                    $itemsCount = count($_SESSION['basket']);

                    if ((!isset($_REQUEST['tab']) && $_SESSION['tab'] == "home") || (isset($_REQUEST['tab']) && $_REQUEST['tab'] == "home")) {
                        echo "<li><a href='home_cz.php?tab=home'><span class='active-tab'>Domov</span></a></li>";
                        echo "<li><a href='home_cz.php?tab=about'>O nás</a></li>";
                        echo "<li><a href='home_cz.php?tab=contact'>Kontakt</a></li>";
                        echo "<li><a href='home_cz.php?tab=basket'><span class='glyphicon glyphicon-shopping-cart glyphicon-gray'></span><span id='basketCount'> (" . $itemsCount . ")</span></a></li>";
                    }
                    if (isset($_REQUEST['tab']) && $_REQUEST['tab'] == "about") {
                        echo "<li><a href='home_cz.php?tab=home'><span>Domov</span></a></li>";
                        echo "<li><a href='home_cz.php?tab=about'><span class='active-tab'>O nás</span></a></li>";
                        echo "<li><a href='home_cz.php?tab=contact'>Kontakt</a></li>";
                        echo "<li><a href='home_cz.php?tab=basket'><span class='glyphicon glyphicon-shopping-cart glyphicon-gray'></span><span id='basketCount'> (" . $itemsCount . ")</span></a></li>";
                    }
                    if (isset($_REQUEST['tab']) && $_REQUEST['tab'] == "contact") {
                        echo "<li><a href='home_cz.php?tab=home'><span>Domov</span></a></li>";
                        echo "<li><a href='home_cz.php?tab=about'>O nás</a></li>";
                        echo "<li><a href='home_cz.php?tab=contact'><span class='active-tab'>Kontakt</span></a></li>";
                        echo "<li><a href='home_cz.php?tab=basket'><span class='glyphicon glyphicon-shopping-cart glyphicon-gray'></span><span id='basketCount'> (" . $itemsCount . ")</span></a></li>";
                    }
                    if (isset($_REQUEST['tab']) && $_REQUEST['tab'] == "basket") {
                        echo "<li><a href='home_cz.php?tab=home'><span>Domov</span></a></li>";
                        echo "<li><a href='home_cz.php?tab=about'>O nás</a></li>";
                        echo "<li><a href='home_cz.php?tab=contact'>Kontakt</a></li>";
                        echo "<li><a href='home_cz.php?tab=basket'><span class='glyphicon glyphicon-shopping-cart active-tab'></span><span id='basketCount' class='active-tab'> (" . $itemsCount . ")</span></a></li>";
                    }
                ?>
            </ul>
        </div>
            <!-- /.navbar-collapse -->
    </div>
        <!-- /.container -->
</nav>