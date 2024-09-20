import { activeLoading, disableLoading } from "../loading-screen.js";


export const requestPostConsultation = async(dataSend = {}, id_person = 0)=>{

    activeLoading();

    return new Promise( async(resolve, reject)=>{
        try{
            const { data } = await axios.post(`/patients/consultation/${id_person}/save`, dataSend);
            
            resolve(data);
    
        }catch(error){
            console.log(error);
            reject({title : 'Oops', message : error ? error?.response?.data : 'Hubo un error al guardar la consulta','error': error,'status': error?.response?.status || 500})
        }finally{
            disableLoading();
        }
    });


}