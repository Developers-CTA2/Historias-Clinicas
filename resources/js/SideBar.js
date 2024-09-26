import { disableLoading } from "./loading-screen";

$(function(){

    const hamburger = $('#bt-hamburger');
    const btncompressedSidebar = $('#btnOpenClose');
    const btnCloseSideBarMovil = $('#btn-close-sidebar-movil');

    const links = $('.link-item-custom');

    
    // Containers
    const containerSideBar = $('#container-sideBar-custom')
    const containerNavBar = $('#navBar');
    const mainContainer = $('#main-container');

    // Si el sidebar esta comprimido
    if(localStorage.getItem('sidebar')){
        containerSideBar.addClass('compressed');
        containerNavBar.addClass('container-expanded');
        mainContainer.addClass('container-expanded');
    }

    btnCloseSideBarMovil.on('click', function(){
        containerSideBar.removeClass('movil-collapse');
        containerNavBar.removeClass('container-expanded');
        mainContainer.removeClass('container-expanded');
    })

    hamburger.on('click', function(){

        if(containerSideBar.hasClass('compressed')){
            containerSideBar.removeClass('compressed');
            containerNavBar.removeClass('container-expanded');
            mainContainer.removeClass('container-expanded');
        }

        containerSideBar.toggleClass('movil-collapse');
    })

    btncompressedSidebar.on('click', function(){
        console.log('click');
        containerSideBar.toggleClass('compressed');
        containerNavBar.toggleClass('container-expanded');
        mainContainer.toggleClass('container-expanded');

        if(containerSideBar.hasClass('compressed')){
            localStorage.setItem('sidebar', 'compressed');
        }else{
            localStorage.removeItem('sidebar');
        }
    });


    // Submenus
    links.on('click', function(){
        // Remover la clase active de todos los elementos
        $(this).siblings().removeClass('active');

        // Agregar o remover la clase active del elemento actual
        $(this).toggleClass('active');

        // Mostrar u ocultar el submenu
        $(this).find('ul').slideToggle();
        $(this).siblings().find('ul').slideUp();

        // Si el elemento actual tiene la clase active, se cierran los demas submenus
        $(this).siblings().find('ul').find('li').removeClass('active');
    });


    disableLoading();

});
