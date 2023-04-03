$(document).ready(function () {

    chartWelcome();


});

function chartWelcome() {
    var options = {
        series: [],
        chart: {
            toolbar: {
                show: false,
            },
            height: 350,
            width: "100%",
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        noData: { text: "Cargando ..."},
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: '',
            align: ''
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
            },
        },
        xaxis: {
            categories: [],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    var url = '/data';

    $.getJSON(url, function(response) {
        console.log(response.data);
        chart.updateSeries([{
            name: 'Lecturas',
            data: response.data
        }])
    });

    window.setInterval(function () {

        $.getJSON(url, function(response) {
            console.log(response.data);
            chart.updateSeries([{
                name: 'Lecturas',
                data: response.data
            }])
        });
    }, 3000);
}