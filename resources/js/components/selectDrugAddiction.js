import { calculateEPOC, manageDrugAddictions } from '../helpers';
import { templateAddListAccordionDrugAddiction, templateDescriptionSeparate } from '../templates';

// Data for the list of drug addictions
let dataDrugAddiction = [];


// Variables for the EPOC calculation
let riskEPOCGlobal = '';


export const selectDynamicDrugAddiction = ( parameters )=>{

    // Get the parameters
    const { selectDrugAddiction, 
            inputNumberOfCigarettes, 
            inputHowDateSmoking, 
            inputHowOtherDrugs, 
            descriptionOtherDrugs, 
            contaienerOptionSmoking, 
            containerOptionOthers,
            accordionListDrugAddiction,
            btnAddDrugAddiction
         } = parameters;

        
        //  Select the drug addiction option, tabaquism or other drugs
    selectDrugAddiction.on('change', function(){
        // Get the value of the select
        let value = $(this).val();

        // Enable the button
        btnAddDrugAddiction.attr('disabled', false);

        // If the value is tabaquism
        if(value == '1'){
            // Show the container for tabaquism
            contaienerOptionSmoking.removeClass('d-none');
            containerOptionOthers.addClass('d-none');
        }else{
            // Show the container for other drugs
            contaienerOptionSmoking.addClass('d-none');
            containerOptionOthers.removeClass('d-none');    
        }
    });


    // Add the drug addiction to the list
    btnAddDrugAddiction.on('click',function(){
        const data = getDataForm();
        console.log(data);
        validateForm(data) ? addedListDrugAddiction(data) : null;
    });

    // Get the data from the form
    const getDataForm = ()=>{
        let data = {
            textDrugAddiction: selectDrugAddiction.find('option:selected').text().trim(),
            valueDrugAddiction: selectDrugAddiction.val(),
            valueNumberOfCigarettes: inputNumberOfCigarettes.val(),
            valueHowDateSmoking: inputHowDateSmoking.val(),
            valueHowOtherDrugs: inputHowOtherDrugs.val(),
            valueDescriptionOtherDrugs: descriptionOtherDrugs.val()
        }

        return data;
    }


    // Validate the form
    const validateForm  = (data)=>{
        const { valueDrugAddiction, valueNumberOfCigarettes, valueHowDateSmoking, valueHowOtherDrugs, valueDescriptionOtherDrugs } = data;
        let validate = true;


        selectDrugAddiction.removeClass('is-invalid border-danger');
        selectDrugAddiction.next().addClass('d-none').text('');
        inputNumberOfCigarettes.removeClass('is-invalid border-danger');
        inputNumberOfCigarettes.next().addClass('d-none').text(''); 
        inputHowDateSmoking.removeClass('is-invalid border-danger');
        inputHowDateSmoking.next().addClass('d-none').text('');
        inputHowOtherDrugs.removeClass('is-invalid border-danger');
        inputHowOtherDrugs.next().addClass('d-none').text('');
        descriptionOtherDrugs.removeClass('is-invalid border-danger');
        descriptionOtherDrugs.parent().next().addClass('d-none').text('');
        


        if(valueDrugAddiction == null){
            selectDrugAddiction.addClass('is-invalid border-danger');   
            selectDrugAddiction.next().text('Debes seleccionar una opción').removeClass('d-none');
            validate = false;
        }

        if(valueDrugAddiction == '1' && valueNumberOfCigarettes == '' && valueHowDateSmoking == ''){
            inputNumberOfCigarettes.addClass('is-invalid border-danger');
            inputNumberOfCigarettes.next().text('Debes ingresar un valor').removeClass('d-none');   
            inputHowDateSmoking.addClass('is-invalid border-danger');
            inputHowDateSmoking.next().text('Debes ingresar un valor').removeClass('d-none');
            validate = false;
        }

        if(valueDrugAddiction == '1' && valueNumberOfCigarettes == ''){
            inputNumberOfCigarettes.addClass('is-invalid border-danger');
            inputNumberOfCigarettes.next().text('Debes ingresar un valor').removeClass('d-none');
            validate = false;
        }

        if(valueDrugAddiction == '1' && valueHowDateSmoking == ''){
            inputHowDateSmoking.addClass('is-invalid border-danger');
            inputHowDateSmoking.next().text('Debes ingresar un valor').removeClass('d-none');
            validate = false;
        }

        if(valueDrugAddiction >= '2' && valueHowOtherDrugs == '' && valueDescriptionOtherDrugs == ''){
            inputHowOtherDrugs.addClass('is-invalid border-danger');
            inputHowOtherDrugs.next().text('Debes ingresar un valor').removeClass('d-none');
            descriptionOtherDrugs.addClass('is-invalid border-danger');
            descriptionOtherDrugs.parent().next().text('Debes ingresar una descripción').removeClass('d-none');
            validate = false;
        }

        if(valueDrugAddiction >= '2' && valueHowOtherDrugs == ''){
            inputHowOtherDrugs.addClass('is-invalid border-danger');
            inputHowOtherDrugs.next().text('Debes ingresar un valor').removeClass('d-none');
            validate = false;
        }   

        if(valueDrugAddiction >= '2' && valueDescriptionOtherDrugs == ''){
            descriptionOtherDrugs.addClass('is-invalid border-danger');
            descriptionOtherDrugs.parent().next().text('Debes ingresar una descripción').removeClass('d-none');
            validate = false;
        }

        return validate;

    }

    // Add the drug addiction to the list
    const addedListDrugAddiction = (data)=>{
    
        let response = manageDrugAddictions(convertFormat(data));
        
        const { id, descriptionUI } = response;
        const { textDrugAddiction } = data;
        
        let descriptionSeparated = splitDescription(descriptionUI);

        // Add the data to the list
        dataDrugAddiction.push(response);

        let descriptionHTML = templateDescriptionSeparate(descriptionSeparated);
        
        // Add the data to the UI
        accordionListDrugAddiction.append(templateAddListAccordionDrugAddiction(id ,textDrugAddiction, descriptionHTML));

        // Clear the form
        clearForm();
        // Delete the drug addiction
        deleteDrugAddiction();
    }

    const splitDescription = (description)=>{
        let descriptionArray = description.split('|').map(item => item.trim());
    
        return descriptionArray
    }

    // Convert the format of the data to send backend
    const convertFormat = (data)=>{
        return {
            optionDrugAddiction : data.valueDrugAddiction,
            valueNumberOfCigarettes : data.valueNumberOfCigarettes,
            valueHowDateSmoking : data.valueHowDateSmoking,
            valueHowOtherDrugs : data.valueHowOtherDrugs,
            valueDescriptionOtherDrugs : data.valueDescriptionOtherDrugs,
            riskEPOCGlobal : riskEPOCGlobal
        }
    }

    // Delete the drug addiction
    const deleteDrugAddiction = ()=>{
        
        $('.deleteDrugAddiction').off('click');
        $('.deleteDrugAddiction').on('click', function(){
            let id = $(this).parent().data('id');
            // Delete the data from the list
            dataDrugAddiction = dataDrugAddiction.filter(drugAddiction => drugAddiction.id != id)
            $(this).parent().remove();
        });
        
    }

    // Clear the form
    const clearForm = ()=>{
        selectDrugAddiction.val('');
        inputNumberOfCigarettes.val('');
        inputHowDateSmoking.val('');
        inputHowOtherDrugs.val('');
        descriptionOtherDrugs.val('');
        contaienerOptionSmoking.addClass('d-none');
        containerOptionOthers.addClass('d-none');
        $('#riegoEPOC').html('Nulo');
    }


    // Calculate EPOC
    inputNumberOfCigarettes.on('keyup', function(){
        getCalculateEPOC();
    });

    inputHowDateSmoking.on('keyup', function(){
        getCalculateEPOC();
    })


    // Get the calculate EPOC
    const getCalculateEPOC = ()=>{
        let numberOfCigarettes = inputNumberOfCigarettes.val();
        let howDateSmoking = inputHowDateSmoking.val();
        let response = null;
        
        response = calculateEPOC({numberOfCigarettes, howDateSmoking});

        console.log(response);

        if(response.html != ""){
            // Add the data to the UI
            $('#riegoEPOC').html(response.html);
            riskEPOCGlobal = response.risk;
        }
        
    }


}

// Export the list of drug addictions data
export const getListDrugAddiction = () => { return dataDrugAddiction; }