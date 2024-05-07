$(document).ready(function () {
    // Función para manejar el clic en el botón de hamburguesa
    $("#hamburgerMenu").on("click", function () {
        // Obtener referencias a los elementos relevantes
        const sidebarContainer = $("#sidebarContainer");
        const sections = $(".text-md-custom");
        const title = $(".fw-bold.text-white.m-0.align-self-center");
        const arrows = $(".fa-angle-right");
        const sideBar = $(".sideBar-custom");
        const mainContent = $(".container-custom");
        // Centrar iconos cuando se minimiza
        const SidebarContent = $(".sidebarContent");
        const SidebarCon = $(".link-custom-nav");

        const hideUsername = $(".hide-username");
        hideUsername.toggle();
        const paragraphsInCollapses = $(".ms-3");
        // Alternar la visibilidad de los párrafos en los elementos colapsados
        paragraphsInCollapses.toggleClass("hide");

        // Alternar las clases relevantes para el sidebar y el contenido principal
        sideBar.toggleClass("collapsed");
        mainContent.toggleClass("expanded full-width");
        sidebarContainer.toggleClass("hide-sidebar");
        SidebarContent.removeClass("px-3").addClass("d-flex justify-content-center");
     

        // Alternar la visibilidad de las secciones y el título
        sections.toggleClass("hide-sections");
        title.toggleClass("hide-sections");

        // Alternar la visibilidad de las flechas
        arrows.toggleClass("hide-sections");

        // Guardar el estado del sidebar en el almacenamiento local
        const isCollapsed = sideBar.hasClass("collapsed");
        localStorage.setItem("sidebarCollapsed", isCollapsed);
    });

    // Función para restaurar el estado del sidebar al recargar la página
    $(window).on("load", function () {
        // Obtener el estado del sidebar del almacenamiento local
        const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
        // Si el sidebar estaba colapsado, aplicar las clases relevantes
        if (isCollapsed) {
            const sidebarContainer = $("#sidebarContainer");
            const sideBar = $(".sideBar-custom");
            const mainContent = $(".container-custom");
            const sections = $(".text-md-custom");
            const title = $(".fw-bold.text-white.m-0.align-self-center");
            const arrows = $(".fa-angle-right");
            const hideUsername = $(".hide-username");
            hideUsername.toggle();
            sidebarContainer.addClass("hide-sidebar");
            sideBar.addClass("collapsed");
            mainContent.addClass("expanded full-width");

            $(".ms-3").addClass("hide");
            sections.addClass("hide-sections");
            title.addClass("hide-sections");
            arrows.addClass("hide-sections");
        }
    });
});
