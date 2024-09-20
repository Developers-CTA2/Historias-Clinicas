export const historyConsultationTemplate = (data = []) => {

    return data.map((consultation) => {
        const { id_consulta, id_persona, fecha, motivo_consulta } = consultation;
        return `<li class="event" data-date="${fecha}">
                    <a href="/patients/consultation/${id_persona}/history/${id_consulta}/details" aria-label="linkConsultation">
                        <h3>Motivo de consulta</h3>
                            ${motivo_consulta}
                    </a>
                </li>`
    }).join('');

}

export const nutritionHistoryConsultation = (data = []) => {
    return data.map((consultation) => {
        const { id_nutricional, id_persona, fecha, motivo_consulta } = consultation;
        return `<li class="event" data-date="${fecha}">
                    <a href="/patients/nutrition/${id_persona}/history/${id_nutricional}/details" aria-label="linkConsultation">
                        <h3>Motivo de consulta</h3>
                            ${motivo_consulta}
                    </a>
                </li>`
    }).join('');
}

export const nutritionHistoryConsultationEmpty = () => {
    return `
    <li>
        El paciente no tiene un historial nutricional.
    </li>`
}