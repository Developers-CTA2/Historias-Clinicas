import { activeLoading, disableLoading } from "../loading-screen.js";


export const getPerson = async(dataSend = {})=>{

    activeLoading();

    return new Promise( async(resolve, reject)=>{
        try{
            const resp = await axios.post('/api/get-person',dataSend);
            console.log(resp);
            const {status} = resp;
            
            if(status == 200) {
                const { data } = resp;
                resolve(data);
            }

            const {response} = resp;

            reject({title: 'Oops', message: response?.data || 'Hubo un error inesperado al obtener la persona',error: 'No found'})
    
        }catch(error){
            console.log(error);
            reject({title : 'Oops', message : error ? error?.response?.data : 'Hubo un error inesperado al obtener la persona','error': error,'status': error?.response?.status || 500})
        }finally{
            disableLoading();
        }
    });


}