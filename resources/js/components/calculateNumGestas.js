import { regexNumero} from '../helpers/Regex.js';

export const calculateNumGestas = (inputsDom, inputValue)=>{

    const {inputNumPartos, inputNumCesareas, inputNumAbortos} = inputsDom;

    inputNumAbortos.on('keyup', function(){
        inputValue.val(getCalculateNumGestas());
    });

    inputNumCesareas.on('keyup', function(){
        inputValue.val(getCalculateNumGestas());
    });

    inputNumPartos.on('keyup', function(){
        inputValue.val(getCalculateNumGestas());
    });




    const getCalculateNumGestas = ()=>{

        if((inputNumPartos != '' && !regexNumero.test(inputNumPartos.val())) && (inputNumCesareas.val() != '' && !regexNumero.test(inputNumCesareas.val())) && (inputNumAbortos.val() != '' && !regexNumero.test(inputNumAbortos.val()))) return 0;
        
        let numPartos = inputNumPartos.val() == '' ? 0 : inputNumPartos.val();
        let numCesareas = inputNumCesareas.val() == '' ? 0 : inputNumCesareas.val();
        let numAbortos = inputNumAbortos.val() == '' ? 0 : inputNumAbortos.val();
    
        return (
            parseInt(numPartos) + parseInt(numCesareas) + parseInt(numAbortos)
        )
    }

}

