import { templateAddListDrugAddiction, templateAddListAccordionDrugAddiction } from '../templates';

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
            textDrugAddiction: selectDrugAddiction.find('option:selected').text(),
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
        descriptionOtherDrugs.next().addClass('d-none').text('');
        


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
            descriptionOtherDrugs.next().text('Debes ingresar un valor').removeClass('d-none');
            validate = false;
        }

        if(valueDrugAddiction == '2' && valueHowOtherDrugs == ''){
            inputHowOtherDrugs.addClass('is-invalid border-danger');
            inputHowOtherDrugs.next().text('Debes ingresar un valor').removeClass('d-none');
            validate = false;
        }   

        if(valueDrugAddiction == '2' && valueDescriptionOtherDrugs == ''){
            descriptionOtherDrugs.addClass('is-invalid border-danger');
            descriptionOtherDrugs.next().text('Debes ingresar un valor').removeClass('d-none');
            validate = false;
        }

        return validate;

    }

    const addedListDrugAddiction = (data)=>{

        const { valueDrugAddiction, textDrugAddiction, valueNumberOfCigarettes, valueHowDateSmoking, valueHowOtherDrugs, valueDescriptionOtherDrugs } = data;
        let idValue = Math.random().toString(36).substr(2, 9);
        let description = '';
        
        if(valueDrugAddiction == '1' ){
            dataDrugAddiction.push({
                id: idValue,
                input1 : valueNumberOfCigarettes,
                input2 : valueHowDateSmoking
            });
            description = `Cantidad de cigarrillos: ${valueNumberOfCigarettes} - Años de fumador: ${valueHowDateSmoking} | Riesgo EPOC: ${riskEPOCGlobal}`;
        }else{
            dataDrugAddiction.push({
                id: idValue,
                input1 : valueHowOtherDrugs,
                input2 : valueDescriptionOtherDrugs
            });
            description = `Frecuencia de consumo: ${valueHowOtherDrugs} - Descripción: ${valueDescriptionOtherDrugs}`;  
        }

        templateAddListAccordionDrugAddiction
        // ulListDrugAddiction.append(templateAddListDrugAddiction(idValue ,textDrugAddiction));
        accordionListDrugAddiction.append(templateAddListAccordionDrugAddiction(idValue ,textDrugAddiction, description));

        console.log(dataDrugAddiction);

        clearForm();
        deleteDrugAddiction();
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
        $('#riegoEPOC').text('Nulo');
    }


    // Calculate EPOC
    inputNumberOfCigarettes.on('keyup', function(){
        calculateEPOC();
    });

    inputHowDateSmoking.on('keyup', function(){
        calculateEPOC();
    })


    const calculateEPOC = ()=>{
        let numberOfCigarettes = inputNumberOfCigarettes.val();
        let howDateSmoking = inputHowDateSmoking.val();
        let result = 0;

        console.log('numberOfCigarettes', numberOfCigarettes, 'howDateSmoking', howDateSmoking);
        if(numberOfCigarettes != '' && howDateSmoking != ''){
            result = (numberOfCigarettes * howDateSmoking) / 20;
            riskEPOCGlobal = riskEPOC(result);
            
            $('#riegoEPOC').text(riskEPOCGlobal);
            
        }
    }


    const riskEPOC = (result)=>{
        if(result < 10) return 'Nulo';
        if(result >= 10 && result <= 20) return 'Moderado';
        if(result > 20 && result < 41) return 'Intenso';
        if(result > 40) return 'Alto';

        return 'Sin dato';
    }

}


export const getListDrugAddiction = () => { return dataDrugAddiction; }