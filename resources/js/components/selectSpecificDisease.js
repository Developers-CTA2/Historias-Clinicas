import { templateAddListDisease, templateAddSelectListDiseases } from '../templates/addPatientsTemplate';

let listDiseases = [];

export const selectDynamicSpecificDisease = (selectDisease, ulListDiseases) => {


    selectDisease.on('change', function(){
        const diseaseValue = $(this).val();
        const diseaseText = selectDisease.select2('data')[0].text


        ulListDiseases.append(templateAddListDisease(diseaseValue,diseaseText));
        selectDisease.find('option:selected').remove();

        listDiseases.push({
            id: diseaseValue,
            name: diseaseText
        });

        console.log(listDiseases);

        deleteDiseaseListFuncion();
    });

     // Delete item 
     const deleteDiseaseListFuncion = () => {
        $('.deleteDeisease').off('click');
        $('.deleteDeisease').on('click', function () {
    
    
            // Obtener el id y el nombre del permiso
            let id = $(this).parent().data('id');
            let name = $(this).parent().text().trim();

            console.log(id);

            listDiseases = listDiseases.filter((disease, index) => disease.id != id)

            // Se inserta en el select
            selectDisease.append(templateAddSelectListDiseases(id,name));
            $(this).parent().remove();

        });
    
    }

}

export const getListDiseases = () => { return listDiseases; }


