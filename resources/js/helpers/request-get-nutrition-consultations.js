import { activeLoading, disableLoading } from "../loading-screen.js";


export const requestGetNutritionConsultation = async(dataSend = {})=>{

    activeLoading();

    return new Promise( async(resolve, reject)=>{
        try{
            
            const { data } = await axios.get(`/patients/nutrition/${dataSend.idPersona}/history/get-consultation`,{
                params : {
                    limit : dataSend.limit,
                    offset : dataSend.page * dataSend.limit
                }
            });
            console.log(data);
            resolve(data);
    
        }catch(error){
            console.log(error);
            reject({title : 'Oops', message : error ? error?.response?.data : 'Hubo un error inesperado al obtener la persona','error': error,'status': error?.response?.status || 500})
        }finally{
            disableLoading();
        }
    });


}