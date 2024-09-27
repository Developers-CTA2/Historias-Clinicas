import { activeLoading, disableLoading } from "../loading-screen.js";

export const getDiseaseByTypeAHF = async(dataSend = {})=>{

    activeLoading();

    return new Promise( async(resolve, reject)=>{
        try{
            const resp = await axios.get(`/api/get-deseases/${dataSend.id}`);
            console.log(resp);
            const {status} = resp;
            
            if(status == 200) {
                const { data } = resp;
                resolve(data);
            }

            const {response} = resp;

            reject({title: 'Oops', message: response?.data || 'Hubo un error inesperado al obtener la lista de enfermades',error: 'No found'})
    
        }catch(error){
            console.log(error);
            reject({title : 'Oops', message : error ? error?.response?.data : 'Hubo un error inesperado al obtener la lista de enfermades','error': error,'status': error?.response?.status || 500})
        }finally{
            disableLoading();
        }
    });


}