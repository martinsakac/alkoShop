// sliding to elements
$(function() {
    $(".oblubene-list").click(function(){
        $("html, body").animate({
            scrollTop:$("#sekciaOblubene").offset().top}, 1000);
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
    
});

//sliding to top
$(function() {
    $('.goToTop').click(function(){
        $('html, body').animate({scrollTop:0}, 1000);
        return false;
    });
});