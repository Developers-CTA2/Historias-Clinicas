import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';


export default defineConfig({
    resolve: {
        alias: {
            '~bootstrap' : path.resolve(__dirname, 'node_modules/bootstrap'),
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/sass/main.scss",
                "resources/sass/app.scss",
                "resources/sass/home.scss",
                "resources/sass/sideBar.scss",
                "resources/sass/loadingScreen.scss",
                "resources/sass/login.scss",
                "resources/sass/home.scss",
                "resources/sass/form-style.scss",
                "resources/sass/add-patients.scss",
                "resources/sass/expedient.scss",
                "resources/sass/history-consultation.scss",
                "resources/sass/new-consultation.scss",
                "resources/sass/agenda.scss",
                "resources/sass/citas.scss",
                "resources/sass/diseases.scss",
                "resources/sass/users.scss",
                "resources/sass/drag-and-drop-file.scss",
                "resources/sass/details-nutrition-consultation.scss",

                "resources/js/app.js",
                "resources/js/SideBar.js",
                "resources/js/patients/seePatient.js",
                // "resources/js/modal.js",
                "resources/js/auth.js",
                "resources/js/home/home.js",
                "resources/js/perfil/perfil.js",
                "resources/js/addPatients.js",
                "resources/js/patients/expedient/edit_personal_data.js",
                "resources/js/patients/expedient/edit_AHF.js",
                "resources/js/patients/expedient/edit_APNP.js",
                "resources/js/patients/expedient/edit_Gyo.js",
                "resources/js/patients/expedient/buttonUp.js",
                "resources/js/patients/expedient/Diseases_Allergies.js",
                "resources/js/patients/expedient/APP_Management.js",
                "resources/js/patients/historyConsultation.js",
                "resources/js/consultations/detailsConsultation.js",
                "resources/js/patients/newConsultation.js",
                "resources/js/agenda.js",
                "resources/js/citas.js",
                "resources/js/administrar/seeDiseases.js",
                "resources/js/administrar/seeAdictions.js",
                "resources/js/administrar/seeEspecific.js",
                "resources/js/administrar/seeAllergies.js",
                "resources/js/users/AddUser.js",
                "resources/js/users/seeUsers.js",
                "resources/js/users/AddUser.js",
                "resources/js/users/Users.js",
                "resources/js/patients/nutritionHistoryConsultation.js",
                "resources/js/consultationNutrition.js",
                "resources/js/consultations/detailsConsultation.js",
                "resources/js/completeHistoryNutrition.js",
            ],
            refresh: true,
        }),
    ],
});
