<div id="sekciaLiehoviny" class="row nazovSekcie"><h2>Liehoviny</h2></div>

<?php 

    function vypisVysledokLiehoviny($result, $type_name) {
        echo "<div class='row'>";
        switch ($type_name){
            case 'vodka': echo "<div id='sekciaLiehoviny". $type_name ."'><h3>Vodka</h3></div>"; break;
            case 'rum': echo "<div id='sekciaLiehoviny". $type_name ."'><h3 class='h3padding-top'>Rum</h3></div>"; break;
            case 'whisky': echo "<div id='sekciaLiehoviny". $type_name ."'><h3 class='h3padding-top'>Whisky</h3></div>"; break;
            case 'bylinky': echo "<div id='sekciaLiehoviny". $type_name ."'><h3 class='h3padding-top'>Bylinky</h3></div>"; break;
            case 'palenka': echo "<div id='sekciaLiehoviny". $type_name ."'><h3 class='h3padding-top'>Pálenka</h3></div>"; break;
            case 'tequila': echo "<div id='sekciaLiehoviny". $type_name ."'><h3 class='h3padding-top'>Tequila</h3></div>"; break;
        }
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='col-sm-4 col-lg-4 col-md-4'>";
            echo "<div class='thumbnail'>";
            echo "<img src='" . $row['picture'] ."' title='" . $row['name'] ."'>";
            echo "<div class='caption'>";
            echo "<h4><a>" . $row['name'] . "</a></h4>";
            echo "<h4 >" . $row['price'] ." Kč</h4>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<div><button onclick='putItemToBasket(" . $row['id_product'] . ")' class='btn btn-primary pull-right'>";
            echo "<span>Objednaj  </span><span class='glyphicon glyphicon-shopping-cart glyphicon-white'></span></button></div>";
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

    $my_query_0 = "SELECT t.name as type_name from category as c inner join type as t on c.id_category = t.id_category where c.name = 'spirits'";
    $result_0 = mysqli_query($connection, $my_query_0);

    while ($row = mysqli_fetch_array($result_0)) {
        $my_query = "SELECT p.id_product, p.name, p.price, p.picture, p.description FROM type as t inner join product as p on t.id_type = p.id_type where t.name = '". $row['type_name'] ."'";
        $result = mysqli_query($connection, $my_query);
        vypisVysledokLiehoviny($result, $row['type_name']);
    }

    mysqli_close($connection);
?>
