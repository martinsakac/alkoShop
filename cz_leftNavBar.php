<div class="bs-example col-md-3">
    <p class="lead">Ponuka</p>
    <div class="panel-group" id="accordion">

        <?php 

            $connection = mysqli_connect('localhost', 'root', 'root', 'alko_shop')
                        or die ('Could not connect: ') . mysql_error();

        ?>

<!--  Oblubene -->        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Akcia</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="span3">
                        <div class="list-group">
                            <?php 
                                $my_query = "SELECT p.id_product, p.name, p.price, p.picture, p.description FROM product as p where p.akcia = 1";
                                $result = mysqli_query($connection, $my_query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<a href='#sekciaAkcia' class='list-group-item akcia-list'>". $row['name'] ."</a>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Vino -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Víno</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="span3">
                        <div class="list-group">
                            <?php 
                                $my_query = "SELECT t.name as type_name from category as c inner join type as t on c.id_category = t.id_category where c.name = 'wine'";
                                $result = mysqli_query($connection, $my_query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<a href='#sekciaVino". $row['type_name'] ."' class='list-group-item vino-list'>";
                                    switch ($row['type_name']) {
                                        case 'fragolino': echo "Fragolino"; break;
                                    }
                                    echo"</a>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Liehoviny -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Liehoviny</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="span3">
                        <div class="list-group">
                            <?php 
                                $my_query = "SELECT t.name as type_name from category as c inner join type as t on c.id_category = t.id_category where c.name = 'spirits'";
                                $result = mysqli_query($connection, $my_query);
                                while ($row = mysqli_fetch_array($result)) {
                                    switch ($row['type_name']) {
                                        case 'vodka': echo "<a href='#sekciaLiehoviny". $row['type_name'] ."' class='list-group-item liehoviny-list'>Vodka</a>"; break;
                                        case 'rum': echo "<a href='#sekciaLiehoviny". $row['type_name'] ."' class='list-group-item ". $row['type_name'] ."-liehoviny-list'>Rum</a>"; break;
                                        case 'whisky': echo "<a href='#sekciaLiehoviny". $row['type_name'] ."' class='list-group-item ". $row['type_name'] ."-liehoviny-list'>Whisky</a>"; break;
                                        case 'bylinky': echo "<a href='#sekciaLiehoviny". $row['type_name'] ."' class='list-group-item ". $row['type_name'] ."-liehoviny-list'>Bylinky</a>"; break;
                                        case 'palenka': echo "<a href='#sekciaLiehoviny". $row['type_name'] ."' class='list-group-item ". $row['type_name'] ."-liehoviny-list'>Pálenka</a>"; break;
                                        case 'tequila': echo "<a href='#sekciaLiehoviny". $row['type_name'] ."' class='list-group-item ". $row['type_name'] ."-liehoviny-list'>Tequila</a>"; break;
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>