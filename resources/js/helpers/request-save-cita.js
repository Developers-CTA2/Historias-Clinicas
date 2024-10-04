import { activeLoading, disableLoading } from "../loading-screen.js";


export const requestSaveCita = async(dataSend = {})=>{

    activeLoading();

    return new Promise( async(resolve, reject)=>{
        try{
            const { data } = await axios.post(
                `/calendar/medical_appointment/save_appointment`,
                dataSend
            );
            
            resolve(data);
    
        }catch(error){
            
            const { errors }  = error.response.data;
            reject({title : 'Oops...!', message : error ? error?.response?.data : 'Hubo un error al guardar la cita','error': error,'status': error?.response?.status || 500, 'errorList' : errors})
        }finally{
            disableLoading();
        }
    });


}