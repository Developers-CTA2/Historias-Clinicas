import { templateSelectDisease } from '../templates';
import { getDiseaseByTypeAHF } from '../helpers';

let dataDisease = {};
let completedGetTypes = false;

let localSelectTypeAHF = null;
let localSelectDisease = null;


const saveLocal = (index = '', data = [])=>{
    dataDisease[index] = data;
}

const getDiseaseElements = (id = '', index = '')=>{

    if(dataDisease[index].length === 0){

        getDiseaseByTypeAHF({id}).then(data => {
            console.log(data);
        }).catch(error => {
            console.log(error);
        });

        
    }else{
        localSelectDisease.html(templateSelectDisease(dataDisease[index]));
    }
    
}

export const selectDynamicTypeAHF = (selectTypeAHF, selectDisease) => {

    localSelectTypeAHF = selectTypeAHF;
    localSelectDisease = selectDisease;


    if (!completedGetTypes) {

        selectTypeAHF.children().each((index, element) => {
            if(index === 0) return;
            let text = $(element).text();

            dataDisease[text] = [];
        });
        completedGetTypes = true;
    }



    selectTypeAHF.on('change', function(){
        let value = $(this).val();
        let text = $(this).children('option:selected').text();
        getDiseaseElements(value, text);
    });


    selectDisease.on('change', function(){

    });

}