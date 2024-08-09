import { activeLoading, disableLoading } from "../loading-screen.js";


export const requestSavePatient = async(dataSend = {})=>{

    activeLoading();

    return new Promise( async(resolve, reject)=>{
        try{
            const {data} = await axios.post(`/patients/save-patient`,dataSend);            
            resolve(data);
            
    
        }catch(error){
            console.log(error);
            const { errors}  = error.response.data;
            reject({title : 'Oops', message : error ? error?.response?.data : 'Hubo un error inesperado al obtener la lista de enfermades','error': error,'status': error?.response?.status || 500, errorList : errors})
        }finally{
            disableLoading();
        }
    });


}