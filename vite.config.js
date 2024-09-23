import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/main.scss',
                'resources/sass/app.scss',
                'resources/sass/home.scss',
                'resources/sass/sideBar.scss',  
                'resources/sass/loadingScreen.scss', 
                
                'resources/js/app.js',
                'resources/js/SideBar.js',
                'resources/js/patients/seePatient.js',
                'resources/js/modal.js', 

            ],
            refresh: true,
        }),
    ],
});
