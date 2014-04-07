// date picker
$(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "dd-mm-yy"
    });
});

// time picker
$(function () {
    $('#timepicker').timepicker();
});

// sliding to elements
$(function() {
    $(".akcia-list").click(function(){
        $("html, body").animate({
            scrollTop:$("#sekciaAkcia").offset().top}, 1000);
        return false;
    });

    $(".pivo-list").click(function(){
        $("html, body").animate({
            scrollTop:$("#sekciaPivo").offset().top}, 1000);
        return false;
    });

    $(".vino-list").click(function(){
        $("html, body").animate({
            scrollTop:$("#sekciaVino").offset().top}, 1000);
        return false;
    });

    $(".liehoviny-list").click(function(){
        $("html, body").animate({
            scrollTop:$("#sekciaLiehoviny").offset().top}, 1000);
        return false;
    });

    // podla druhu liehoviny
    $(".rum-liehoviny-list").click(function(){
        $("html, body").animate({
            scrollTop:$("#sekciaLiehovinyrum").offset().top}, 1000);
        return false;
    });
    $(".whisky-liehoviny-list").click(function(){
        $("html, body").animate({
            scrollTop:$("#sekciaLiehovinywhisky").offset().top}, 1000);
        return false;
    });
    $(".bylinky-liehoviny-list").click(function(){
        $("html, body").animate({
            scrollTop:$("#sekciaLiehovinybylinky").offset().top}, 1000);
        return false;
    });
    $(".palenka-liehoviny-list").click(function(){
        $("html, body").animate({
            scrollTop:$("#sekciaLiehovinypalenka").offset().top}, 1000);
        return false;
    });
    $(".tequila-liehoviny-list").click(function(){
        $("html, body").animate({
            scrollTop:$("#sekciaLiehovinytequila").offset().top}, 1000);
        return false;
    });
    
});

//sliding to top
$(function() {
    $('.goToTop').click(function(){
        $('html, body').animate({scrollTop:0}, 1000);
        return false;
    });
});

// ajax function to add item to basket
function putItemToBasket(item_id) {
    var alertId = "product" + item_id + "alert";
    //$('#'+alertId).removeClass('productAlertOff').addClass('productAlertOn');
    $('#'+alertId).fadeIn('slow');
    $('#'+alertId).delay(1500).fadeOut('slow');

    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("basketCount").innerHTML=xmlhttp.responseText;
        }
    }

    xmlhttp.open("GET", "putItemToBasket.php?item_id=" + item_id, true);
    xmlhttp.send();
}

// zmaze z kosika vybraty product alebo zmaze vsetky produkty z kosika
function removeItemFromBasket(item_id, delAllItems) {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("basketCount").innerHTML=xmlhttp.responseText;
            window.location.reload(true);
        }
    }

    if (delAllItems == true){
        xmlhttp.open("GET", "removeItemFromBasket.php?item_id=" + item_id + "&all=true", true);   
    }
    else {
        xmlhttp.open("GET", "removeItemFromBasket.php?item_id=" + item_id + "&all=false", true);
    }
    xmlhttp.send();
}

// pri zmene mnozstva prepocita celkovu cenu nakupu
function updateQuantity(item_id){
    var quantity = document.getElementById("select" + item_id).value;
    var price = parseInt(document.getElementById("price" + item_id).innerHTML);
  
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("priceSum" + item_id).innerHTML = price * quantity + " Kč";
            document.getElementById("sucetCelkom").innerHTML = xmlhttp.responseText + " Kč";
        }
    }

    xmlhttp.open("GET", "updateQuantity.php?item_id=" + item_id + "&quantity=" + quantity, true);
    xmlhttp.send();
}

