<div id="sekciaVino" class="row"><h2>Víno</h2></div>

<?php 

    function vypisVysledokVino($result, $type_name) {
        echo "<div class='row'>";
        switch ($type_name){
            case 'fragolino': echo "<div id='sekciaVíno". $type_name ."'><h3>Fragolino</h3></div>"; break;
        }
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='col-sm-4 col-lg-4 col-md-4'>";
            echo "<div class='thumbnail'>";
            echo "<img src='" . $row['picture'] ."' title='" . $row['name'] ."'>";
            echo "<div class='caption'>";
            echo "<h4><a href=''>" . $row['name'] . "</a></h4>";
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

    $my_query_0 = "SELECT t.name as type_name from category as c inner join type as t on c.id_category = t.id_category where c.name = 'wine'";
    $result_0 = mysqli_query($connection, $my_query_0);

    while ($row = mysqli_fetch_array($result_0)) {
        $my_query = "SELECT p.id_product, p.name, p.price, p.picture, p.description FROM type as t inner join product as p on t.id_type = p.id_type where t.name = '". $row['type_name'] ."'";
        $result = mysqli_query($connection, $my_query);
        vypisVysledokVino($result, $row['type_name']);
    }

    mysqli_close($connection);
?>