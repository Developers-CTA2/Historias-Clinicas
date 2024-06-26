$(function(){

    const hamburger = $('#bt-hamburger');
    const btncompressedSidebar = $('#btnOpenClose');
    const btnCloseSideBarMovil = $('#btn-close-sidebar-movil');

    const links = $('.link-item-custom');

    
    // Containers
    const containerSideBar = $('#container-sideBar-custom')
    const containerNavBar = $('#navBar');
    const mainContainer = $('#main-container');

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
        containerSideBar.toggleClass('compressed');
        containerNavBar.toggleClass('container-expanded');
        mainContainer.toggleClass('container-expanded');
    });


    // Submenus
    links.on('click', function(){
        $(this).siblings().removeClass('active');
        $(this).toggleClass('active');

        $(this).find('ul').slideToggle();
    });


});
