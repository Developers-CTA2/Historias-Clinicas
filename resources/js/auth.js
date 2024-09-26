import {svgEyeShow, svgEyeHidden } from './templates/authTemplate';

$(function(){

    const btnShowHidePassword = $('#showHidePassword')

    btnShowHidePassword.on('click',function(){
        if($(this).prev().attr('type') === 'text'){
            
            // Cambiar el tipo de atributo del input
            $(this).prev().attr('type','password');


            // Cambiar el svg
            btnShowHidePassword.html(svgEyeShow);

        }else{
            // Cambiar el tipo de atributo del input
            $(this).prev().attr('type','text');
            btnShowHidePassword.html(svgEyeHidden);
        }


    });

});