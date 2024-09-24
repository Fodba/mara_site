
$(document).ready(function(){
    $('.bio').slick({
        autoplay: true,
        arrows: false,
    });

    $('.concept-name').click(function (){
        var nom = $(this).attr('id').replace('concept-','');
        //alert(nom);
        var cible = "#def-" + nom;
        //alert(cible);
        $('.concept-definition').each(function(){
            $(this).hide();
        });
        $(cible).css('display','block');
    });

});