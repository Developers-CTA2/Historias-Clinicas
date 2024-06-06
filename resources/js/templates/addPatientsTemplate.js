export const templateSelectDisease = (data = []) => {
    
    const template = data.map( disease => `<option value="${disease.id}">${disease.name}</option>`).join(``);
    
    return template;
}