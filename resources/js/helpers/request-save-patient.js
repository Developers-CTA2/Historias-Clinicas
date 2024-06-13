import { activeLoading, disableLoading } from "../loading-screen.js";


export const requestSavePatient = async(dataSend = {})=>{

    activeLoading();

    return new Promise( async(resolve, reject)=>{
        try{
            const resp = await axios.post(`/save-patient`,dataSend);
            
            resolve(resp);

            // reject({title: 'Oops', message: response?.data || 'Hubo un error inesperado al obtener la lista de enfermades',error: 'No found'})
    
        }catch(error){
            console.log(error);
            reject({title : 'Oops', message : error ? error?.response?.data : 'Hubo un error inesperado al obtener la lista de enfermades','error': error,'status': error?.response?.status || 500})
        }finally{
            disableLoading();
        }
    });


}