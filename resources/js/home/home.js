import Chart from 'chart.js/auto';
import { Colors, layouts, Legend, plugins } from 'chart.js';
import { AlertError, getDataStatistics } from '../helpers';
import { filtersHome } from '../components';


const options = {

    responsive: true,
    scales: {
        y: { beginAtZero: true }
    },
    layout: {
        padding: 10
    },

}

let chartLine = null;
let chartBarSex = null;
let chartBarTypePerson = null;


$(function () {

    const canvasLineCharDiseases = document.getElementById('lineCharDiseases');
    const canvasBarCharSex = document.getElementById('barCharSex');
    const canvasBarCharTypePerson = document.getElementById('barCharTypePerson');

    // Containers skeleton
    const skeletonContainers = document.querySelectorAll('.skeleton-charts');

    


    const manageData = (data) => {
        const {
            countMenAndWomen,
            consultationDisease,
            countStudentAndAdministrative
        } = data;

        skeletonContainers.forEach(container => container.classList.add('d-none'));

        createChartLine(consultationDisease);
        createChartBar(countMenAndWomen);
        createChartBarTypePerson(countStudentAndAdministrative);

        // Filters
        filtersHome({chartBarSex, chartBarTypePerson, chartLine});
    }

    const manageError = (error) => {
        const { title, message } = error;
        skeletonContainers.forEach(container => container.classList.remove('d-none'));
        AlertError(title, message.msg);
    }
    
    getDataStatistics().then(manageData).catch(manageError);


    // Create chart

    const createChartLine = (data) => {

        if (chartLine) {
            chartLine.destroy();
        }

        chartLine = new Chart(
            canvasLineCharDiseases,
            {
                type: 'line',
                data: {
                    labels: data.map(label => label.nombre),
                    datasets: [
                        {
                            label: 'Consultas por enfermedad',
                            data: data.map(count => count.count),
                            backgroundColor: 'rgba(2, 132, 199, 0.2)',
                            borderColor: 'rgba(2, 132, 199, 1)',
                            borderWidth: 2,
                            borderRadius: 5,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    ...options,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            }
        );
    }


    const createChartBar = (data) => {

        if (chartBarSex) {
            chartBarSex.destroy();
        }

        chartBarSex = new Chart(
            canvasBarCharSex,
            {
                type: 'bar',
                data: {
                    labels: data.map(row => row.sexo),
                    datasets: [
                        {
                            data: data.map(row => row.count),
                            backgroundColor: ['rgba(2, 132, 199, 0.2)', 'rgba(2, 132, 199, 0.2)'],
                            borderColor: ['rgba(2, 132, 199, 1)', 'rgba(2, 132, 199, 1)'],
                            borderWidth: 2,
                            borderRadius: 5,
                        }
                    ]
                },
                options: {
                    ...options,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

    }

    const createChartBarTypePerson = (data) => {

        if (chartBarTypePerson) {
            chartBarTypePerson.destroy();
        }

        chartBarTypePerson = new Chart(canvasBarCharTypePerson, {
            type: 'bar',
            data: {
                labels: data.map(row => row.group),
                datasets: [
                    {
                        label: 'Consultas por tipo de persona',
                        data: data.map(row => row.count),
                        backgroundColor: ['rgba(2, 132, 199, 0.2)', 'rgba(2, 132, 199, 0.2)'],
                        borderColor: ['rgba(2, 132, 199, 1)', 'rgba(2, 132, 199, 1)'],
                        borderWidth: 2,
                        borderRadius: 5,
                    }
                ]
            },
            options: {
                ...options,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        })
    }






    // bntUpdate.addEventListener('click', function () {
    //     chartDiseases.data.datasets[0].data = dataUpdate.map(row => row.count);
    //     chartDiseases.update();
    // });

});