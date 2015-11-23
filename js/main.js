
/**
 * decode email adresses on mouse over or focus
 */

// init char map
var n = -21; // shift parameter.. should be the same*-1 as in js
var chars = 'VR@qkxofaHjQ.PJlsuZrOEA_nCTUpcDSWhzygKBYXetNvLwdGMb-mIFi';
var nchr = chars.length;
n = n<0 ? nchr + (n%nchr) : n%nchr ; // get into range [0 .. nchr]

luukoeptaibel = [];
for (var i = 0; i < nchr; i++) {
    luukoeptaibel[chars[i]] = chars[(i+n+nchr) % nchr]; // make sure index is in range
};

/* decryption of email addresses */
function mach_mini_iimeil_laesbar(text) {
    var s = text.split('');
    for (var i = 0; i < s.length; i++) { s[i] = luukoeptaibel[text[i]]; }
    return s.join('');
}


$(function(){

    var menu = $('#menu');
    var pos = menu.offset();
    var height = menu.height();

    $(window).scroll(function(){
        if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('default')){
            //menu.stop().removeClass('default').addClass('fixed').css({top:'-6em'}).animate({top:'-3.5em'},1000);
            menu.stop().removeClass('default').addClass('fixed').css({top:-height}).animate({top:-height+30}, 400);
            /*
            menu.fadeOut('fast', function(){
                $(this).removeClass('default').addClass('fixed').fadeIn();
            }); */
        } else if($(this).scrollTop() <= pos.top+height && menu.hasClass('fixed')){
            //menu.stop().animate({top:'-6em'},1000, "swing", function(){
            menu.stop().animate({top:-height},1, "swing", function(){
                $(this).removeClass('fixed').removeAttr("style").addClass('default').show();
            });
            /*
            menu.fadeOut('fast', function(){
                $(this).removeClass('fixed').addClass('default').fadeIn();
            });*/
        }
    });

    
    $(window).resize(function(){
        pos = menu.offset();
        height = menu.height();
    });


    // trigger decrypt on user action
    $('#group').one('click hover mousenter mouseover focus', function(evt){
        $('a.iimeil').each(function(){
            $(this).attr("href", "mailto:"+mach_mini_iimeil_laesbar($(this).data('iimeil')));
        });
    });
    
    // the cheffe email should always be visible
    $('.iimeil.cheffe').text(mach_mini_iimeil_laesbar($('.iimeil.cheffe').data('iimeil')));


});