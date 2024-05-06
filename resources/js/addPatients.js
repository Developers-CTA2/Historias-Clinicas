// Obtener el elemento del campo de código
var codigoInput = document.getElementById('codigo');

// Obtener el elemento del campo de género
var generoSelect = document.getElementById('sex');

// Agregar un event listener para el evento input
codigoInput.addEventListener('input', function() {
    var codigo = this.value;

    // Verificar si el código tiene 7 dígitos
    if (codigo.length === 7) {
        // Realizar la solicitud AJAX al servidor
        $.ajax({
            url: '/buscar-persona',
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: { codigo: codigo },
            success: function(response) {
                // Manejar la respuesta del servidor
                console.log(response);
                if (response.existe) {
                    // La persona existe, rellenar los campos
                    $('#name_P').val(response.persona.nombre);
                    $('#F_nacimiento').val(response.persona.fecha_nacimiento);
                    
                    // Seleccionar el género
                    var genero = response.persona.sexo;
                    if (genero === 'Masculino') {
                        $('#sex').val('1').change(); // Masculino
                    } else if (genero === 'Femenino') {
                        $('#sex').val('2').change(); // Femenino
                    }
                    
                    $('#nombre_e').val(response.persona.nombre_emergencia);
                    $('#telefono').val(response.persona.tel_emergencia);
                    // Rellenar el campo de carrera/puesto
                    $('#Puesto').val(response.nombramiento);
                } else {
                    // La persona no existe
                    console.log('La persona no existe');
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
});




/////////////////////////////////
// Esperar a que el documento esté completamente cargado
document.addEventListener("DOMContentLoaded", function() {
    // Obtener referencia al botón de "Siguiente"
    var siguienteBtn = document.getElementById("personal-data");
    
    // Agregar un event listener para el evento click en el botón de "Siguiente"
    siguienteBtn.addEventListener("click", function() {
        // Validar los campos de la primera parte del formulario
        var codigo = document.getElementById("codigo").value;
        var genero = document.getElementById("sex").value;
        var nombre = document.getElementById("name_P").value;
        var fechaNacimiento = document.getElementById("F_nacimiento").value;
        var tipoSangre = document.getElementById("T_sangre").value;
        var estado = document.getElementById("estado").value;
        var ciudad = document.getElementById("ciudad").value;
        var calle = document.getElementById("calle").value;
        var numero = document.getElementById("num").value;
        var numeroInt = document.getElementById("num_int").value;
        var telefono = document.getElementById("tel").value;
        var nss = document.getElementById("nss").value;
        var estadoCivil = document.getElementById("E_civil").value;
        var religion = document.getElementById("religion").value;
        var puesto = document.getElementById("Puesto").value;
        var nombreEmergencia = document.getElementById("nombre_e").value;
        var telefonoEmergencia = document.getElementById("telefono").value;
        
        // Verificar si todos los campos necesarios están llenos y válidos
        if (genero && nombre && fechaNacimiento && tipoSangre && estado && ciudad && calle && numero && telefono && nss && estadoCivil && religion && puesto && nombreEmergencia && telefonoEmergencia) {
            // Ocultar la primera parte del formulario
            $('.person-data').addClass('d-none');
            
            // Mostrar la siguiente parte del formulario
            document.querySelector(".ahf-data").classList.remove("d-none");
        } else {
            // Mostrar un mensaje de error o realizar alguna otra acción si los campos no están llenos o válidos
            console.log("Por favor completa todos los campos obligatorios.");
        }
    });
});


document.getElementById('tipo_AHF').addEventListener('change', function() {
    var tipoAHFId = this.value;

    // Realizar una solicitud AJAX para obtener las enfermedades relacionadas
    $.ajax({
        url: '/enfermedades-relacionadas/' + tipoAHFId,
        type: 'GET',
        success: function(response) {
            var selectEnfermedad = $('#enfermedad');

            // Limpiar las opciones anteriores, excluyendo la primera opción
            selectEnfermedad.children('option:not(:first)').remove();

            // Agregar las nuevas opciones de enfermedades
            response.forEach(function(enfermedad) {
                selectEnfermedad.append($('<option>', {
                    value: enfermedad.id,
                    text: enfermedad.nombre
                }));
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});
document.getElementById('enfermedad').addEventListener('change', function() {
    var selectEnfermedad = $('#enfermedad');
    var enfermedadesSeleccionadas = $('#enfermedades-seleccionadas');

    // Obtener las opciones seleccionadas
    var selectedOptions = selectEnfermedad.find('option:selected');

    // Recorrer las opciones seleccionadas y agregarlas a la lista de enfermedades seleccionadas
    selectedOptions.each(function() {
        var enfermedadNombre = $(this).text();
        var enfermedadId = $(this).val();

        // Verificar si la enfermedad ya ha sido seleccionada
        if (!enfermedadesSeleccionadas.find('.enfermedad-item[data-id="' + enfermedadId + '"]').length) {
            var enfermedadItem = $('<div>', {
                text: enfermedadNombre,
                'data-id': enfermedadId, // Agregar un atributo de datos para almacenar el ID de la enfermedad
                class: 'enfermedad-item'
            });
            enfermedadesSeleccionadas.append(enfermedadItem);
        }
    });
});

// Obtener el botón "Siguiente" de la sección de "Enfermedades"
var btnSiguienteAhf = document.getElementById('ahf-data');

// Agregar un evento click al botón "Siguiente"
btnSiguienteAhf.addEventListener('click', function() {
    // Verificar si se han seleccionado enfermedades
    var enfermedadesSeleccionadas = $('#enfermedad').val();
    if (enfermedadesSeleccionadas && enfermedadesSeleccionadas.length > 0) {
        // Mostrar la siguiente sección del formulario
        $('.ahf-data').addClass('d-none');
        $('.apnp-data').removeClass('d-none');
    } else {
        // Si no se han seleccionado enfermedades, mostrar un mensaje de error
        alert('Por favor, seleccione al menos una enfermedad.');
    }
});
















// Mostrar el primer apartado al cargar la página
document.querySelector(".content-custom").style.display = "block";

// Obtener los botones "Atras" de cada sección
var btnAtrasAhf = document.getElementById('ant-data');
var btnAtrasApnp = document.getElementById('ante-data');

// Agregar eventos click a los botones "Atras"
btnAtrasAhf.addEventListener('click', function() {
    // Ocultar la sección actual ("Enfermedades") y mostrar la sección anterior ("Datos personales")
    $('.ahf-data').addClass('d-none');
    $('.person-data').removeClass('d-none');
});

btnAtrasApnp.addEventListener('click', function() {
    // Ocultar la sección actual ("Toxicomanías") y mostrar la sección anterior ("Enfermedades")
    $('.apnp-data').addClass('d-none');
    $('.ahf-data').removeClass('d-none');
});


