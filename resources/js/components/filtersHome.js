import { getDataFIlter } from "../helpers/request-get-data-filter-home";

const dateNow = new Date();

const filters = {
    yearDisease : dateNow.getFullYear(),
    monthDisease : dateNow.getMonth() + 1,
    yearSex : dateNow.getFullYear(),
    monthSex : dateNow.getMonth() + 1,
    yearTypePerson : dateNow.getFullYear() ,
    monthTypePerson : dateNow.getMonth() + 1
}

const urlStatisticsDisease = '/home/data-statistics-diseases';
const urlStatisticsSex = '/home/data-statistics-sex';
const urlStatisticsTypePerson = '/home/data-statistics-type-person';


export const filtersHome = ({chartBarSex, chartBarTypePerson, chartLine})=>{

    console.log(chartLine);

    // Diseases
    const filterYearDisease = document.getElementById('yearDiseaseChart');
    const filterMonthDisease = document.getElementById('monthDiseaseChart');

    console.log(filterYearDisease);

    // Sex
    const filterYearSex = document.getElementById('yearSexChart');
    const filterMonthSex = document.getElementById('monthSexChart');

    // Type person
    const filterYearTypePerson = document.getElementById('yearTypePersonChart');
    const filterMonthTypePerson = document.getElementById('monthTypePersonChart');

    const manageDataDisease = (data) => { 
        const { consultationDisease } = data;
        chartLine.data.labels = consultationDisease.map(label => label.nombre);
        chartLine.data.datasets[0].data = consultationDisease.map(data => data.count);
        chartLine.update();
    }  

    const manageDataSex = (data) => {
        console.log(data);
        const { countMenAndWomen } = data;
        chartBarSex.data.labels = countMenAndWomen.map(label => label.sexo);
        chartBarSex.data.datasets[0].data = countMenAndWomen.map(data => data.count);
        chartBarSex.update();
    }

    const manageDataTypePerson = (data) => {
        console.log(data);
        const { countStudentAndAdministrative } = data;
        console.log(countStudentAndAdministrative);
        chartBarTypePerson.data.labels = countStudentAndAdministrative.map(data => data.group);
        chartBarTypePerson.data.datasets[0].data = countStudentAndAdministrative.map(data => data.count);
        chartBarTypePerson.update();

    }

    const manageFilterYearDisease = ({target}) => {
        filters.yearDisease = target.value;
        console.log(target.value);
        getDataFIlter({year: filters.yearDisease, month: filters.monthDisease}, urlStatisticsDisease).then(manageDataDisease).catch(console.log);
    }

    const manageFilterMonthDisease = ({target}) => {
        filters.monthDisease = target.value;

        getDataFIlter({year: filters.yearDisease, month: filters.monthDisease}, urlStatisticsDisease).then(manageDataDisease).catch(console.log);
    }

    const manageFilterYearSex = ({target}) => {
        filters.yearSex = target.value;

        getDataFIlter({year: filters.yearSex, month: filters.monthSex}, urlStatisticsSex).then(manageDataSex).catch(console.log);
    }

    const manageFilterMonthSex = ({target}) => {
        filters.monthSex = target.value;

        getDataFIlter({year: filters.yearSex, month: filters.monthSex}, urlStatisticsSex).then(manageDataSex).catch(console.log);
    }

    const manageFilterYearTypePerson = ({target}) => {
        filters.yearTypePerson = target.value;

        getDataFIlter({year: filters.yearTypePerson, month: filters.monthTypePerson}, urlStatisticsTypePerson).then(manageDataTypePerson).catch(console.log);
    }

    const manageFilterMonthTypePerson = ({target}) => {
        filters.monthTypePerson = target.value;

        getDataFIlter({year: filters.yearTypePerson, month: filters.monthTypePerson}, urlStatisticsTypePerson).then(manageDataTypePerson).catch(console.log)
    }

    filterYearDisease.addEventListener('change', manageFilterYearDisease);
    filterMonthDisease.addEventListener('change', manageFilterMonthDisease);
    filterYearSex.addEventListener('change', manageFilterYearSex);
    filterMonthSex.addEventListener('change', manageFilterMonthSex);
    filterYearTypePerson.addEventListener('change', manageFilterYearTypePerson);
    filterMonthTypePerson.addEventListener('change', manageFilterMonthTypePerson);
    

}