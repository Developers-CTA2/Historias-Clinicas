
/* 
Funcion para manejar la lógica de las toxicomanías, se recibe un objeto con los siguientes parametros:

- valueDrugAddiction: Valor del select de toxicomanías
- valueNumberOfCigarettes: Valor del input de cantidad de cigarrillos
- valueHowDateSmoking: Valor del input de años de fumador
- valueHowOtherDrugs: Valor del input de frecuencia de consumo
- valueDescriptionOtherDrugs: Valor del input de descripción de otras drogas
- riskEPOCGlobal: Valor del riesgo EPOC en texto

*/


const result = {
    id: '',
    idReferenceTable: '',
    date: '',
    description: '',
    descriptionUI: ''
};

export const manageDrugAddictions = (parameters) => {

    // Obtener los parametros de la función
    const { optionDrugAddiction, valueNumberOfCigarettes, valueHowDateSmoking, valueHowOtherDrugs, valueDescriptionOtherDrugs, riskEPOCGlobal } = parameters;
    // Almacena el resultado a retornar
    

    // Generar un id aleatorio
    let idRandom = Math.random().toString(36).substr(2, 9);
    result.id = '';
    result.idReferenceTable = '';
    result.date = '';
    result.description = '';
    result.descriptionUI = '';
    

    if (optionDrugAddiction == '1') {
        result.id = idRandom;
        result.idReferenceTable = optionDrugAddiction;
        result.date = valueHowDateSmoking;
        result.description = `${valueNumberOfCigarettes},riesgoEPOC,${riskEPOCGlobal}`;
        result.descriptionUI = `Cantidad de cigarrillos por día: ${valueNumberOfCigarettes}  |  Años de fumador: ${valueHowDateSmoking} años  |  Riesgo EPOC: ${riskEPOCGlobal}`;
            
    } else {
        result.id = idRandom;
        result.idReferenceTable = optionDrugAddiction;
        result.date = valueHowOtherDrugs;
        result.description = `${valueHowOtherDrugs},${valueDescriptionOtherDrugs}`;
        result.descriptionUI = `Frecuencia de consumo: ${valueHowOtherDrugs}  |  Descripción: ${valueDescriptionOtherDrugs}`;
    }

    return result;

}


export const calculateEPOC = (parameters) => {
    const { numberOfCigarettes, howDateSmoking } = parameters;
    // let numberOfCigarettes = inputNumberOfCigarettes.val();
    // let howDateSmoking = inputHowDateSmoking.val();

    let result = {
        risk: "",
        html: "",
    };

    if (numberOfCigarettes != '' && howDateSmoking != '') {
        const resultEPOCT = (numberOfCigarettes * howDateSmoking) / 20;
      let data = riskEPOCTemplate(resultEPOCT);    
        result = {
            risk: data.text ?? '',
            html: data.html ?? '',
        }
    }

    return result;
}


const riskEPOCTemplate = (result) => {

    let template = {}

    if (result < 10) {
        template = { text: 'Nulo', html: '<span class="badge-custom badge-custom-success">Nulo</span>' };
    }
    else if (result >= 10 && result <= 20) {
        template = { text: 'Moderado', html: '<span class="badge-custom badge-custom-moderade">Moderado</span>' }; 
    }
    else if (result > 20 && result < 41) {

        template = { text: 'Intenso', html: '<span class="badge-custom badge-custom-warning">Intenso</span>' };
    }
    else if (result > 40) {
        template = { text: 'Alto', html: '<span class="badge-custom badge-custom-danger">Alto</span>' };
    } else {
        template = { text: null, html: null };
    }


    return template;

}

