<div id="sekciaAkcia" class="row" ><h2>Akcia</h2></div>

<?php 

    function vypisVysledokAkcia($result) {
        echo "<div class='row'>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='col-sm-4 col-lg-4 col-md-4'>";
            echo "<div class='thumbnail'>";
            echo "<img src='" . $row['picture'] ."' title='" . $row['name'] ."'>";
            echo "<div class='caption'>";
            echo "<h4><a>" . $row['name'] . "</a></h4>";
            echo "<h4>" . $row['price'] ." Kč</h4>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<button onclick='putItemToBasket(" . $row['id_product'] . ")' class='btn btn-primary pull-right'>";
            echo "<span>Objednaj  </span><span class='glyphicon glyphicon-shopping-cart glyphicon-white'></span></button>";
            echo "</div>";
            echo "<div id='product". $row['id_product'] ."alert' class='alert alert-success' style='display: none;'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
            echo "Produkt bol pridaný do košíka.</div>";
            echo "</div>";
            echo "</div>";

        }
        echo "</div>"; // koniec row
    }

    $connection = mysqli_connect('localhost', 'root', 'root', 'alko_shop')
                        or die ('Could not connect: ') . mysql_error();

    $my_query = "SELECT p.id_product, p.name, p.price, p.picture, p.description FROM product as p where p.akcia = 1";
    $result = mysqli_query($connection, $my_query);
    vypisVysledokAkcia($result);

    mysqli_close($connection);

?>