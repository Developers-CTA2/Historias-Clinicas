/*
    Funcion donde entran 2 arreglos y se valida si son iguales, en caso de ser iguales devuelve un true
 */
export function VerifyChanges(obj1, obj2) {
    const keys1 = Object.keys(obj1);
    const keys2 = Object.keys(obj2);

    if (keys1.length !== keys2.length) {
        return false;
    }

    for (let key of keys1) {
        if (obj1[key] !== obj2[key]) {
            return false;
        }
    }

    return true;
}


export function automaicScroll(campo) {
    $("html, body").animate(
        // hacer scroll hacia la seccion siguiente
        {
            scrollTop: $(campo).offset().top,
        },
        2000
    );
}