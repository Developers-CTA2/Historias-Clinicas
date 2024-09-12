import Chart from 'chart.js/auto';
import { Colors, plugins } from 'chart.js';
import { getDataStatistics } from '../helpers';


const options = {
    plugins: {
        colors: {
            forceOverride: false,
        }
    },
    responsive: true,
    scales: {
        y: { beginAtZero: true }
    }
}

let chartLine = null;
let chartBarSex = null;
let chartBarTypePerson = null;


$(function () {

    const bntUpdate = document.getElementById('btnUpdate');
    const canvasLineCharDiseases = document.getElementById('lineCharDiseases');
    const canvasBarCharSex = document.getElementById('barCharSex');
    console.log(canvasLineCharDiseases);

    getDataStatistics().then(data => {
        console.log(data);
        const {
            countMenAndWomen,
            consultationDisease,
            countStudentAndAdministrative
        } = data;


        createChartLine(consultationDisease);
        createChartBar(countMenAndWomen);

    }).catch(error => {
        console.log(error);
    });


    // Create chart

    const createChartLine = (data) => {
        
        if(chartLine){
            chartLine.destroy();
        }

        chartLine = new Chart(
            canvasLineCharDiseases,
            {
                type: 'line',
                data: {
                    labels: data.map(label => label.enfermedad),
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
                options: options
            }
        );
    }


    const createChartBar = (data) => {
        
        if(chartBarSex){
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
                            label: 'Consultas por sexo',
                            data: data.map(row => row.count),
                            backgroundColor: ['rgba(2, 132, 199, 0.2)', 'rgba(2, 132, 199, 0.2)'],
                            borderColor: ['rgba(2, 132, 199, 1)', 'rgba(2, 132, 199, 1)'],
                            borderWidth: 2,
                            borderRadius: 5,
                        }
                    ]
                },
                options: options
            });

    }

    // const chartDiseases = new Chart(
    //     canvasBarChar,
    //     {
    //         type: 'bar',
    //         data: {
    //             labels: data.map(row => row.year),
    //             datasets: [
    //                 {
    //                     label: 'Acquisitions by year',
    //                     data: data.map(row => row.count),
    //                     backgroundColor: 'rgba(2, 132, 199, 0.2)',
    //                     borderColor: 'rgba(2, 132, 199, 1)',
    //                     borderWidth: 2,
    //                     borderRadius: 5,

    //                 }
    //             ]
    //         },
    //         options: options
    //     }
    // );

    // bntUpdate.addEventListener('click', function () {
    //     chartDiseases.data.datasets[0].data = dataUpdate.map(row => row.count);
    //     chartDiseases.update();
    // });

});