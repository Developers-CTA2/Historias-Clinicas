import {formatDateForHumans,validateSelectDisease ,validateAllergies, validateFormDateAndReason } from '../helpers';
import { templateAddLiistAccordionPathologicalHistory } from '../templates';



let selectedOption = '';  
let listPathologicalHistory = [];



export const pathologicalHistory = (params ) => {

    const { inputHospitalizations,
        inputSurgeries,
        descriptionHospitalizationsReason,
        descriptionSurgeriesReason,
        descriptionTraumatismReason,
        descriptionTransfusionsReason,
        inputTraumatism,
        inputTransfusions,
        btnAddPathological,
        btnNavItem,
        selectAllergies,
        selectDiseasePersonal,
        descriptionAllergies,
        accordionListPathologicalHistory,
      }  = params;


    //   Initial state
    
    selectedOption = btnNavItem.first().data('bs-target')
    
      btnNavItem.off('click');
      btnNavItem.on('click',function(){
        // managementData();
        selectedOption = '';
        selectedOption = $(this).data('bs-target');
        
        
      });

      
      btnAddPathological.on('click',function(){
        managementData();
        
      });

      const managementData = (chageTap = false)=>{
        const data = elementSelected(selectedOption);

        if(data.title == undefined) return;

        const {title, type,value, reason } = data;
        let id = Math.random().toString(36).substr(2, 9);

        listPathologicalHistory.push({
            ...data,
            id : id
        });

        accordionListPathologicalHistory.append(templateAddLiistAccordionPathologicalHistory(id,title, value, reason));        
        deletePathologicalHistoryItem();
      }

      
      const elementSelected = (value)=>{

        switch(value){
            case '#diseases-tab-pane' : {

                selectDiseasePersonal.removeClass('is-invalid border-danger');
                selectDiseasePersonal.parent().find('span').last().addClass('d-none').text('');

                const textValueDisease = selectDiseasePersonal.select2('data')[0].text;
                const idValueDisease = selectDiseasePersonal.val().trim();

                if(!validateSelectDisease(idValueDisease, selectDiseasePersonal)) return {};

                const data = {
                    title : 'Enfermedad',
                    type : 'enfermedad',
                    value: textValueDisease,
                    idReferenceTable : idValueDisease,
                    reason: 'N/A'
                }

                selectDiseasePersonal.val('0').trigger('change');

                return data;    
            }
            case '#alergias-tab-pane' : {

                const textValueAllergies = selectAllergies.select2('data')[0].text;
                const idValueAllergies = selectAllergies.val();
                const description = descriptionAllergies.val();
                
                if (!validateAllergies({allergies : idValueAllergies, description},{ selectAllergies, textDescription : descriptionAllergies})) return {};

                const data = {
                    title : 'Alergia',
                    type : 'alergia',
                    value: textValueAllergies,
                    idReferenceTable : idValueAllergies,
                    reason: description
                }

                
                selectAllergies.val('0').trigger('change');
                descriptionAllergies.val('');                   

                return data;
            }
            case '#hospitalizaciones-tab-pane' : {

                const date = inputHospitalizations.val();
                const reason = descriptionHospitalizationsReason.val();
                console.log(date, reason);

                if(!validateFormDateAndReason(date, reason, inputHospitalizations, descriptionHospitalizationsReason)) return {}

                const data = {
                    title : 'Hospitalización',
                    type : 'hospitalizacion',
                    value:formatDateForHumans(date),
                    idReferenceTable : null,
                    reason: reason
                }

                inputHospitalizations.val('');
                descriptionHospitalizationsReason.val('');

                return data;
            }
            case '#cirugias-tab-pane' : {

                const date = inputSurgeries.val();
                const reason = descriptionSurgeriesReason.val();

                console.log(date, reason);

                if(!validateFormDateAndReason(date, reason, inputSurgeries, descriptionSurgeriesReason)) return {};

                const data = {
                    title : 'Cirugia',
                    type : 'cirugia',
                    idReferenceTable : null,
                    value:formatDateForHumans(date),
                    reason: reason
                }

                inputSurgeries.val('');
                descriptionSurgeriesReason.val('');

                return data;
            }

            case '#transfusiones-tab-pane' : {

                const date = inputTraumatism.val();
                const reason = descriptionTraumatismReason.val();
                console.log(date, reason);

                if(!validateFormDateAndReason(date, reason, inputTraumatism, descriptionTraumatismReason)) return {};

                const data = {
                    title : 'Transfusión',
                    type : 'transfusion',
                    idReferenceTable : null,
                    value:formatDateForHumans(date),
                    reason: reason
                }

                inputTraumatism.val('');
                descriptionTraumatismReason.val('');

                return data;
            }
            case '#traumatismos-tab-pane':{

                    const date = inputTransfusions.val();
                    const reason = descriptionTransfusionsReason.val();

                    console.log('traumatismos', date, reason);
                    
                    if(!validateFormDateAndReason(date,reason, inputTransfusions, descriptionTransfusionsReason)) return {};
                    

                    const data = {
                        title : 'Traumatismo',
                        type : 'traumatismo',
                        idReferenceTable : null,
                        value:formatDateForHumans(date),
                        reason: reason
                    }

                    inputTransfusions.val('');
                    descriptionTransfusionsReason.val('');
    
                    return data;
            }

            default : {
                return {};
            }

        }

        return {};

      }


    

      const deletePathologicalHistoryItem = () => {
        $('.deletePathologicalHistory').off('click');
        $('.deletePathologicalHistory').on('click', function(){
            const id = $(this).parent().parent().data('id');
            listPathologicalHistory = listPathologicalHistory.filter(pathological => pathological.id != id);   
            $(this).parent().parent().remove();
        });
      }


      const clearForm = () => {
        inputHospitalizations.val('');
        descriptionHospitalizationsReason.val('');
        inputSurgeries.val('');
        descriptionSurgeriesReason.val('');
        inputTraumatism.val('');
        descriptionTraumatismReason.val('');
        inputTransfusions.val('');
        descriptionTransfusionsReason.val('');
        selectAllergies.val('0').trigger('change');
        descriptionAllergies.val('');
        selectDiseasePersonal.val('0').trigger('change');
      
      }

}

export const getListPathologicalHistory = () => { return listPathologicalHistory; }