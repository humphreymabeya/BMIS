/*global $, document, Chart, LINECHART, data, options, window*/
$(document).ready(function () {

    'use strict';

    // Main Template Color
    var brandPrimary = '#33b35a';


    // ------------------------------------------------------- //
    // Line Chart
    // ------------------------------------------------------ //
    var LINECHART = $('#lineChart');
    var myLineChart = new Chart(LINECHART, {
        type: 'line',
        options: {
            legend: {
                display: true
            }
        },
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "August", "September", "November", "December"],
            datasets: [
                {
                    label: "2018",
                    fill: true,
                    lineTension: 0.3,
                    backgroundColor: "rgba(77, 193, 75, 0.4)",
                    borderColor: brandPrimary,
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 1,
                    pointBorderColor: brandPrimary,
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: brandPrimary,
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 0,
                    data: [50, 20, 60, 31, 52, 22, 40, 49, 63, 53, 90],
                    spanGaps: false
                },
                {
                    label: "2019",
                    fill: true,
                    lineTension: 0.3,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 1,
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: [65, 59, 30, 81],
                    spanGaps: false
                }
            ]
        }
    });

    // ------------------------------------------------------- //
    // Line Chart
    // ------------------------------------------------------ //
    var BARCHART = $('#barChart');
    var myBarChart = new Chart(BARCHART, {
        type: 'bar',
        options: {
            legend: {
                display: true
            }
        },
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "August", "September", "November", "December"],
            datasets: [
                {
                    label: "2019",
                    fill: true,
                    lineTension: 0.3,
                    backgroundColor: "rgba(77, 193, 75, 0.4)",
                    borderColor: brandPrimary,
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    borderWidth: 1,
                    pointBorderColor: brandPrimary,
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: brandPrimary,
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 0,
                    data: [50000, 40000, 60000, 31000, 52000, 22000, 40000, 49000, 63000, 53000, 90000],
                    spanGaps: false
                }
            ]
        }
    })
    // ------------------------------------------------------- //
    // Pie Chart
    // ------------------------------------------------------ //
    // var PIECHART = $('#pieChart');
    // var myPieChart = new Chart(PIECHART, {
    //     type: 'doughnut',
    //     data: {
    //         labels: [
    //             "First",
    //             "Second",
    //             "Third"
    //         ],
    //         datasets: [
    //             {
    //                 data: [300, 50, 100],
    //                 borderWidth: [1, 1, 1],
    //                 backgroundColor: [
    //                     brandPrimary,
    //                     "rgba(75,192,192,1)",
    //                     "#FFCE56"
    //                 ],
    //                 hoverBackgroundColor: [
    //                     brandPrimary,
    //                     "rgba(75,192,192,1)",
    //                     "#FFCE56"
    //                 ]
    //             }]
    //     }
    // });

});
