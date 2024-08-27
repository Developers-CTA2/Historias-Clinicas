import { calculateEPOC, manageDrugAddictions } from '../helpers';
import { templateAddListAccordionDrugAddiction } from '../templates';

let dataDrugAddiction = [];


let riskEPOCGlobal = '';


export const selectDynamicDrugAddiction = ( parameters )=>{

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

        
    

    selectDrugAddiction.on('change', function(){
        let value = $(this).val();

        btnAddDrugAddiction.attr('disabled', false);

        if(value == '1'){
            contaienerOptionSmoking.removeClass('d-none');
            containerOptionOthers.addClass('d-none');
        }else{
            contaienerOptionSmoking.addClass('d-none');
            containerOptionOthers.removeClass('d-none');    
        }
    });


    btnAddDrugAddiction.on('click',function(){
        const data = getDataForm();
        validateForm(data) ? addedListDrugAddiction(data) : null;
    });

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

        if(valueDrugAddiction == '2' && valueHowOtherDrugs == '' && valueDescriptionOtherDrugs == ''){
            inputHowOtherDrugs.addClass('is-invalid border-danger');
            inputHowOtherDrugs.next().text('Debes ingresar un valor').removeClass('d-none');
            descriptionOtherDrugs.addClass('is-invalid border-danger');
            descriptionOtherDrugs.parent().next().text('Debes ingresar un valor').removeClass('d-none');
            validate = false;
        }

        if(valueDrugAddiction == '2' && valueHowOtherDrugs == ''){
            inputHowOtherDrugs.addClass('is-invalid border-danger');
            inputHowOtherDrugs.next().text('Debes ingresar un valor').removeClass('d-none');
            validate = false;
        }   

        if(valueDrugAddiction == '2' && valueDescriptionOtherDrugs == ''){
            descriptionOtherDrugs.addClass('is-invalid border-danger');
            descriptionOtherDrugs.parent().next().text('Debes ingresar un valor').removeClass('d-none');
            validate = false;
        }

        return validate;

    }

    const addedListDrugAddiction = (data)=>{
    
        let response = manageDrugAddictions(convertFormat(data));

        const { id, descriptionUI } = response;
        const { textDrugAddiction } = data;

        dataDrugAddiction.push(response);
        
        // ulListDrugAddiction.append(templateAddListDrugAddiction(idValue ,textDrugAddiction));
        accordionListDrugAddiction.append(templateAddListAccordionDrugAddiction(id ,textDrugAddiction, descriptionUI));

        clearForm();
        deleteDrugAddiction();
    }

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

    const deleteDrugAddiction = ()=>{
        
        $('.deleteDrugAddiction').off('click');
        $('.deleteDrugAddiction').on('click', function(){
            let id = $(this).parent().data('id');
            dataDrugAddiction = dataDrugAddiction.filter(drugAddiction => drugAddiction.id != id)
            $(this).parent().remove();
        });
        
    }

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


    const getCalculateEPOC = ()=>{
        let numberOfCigarettes = inputNumberOfCigarettes.val();
        let howDateSmoking = inputHowDateSmoking.val();
        let response = null;

        response = calculateEPOC({numberOfCigarettes, howDateSmoking});
        $('#riegoEPOC').html(response.html);
        riskEPOCGlobal = response.text;
    }


}


export const getListDrugAddiction = () => { return dataDrugAddiction; }