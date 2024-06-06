import { getPerson } from './helpers/request-get-person.js';
import { iconCompleted, iconBlocked } from './templates/iconsTemplate.js'
import { validateStepFormOne } from './helpers/validateDataAddPatient.js';
import { selectDynamicTypeAHF } from './components';

const patientData = {
    code: '',
    name: '',
    career: '',
    gender: null,
    birthdate: '',
    bloodType: null,
    phone: '',
    nss: '',
    civilStatus: null,
    religion: '',
    dependency: '',
    state: '',
    city: '',
    street: '',
    number: '',
    intNumber: '',
    emergencyName: '',
    emergencyPhone: '',
    relationship: ''
}

let steps = 0;
let activeSendButton = false;


$(function () {

    // Buttons
    const btnCardUdgPerson = $('#udgPerson');
    const btnCardexternalPerson = $('#externalPerson');
    const btnNextPersonUdg = $('#nextPersonUdg');
    const btnPrevStep = $('#prevStep');
    const btnNextStep = $('#nextStep');
    const btnExternalPerson = $('#externalPerson');
    const btnSendForm = $('#sendForm');

    // Containers
    const containerUdgPerson = $('#containerUdgPerson');
    const containerFatherForm = $('#containerFatherForm');
    const containerDataPerson = $('#containerDataPerson');
    const containerPersonSelect = $('#containerPersonSelect');


    // Form Steps
    const formSteps = $('.form-step');
    const stepCicles = $('.step-circle');


    // Event listeners
    btnCardUdgPerson.off('click');
    btnCardUdgPerson.on('click', function () {
        containerUdgPerson.removeClass('d-none');
    });


    // Inputs
    const inputCode = $('#code');
    // PD = Person Data
    const allInputsPD = $('.group-custom');
    const inputCodePD = $('#codigo')
    const inputNamePD = $('#name_P');
    const inputCareerPD = $('#Puesto');
    const inputBirthDate = $('#F_nacimiento');    
    const inputState = $('#estado');
    const inputCity = $('#ciudad');
    const inputStreet = $('#calle');
    const inputNumber = $('#num');
    const inputIntNumber = $('#num_int');
    const inputPhone = $('#telefono');
    const inputNss = $('#nss');
    const inputReligion = $('#religion');
    const inputDependency = $('#Puesto');
    const inputEmergencyName = $('#nombre_e');
    const inputEmergencyPhone = $('#telefono_e');
    const inputRelationship = $('#parentesco');

    // Selects 
    const selectGender = $('#gender');
    const selectBloodType = $('#T_sangre');
    const selectCivilStatus = $('#E_civil');


    /* Disease */
    // Selects 
    const selectTypeAHF = $('#tipo_AHF');
    const selectDisease = $('#enfermedad');

    // Auxiliars
    let prevCode = '';

    /* Alert */
    const alertCodePerson = $('#alertCodePerson');

    // Templates
    const namePerson = $('#namePerson');
    const careerPerson = $('#careerPerson');



    btnCardexternalPerson.off('click');
    btnCardexternalPerson.on('click', function () {
        containerUdgPerson.addClass('d-none');
    });

    inputCode.on('keydown', function (e) {

        // Solo se ejecuta si da enter
        if (e.keyCode != 13) {
            return;
        }

        const valueCode = $(this).val();



        if (prevCode == valueCode) return;

        prevCode = valueCode;

        if (valueCode.length !== 7 && valueCode.length !== 9) {
            alertCodePerson.text('La estructura es incorrecta, el código debe ser de 7 o 9 números.').addClass('alert-danger').removeClass('d-none');
            $(this).addClass('border-danger');
        }

        // Remove alert class and border danger
        alertCodePerson.removeClass('alert-danger alert-info').addClass('d-none');
        $(this).removeClass('border-danger');
        containerDataPerson.addClass('d-none');

        // Empty code
        patientData.code = '';
        patientData.name = '';
        patientData.career = '';

        // Request for get person data
        getPerson({ code: valueCode }).then((data) => {

            const { Codigo, Nombre, Carrera } = data;

            console.log(data);
            patientData.code = Codigo;
            patientData.name = Nombre;
            patientData.career = Carrera;
            namePerson.text(Nombre);
            careerPerson.text(Carrera);

            console.log(patientData);

            containerDataPerson.removeClass('d-none');


        }).catch((error) => {
            const { message, status } = error;
            console.log(error);
            alertCodePerson.text(message.message);
            status == 404 ? alertCodePerson.addClass('alert-info') : alertCodePerson.addClass('alert-danger');
            alertCodePerson.removeClass('d-none');
        })

    });

    // Next for step 2
    btnNextPersonUdg.on('click', function () {

        containerPersonSelect.addClass('d-none');
        if (patientData.code !== '') {
            inputCodePD.val(patientData.code).attr('disabled', true);
            inputNamePD.val(patientData.name).attr('disabled', true);
            inputCareerPD.val(patientData.career).attr('disabled', true);

            containerFatherForm.removeClass('d-none');
            formSteps.first().removeClass('d-none');
            stepCicles.first().addClass('active');

            steps = 1;
        }
    });

    btnExternalPerson.on('click', function () {
        containerPersonSelect.addClass('d-none');

        inputCodePD.val('').attr('disabled', false);
        inputNamePD.val('').attr('disabled', false);
        inputCareerPD.val('').attr('disabled', false);

        containerFatherForm.removeClass('d-none');
        formSteps.first().removeClass('d-none');
        stepCicles.first().addClass('active');

        steps = 1;
    });


    // Buttons for step form
    btnPrevStep.on('click', function () {

        stepCicles.eq(steps - 1).removeClass('active');
        stepCicles.eq(steps - 1).removeClass('completed');

        !btnSendForm.hasClass('d-none') && btnSendForm.addClass('d-none');
        btnNextStep.hasClass('d-none') && btnNextStep.removeClass('d-none');

        if (steps < 0) steps = 0;

        steps--;

        if (steps == 0) {
            containerPersonSelect.removeClass('d-none');
            containerFatherForm.addClass('d-none');
        }

        formSteps.each(function () {
            $(this).addClass('d-none');
        });

        if (steps > 0) {
            formSteps.eq(steps - 1).removeClass('d-none');
            stepCicles.eq(steps - 1).removeClass('completed');
        };

    });

    btnNextStep.on('click', function () {

        // Validate if the form is complete
        if (steps == 1) {
            const elements = getDataFirstStep();
            getDataFirstStepValues();
            // if(!validateStepFormOne(patientData, elements)){
            //     return;
            // }

        }

        if (((formSteps.length - 1) == steps && patientData.gender == 1) || formSteps.length == steps && patientData.gender == 2) {
            btnSendForm.removeClass('d-none');
            btnNextStep.addClass('d-none');

            return;
        }

        steps++;


        if (steps > formSteps.length) steps = formSteps.length;

        if (steps > 0) {
            stepCicles.eq(steps - 1).addClass('active');
            stepCicles.eq(steps - 2).addClass('completed');
        };


        formSteps.each(function () {
            $(this).addClass('d-none');
        });

        formSteps.eq(steps - 1).removeClass('d-none');

        if (((formSteps.length - 1) == steps && patientData.gender == 1) || formSteps.length == steps && patientData.gender == 2) {
            btnSendForm.removeClass('d-none');
            btnNextStep.addClass('d-none');
        }

    });



    selectGender.off('change');
    selectGender.on('change', function () {
        patientData.gender = $(this).val();
        if ($(this).val() == 1) {
            stepCicles.last().html(iconBlocked).addClass('blocked')
        } else {
            stepCicles.last().html(iconCompleted).removeClass('blocked');
        }
    });


    /* llamada a la función para obtener los datos de las enfermedades dinamicamente */
    selectDynamicTypeAHF(selectTypeAHF, selectDisease); 


    // Get data for first step
    const getDataFirstStep = () => {

        return {
            allInputsPD,
            inputCodePD,
            inputNamePD,
            inputCareerPD,
            selectGender,
            selectBloodType,
            inputBirthDate,
            inputState,
            inputCity,
            inputStreet,
            inputNumber,
            inputIntNumber,
            inputPhone,
            inputNss,
            selectCivilStatus,
            inputReligion,
            inputDependency,
            inputEmergencyName,
            inputEmergencyPhone,
            inputRelationship,
        }
    }

    const getDataFirstStepValues = ()=>{
        
            patientData.code = inputCodePD.val();
            patientData.name = inputNamePD.val();
            patientData.career = inputCareerPD.val();
            patientData.gender = selectGender.val();
            patientData.birthdate = inputBirthDate.val();
            patientData.bloodType = selectBloodType.val();
            patientData.phone = inputPhone.val();
            patientData.nss = inputNss.val(); 
            patientData.civilStatus = selectCivilStatus.val();
            patientData.religion = inputReligion.val();
            patientData.dependency = inputDependency.val();
            patientData.state = inputState.val();
            patientData.city = inputCity.val();
            patientData.street = inputStreet.val();
            patientData.number = inputNumber.val();
            patientData.intNumber = inputIntNumber.val();
            patientData.emergencyName = inputEmergencyName.val();
            patientData.emergencyPhone = inputEmergencyPhone.val();
            patientData.relationship = inputRelationship.val();
    }















});


/*
// Obtener el elemento del campo de código
var codigoInput = document.getElementById('codigo');

// Obtener el elemento del campo de género
var generoSelect = document.getElementById('gender');

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
                    var genero = response.persona.gendero;
                    if (genero === 'Masculino') {
                        $('#gender').val('1').change(); // Masculino
                    } else if (genero === 'Femenino') {
                        $('#gender').val('2').change(); // Femenino
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
        var genero = document.getElementById("gender").value;
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


*/