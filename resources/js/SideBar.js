// Función para manejar el clic en el botón de hamburguesa
document.getElementById("hamburgerMenu").addEventListener("click", function() {
    // Obtener referencias a los elementos relevantes
    const sidebarContainer = document.getElementById("sidebarContainer");
    const sections = document.querySelectorAll(".text-md-custom");
    const title = document.querySelector(".fw-bold.text-white.m-0.align-self-center");
    const arrows = document.querySelectorAll(".fa-angle-right");
    const sideBar = document.querySelector(".sideBar-custom");
    const mainContent = document.querySelector(".container-custom");
    const hideUsername = document.querySelector('.hide-username');
    hideUsername.style.display = (hideUsername.style.display === 'none') ? 'block' : 'none';
    const paragraphsInCollapses = document.querySelectorAll('.ms-3');
    
    // Alternar la visibilidad de los párrafos en los elementos colapsados
    paragraphsInCollapses.forEach(paragraph => {
        paragraph.classList.toggle('hide'); 
    });

    // Alternar las clases relevantes para el sidebar y el contenido principal
    sideBar.classList.toggle("collapsed");
    mainContent.classList.toggle("expanded");
    mainContent.classList.toggle("full-width");
    sidebarContainer.classList.toggle("hide-sidebar");
    
    // Alternar la visibilidad de las secciones y el título
    sections.forEach(section => {
        section.classList.toggle("hide-sections");
    });
    title.classList.toggle("hide-sections");
    
    // Alternar la visibilidad de las flechas
    arrows.forEach(arrow => {
        arrow.classList.toggle("hide-sections");
    });
    
    // Guardar el estado del sidebar en el almacenamiento local
    const isCollapsed = sideBar.classList.contains("collapsed");
    localStorage.setItem("sidebarCollapsed", isCollapsed);
});

// Función para restaurar el estado del sidebar al recargar la página
window.addEventListener("load", function() {
    // Obtener el estado del sidebar del almacenamiento local
    const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
    // Si el sidebar estaba colapsado, aplicar las clases relevantes
    if (isCollapsed) {
        const sidebarContainer = document.getElementById("sidebarContainer");
        const sideBar = document.querySelector(".sideBar-custom");
        const mainContent = document.querySelector(".container-custom");
        const sections = document.querySelectorAll(".text-md-custom");
        const title = document.querySelector(".fw-bold.text-white.m-0.align-self-center");
        const arrows = document.querySelectorAll(".fa-angle-right");
        const paragraphsInCollapses = document.querySelectorAll('.ms-3');
        const hideUsername = document.querySelector('.hide-username');
        hideUsername.style.display = (hideUsername.style.display === 'none') ? 'block' : 'none';
        sidebarContainer.classList.add("hide-sidebar");
        sideBar.classList.add("collapsed");
        mainContent.classList.add("expanded");
        mainContent.classList.add("full-width");

        paragraphsInCollapses.forEach(paragraph => {
            paragraph.classList.add('hide');
        });

        sections.forEach(section => {
            section.classList.add("hide-sections");
        });
        title.classList.add("hide-sections");
        arrows.forEach(arrow => {
            arrow.classList.add("hide-sections");
        });

    }
    
});


