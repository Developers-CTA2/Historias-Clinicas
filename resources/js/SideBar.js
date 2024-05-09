$(document).ready(function () {
    // Función para manejar el clic en el botón de hamburguesa
    $(".hamburgerMenu").on("click", function () {
        // Obtener referencias a los elementos relevantes
        const sidebarContainer = $("#sidebarContainer");
        const title = $(".hide-text");
        const sideBar = $(".sideBar-custom");
        const mainContent = $(".container-customheader-content");
          // Centrar iconos cuando se minimiza
        const SidebarContent = $(".sidebarContent");
 
        const paragraphsInCollapses = $(".ms-3");
        // Alternar la visibilidad de los párrafos en los elementos colapsados
        paragraphsInCollapses.toggleClass("hide");

        // Alternar las clases relevantes para el sidebar y el contenido principal
        sideBar.toggleClass("collapsed");
        mainContent.toggleClass("expanded full-width");
         sidebarContainer.toggleClass("hide-sidebar");
        SidebarContent.removeClass("px-3").addClass(
            "d-flex justify-content-center"
        );
 
        // Alternar la visibilidad de las secciones y el título
      //  sections.toggleClass("hide-sections");
        title.toggleClass("hide-sections");
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
            const mainContent = $(".container-custom.header-content");
      
            sidebarContainer.addClass("hide-sidebar");
            sideBar.addClass("collapsed");
            mainContent.addClass("expanded full-width");
       
            $(".ms-3").addClass("hide");
         //   sections.addClass("hide-sections");
            title.addClass("hide-sections");
             
        }
    });
});
