import { activeLoading, disableLoading } from "../loading-screen.js";


export const getDataFIlter = async(params = {}, url)=>{

    const { year, month } = params;

    console.log(year, month);

    activeLoading();

    return new Promise( async(resolve, reject)=>{
        try{
            const resp = await axios.get(`${url}/${month}/${year}`);
            const { status } = resp;
            
            if(status == 200) {
                const { data } = resp;
                resolve(data);
            }

            const {response} = resp;

            reject({title: 'Oops...!', message: response?.data || 'Hubo un error inesperado al obtener la persona',error: 'No found'})
    
        }catch(error){
            
            reject({title : 'Oops...!', message : error ? error?.response?.data : 'Hubo un error inesperado al obtener la persona','error': error,'status': error?.response?.status || 500})
        }finally{
            disableLoading();
        }
    });


}