export const btnUpScreenFunction = () => {
    const btnUpScreen = $('#buttonUpScreen');

    $(window).on('scroll',function(){
        if($(this).scrollTop() > 100){
            btnUpScreen.removeClass('d-none').fadeIn();
        } else {
            console.log('entro');
            btnUpScreen.addClass('d-none').fadeOut();
        }
    });

    btnUpScreen.on('click',function(){
        $('html, body').animate({scrollTop : 0},200);
        return false;
    });
}