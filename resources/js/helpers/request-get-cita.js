import { activeLoading, disableLoading } from "../loading-screen.js";


export const requestGetCita = async(id)=>{

    activeLoading();
    return new Promise( async(resolve, reject)=>{
        try{
            
            const { data } = await axios.get(`/citas/get-citas/${id}`);
            
            resolve(data);
    
        }catch(error){
            console.log(error);
            reject({title : 'Oops', message : error ? error?.response?.data : 'Hubo un error inesperado al obtener la persona','error': error,'status': error?.response?.status || 500})
        }finally{
            disableLoading();
        }
    });


}