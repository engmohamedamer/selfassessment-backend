// $.get("/helper/chart", function(data, status) {
//     var chartdata = JSON.parse(data);
//     var barChartData = {
//         labels: [
//             "يناير",
//             "فبراير",
//             "مارس",
//             "ابريل",
//             "مايو",
//             "يونيو",
//             "يوليو",
//             "أغسطس",
//             "سبتمبر",
//             "أكتوبر",
//             "نوفمبر",
//             "ديسمبر"
//         ],
//         datasets: [{
//                 label: chartdata.rejected.lable,
//                 backgroundColor: window.chartColors.red,
//                 data: chartdata.rejected.data
//             },
//             {
//                 label: chartdata.confirmed.lable,
//                 backgroundColor: window.chartColors.green,
//                 data: chartdata.confirmed.data
//             }
//         ]
//     };

//     var ctx = document.getElementById("canvas").getContext("2d");
//     window.myBar = new Chart(ctx, {
//         type: "bar",
//         data: barChartData,
//         options: {
//             title: {
//                 display: true,
//                 text: ""
//             },
//             tooltips: {
//                 mode: "index",
//                 intersect: false
//             },
//             responsive: true,
//             legend: {
//                 position: "bottom"
//             },
//             scales: {
//                 xAxes: [{
//                     stacked: true
//                 }],
//                 yAxes: [{
//                     stacked: true,
//                     scaleLabel: {
//                         display: true,
//                         labelString: "عدد الطلبات خلال العام"
//                     }
//                 }]
//             }
//         }
//     });
// });



//-------------
//- PIE CHART -
//-------------
// Get context with jQuery - using jQuery's .get() method.

$.get("/site/fields", function(data, status) {
    var piecahrtdata = data;
    console.log(piecahrtdata)
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
        labels: piecahrtdata.labels,
        datasets: [{
            data: piecahrtdata.data,
            backgroundColor: piecahrtdata.backgroundColor,
        }]
    }


    var pieOptions = {
            legend: {
                display: false
            }
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
    })

})


//-----------------
//- END PIE CHART -
//-----------------