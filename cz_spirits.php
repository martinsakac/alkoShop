<div id="sekciaLiehoviny" class="row"><h2>Liehoviny</h2></div>

<div class="row">

    <div class='col-sm-4 col-lg-4 col-md-4'>
        <div class='thumbnail'>
            <img src='http://placehold.it/320x150' alt=''>
            <div class='caption'>
                <h4 class='pull-right'>$94.99</h4>
                <h4><a href='#'>Fifth Product</a>
                </h4>
                <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class='ratings'>
                <p class='pull-right'>18 reviews</p>
                <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                </p>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
<?php 

    $connection = mysqli_connect('localhost', 'root', 'root', 'alko_shop')
                        or die ('Could not connect: ') . mysql_error();
    $my_query = "SELECT p.id_product, p.name, p.price, p.picture, p.description FROM type as t inner join product as p on t.id_type = p.id_type where t.name = 'whisky'";
    $result = mysqli_query($connection, $my_query);

    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='col-sm-4 col-lg-4 col-md-4'>";
        echo "<div class='thumbnail'>";
        echo "<img src='" . $row['picture'] ."' title='" . $row['name'] ."'>";
        echo "<div class='caption'>";
        echo "<h4 class='pull-right'>" . $row['price'] ." Kč</h4>";
        echo "<h4><a href=''>" . $row['name'] . "</a></h4>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<button onclick='putItemToBasket(" . $row['id_product'] . ")' class='btn btn-primary pull-right'>";
        echo "<span>Objednaj  </span><span class='glyphicon glyphicon-shopping-cart glyphicon-white'></span></button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";

    }

?>
</div>