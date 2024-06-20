export const templateSelectDisease = (data = []) => {

    let template = `<option value="" selected disabled>Seleccione una enfermedad</option>`;
    template += data.map(disease => `<option value="${disease.id_especifica_ahf}">${disease.nombre}</option>`).join(``);

    return template;
}

export const templateAddListDisease = (id, name) => {
    return `
    <li class="list-group-item d-flex justify-content-between align-items-center gap-2" data-id="${id}">
    <div class="me-auto fw-bold">
        ${name}
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" class="icon-delete-opcion deleteDeisease"
        viewBox="0 0 24 24">
        <path fill="#e11d48"
            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-11.414L9.172 7.757L7.757 9.172L10.586 12l-2.829 2.828l1.415 1.415L12 13.414l2.828 2.829l1.415-1.415L13.414 12l2.829-2.828l-1.415-1.415z" />
    </svg>
</li>
    `;
}

export const templateAddSelectListDiseases = (id, name) => `<option value="${id}">${name}</option>`;

/* No se utiliza por el momento */
export const templateAddListDrugAddiction = (id, name) => {
    return `
    <li  class="list-group-item d-flex justify-content-between align-items-center gap-2" data-id="${id}">
    <div class="me-auto fw-bold">
        ${name}
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" class="icon-delete-opcion deleteDrugAddiction"
        viewBox="0 0 24 24">
        <path fill="#e11d48"
            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-11.414L9.172 7.757L7.757 9.172L10.586 12l-2.829 2.828l1.415 1.415L12 13.414l2.828 2.829l1.415-1.415L13.414 12l2.829-2.828l-1.415-1.415z" />
    </svg>
</li>
    `
}

export const templateAddListAccordionDrugAddiction = (id, name, description) => {
    return `<div class="accordion-item">
    <h2 class="accordion-header d-flex align-items-center justify-content-center">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${id}" aria-expanded="false"  aria-controls="collapse${id}">
        ${name}
      </button>
      <svg xmlns="http://www.w3.org/2000/svg" class="icon-delete-opcion mx-2 deleteDrugAddiction"
        viewBox="0 0 24 24">
        <path fill="#e11d48"
            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-11.414L9.172 7.757L7.757 9.172L10.586 12l-2.829 2.828l1.415 1.415L12 13.414l2.828 2.829l1.415-1.415L13.414 12l2.829-2.828l-1.415-1.415z" />
    </svg>
    </h2>
    <div id="collapse${id}" class="accordion-collapse collapse" data-bs-parent="#listDrugAddictionSelected">
      <div class="accordion-body">${description}</div>
    </div>
  </div>`
}

export const templateAddPathologicalHistory = (title, inputDate) => {
    return `
    <li  class="list-group-item d-flex justify-content-between align-items-center gap-2" >
    <div class="me-auto">
        <div class="fw-bold">${title}</div>
        ${inputDate}
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" class="icon-delete-opcion deletePathologicalHistory"
        viewBox="0 0 24 24">
        <path fill="#e11d48"
            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-11.414L9.172 7.757L7.757 9.172L10.586 12l-2.829 2.828l1.415 1.415L12 13.414l2.828 2.829l1.415-1.415L13.414 12l2.829-2.828l-1.415-1.415z" />
    </svg>
</li>
    `
}

export const templateAddLiistAccordionPathologicalHistory = (id,title, inputDate, description) => {
    return `<div class="accordion-item" data-id=${id}>
    <h2 class="accordion-header d-flex align-items-center justify-content-center">
      <button class="accordion-button collapsed d-block" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${id}" aria-expanded="true"  aria-controls="collapse${id}">
            <div class="fw-bold mb-1">${title}</div>
            ${inputDate}
      </button>
      <svg xmlns="http://www.w3.org/2000/svg" class="icon-delete-opcion mx-2 deletePathologicalHistory"
        viewBox="0 0 24 24">
        <path fill="#e11d48"
            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m0-11.414L9.172 7.757L7.757 9.172L10.586 12l-2.829 2.828l1.415 1.415L12 13.414l2.828 2.829l1.415-1.415L13.414 12l2.829-2.828l-1.415-1.415z" />
    </svg>
    </h2>
    <div id="collapse${id}" class="accordion-collapse collapse" data-bs-parent="#listDrugAddictionSelected">
      <div class="accordion-body">${description}</div>
    </div>
  </div>`

}


