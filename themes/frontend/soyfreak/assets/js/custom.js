$(document).on('click', '.expandir', function(){
    $('.right-column').toggleClass('cerrado');
    $('.left-column').toggleClass('full-width');
    $('header').toggleClass('abierto');
    $('.expandir i').toggleClass('ion-arrow-right-a ion-arrow-left-a');
}); 