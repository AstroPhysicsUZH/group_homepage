
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

});