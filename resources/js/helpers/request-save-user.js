import { activeLoading, disableLoading } from "../loading-screen.js";
const headers = {
    'Content-Type': 'multipart/form-data'
}


export const requestSaveUser = async(dataSend)=>{

    activeLoading();
    console.log(dataSend);

    return new Promise( async(resolve, reject)=>{
        try{
            const {data} = await axios.post(`/users/new-user`,dataSend, headers);  
            console.log(data);          
            resolve(data);
            
    
        }catch(error){
            console.log(error);
            const { errors }  = error.response.data;
            reject({title : 'Oops...!', message : error ? error?.response?.data : 'Hubo un error inesperado al guardar el usuario','error': error,'status': error?.response?.status || 500, errorList : errors})
        }finally{
            disableLoading();
        }
    });


}