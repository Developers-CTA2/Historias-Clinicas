
export const getAllSpecificDiseases = async(dataSend = {})=>{

    return new Promise( async(resolve, reject)=>{
        try{
            const { data } = await axios.get(`/api/get-all-diseases`);
            resolve(data);
    
        }catch(error){
            console.log(error);
            reject({title : 'Oops', message : error ? error?.response?.data : 'Hubo un error inesperado al obtener la lista de enfermades','error': error,'status': error?.response?.status || 500})
        }
    });


}