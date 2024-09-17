export const listErrorsForStoreUser = (errors) => {
    let errorsList = '';
    for (const [key, messages] of Object.entries(errors)) {
        errorsList += `<li>${messages[0]}</li>`;
    }
    return errorsList;
};