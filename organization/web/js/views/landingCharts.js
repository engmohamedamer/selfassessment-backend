    // $.ajax({
    //     url: "/site/org-survey-stats",
    //     type: "GET",
    //     beforeSend: function() { $('.participantsStatus-preloader').show() },
    //     complete: function() {},
    //     success: res => {
    //         var ctx = document.getElementById('participantsStatusChart').getContext('2d');
    //         var chart = new Chart(ctx, {
    //             type: 'doughnut',
    //             data: {
    //                 datasets: [{
    //                     data: res.data,
    //                     backgroundColor: [
    //                         "#2ecc71",
    //                         "#f39c12",
    //                         "#22CECE"
    //                     ],
    //                 }],
    //                 labels: res.labels
    //             },
    //             options: {
    //                 responsive: true,
    //                 legend: {
    //                     display: false
    //                 },
    //                 // tooltips: {
    //                 //     callbacks: {
    //                 //       label: function(tooltipItem) {
    //                 //         console.log(tooltipItem)
    //                 //             return tooltipItem.yLabel;
    //                 //         }
    //                 //   }
    //                 // }
    //             }
    //         });
    //         $('.participantsStatus-preloader').hide()
    //     },
    //     error: function(err) {
    //         console.log(err);
    //         $('.participantsStatus-preloader').hide()
    //     }
    // });

    // var primcolor = $("body").attr("data-Primcolor")

    // $.ajax({
    //     url: "/site/org-survey",
    //     type: "GET",
    //     beforeSend: function() { $('.assessmentParticipants-preloader').show() },
    //     complete: function() {},
    //     success: res => {
    //         $('.assessmentParticipants-preloader').hide()
    //         var ctx = document.getElementById('assessmentParticipantsChart').getContext('2d');
    //         var chart = new Chart(ctx, {



    //             type: 'line',
    //             data: {
    //                 labels: res.labels,
    //                 datasets: [{
    //                     label: 'عدد المشاركين في الإستبيان',
    //                     data: res.data,
    //                     backgroundColor: 'transparent',
    //                     borderColor: primcolor,
    //                     pointBorderColor: primcolor,
    //                     pointBackgroundColor: primcolor,
    //                     // backgroundColor: [
    //                     //     'rgba(255, 99, 132, 0.2)',

    //                     //     // '#16a085',
    //                     //     // '#e67e22',
    //                     //     // '#2c3e50',
    //                     //     // '#2980b9',
    //                     //     // '#c0392b',
    //                     //     // '#27ae60',
    //                     //     // '#f39c12'
    //                     // ],
    //                     // borderColor: [
    //                     //     'rgba(255, 99, 132, 1)',
    //                     //     'rgba(54, 162, 235, 1)',
    //                     //     'rgba(255, 206, 86, 1)',
    //                     //     'rgba(75, 192, 192, 1)',
    //                     //     'rgba(153, 102, 255, 1)',
    //                     //     'rgba(153, 102, 255, 1)',
    //                     //     'rgba(255, 159, 64, 1)'
    //                     // ],
    //                     // borderWidth: 1
    //                 }]
    //             },
    //             options: {
    //                 responsive: true,

    //                 tooltips: {
    //                     mode: "index",
    //                     intersect: false
    //                 },
    //                 hover: {
    //                     mode: "nearest",
    //                     intersect: true
    //                 },
    //                 legend: {
    //                     labels: {
    //                         // This more specific font property overrides the global property
    //                         // fontColor: '#ccc'
    //                     }
    //                 },
    //                 scales: {
    //                     xAxes: [{
    //                         display: true,
    //                         scaleLabel: {
    //                             display: false,
    //                         },
    //                         ticks: {
    //                             beginAtZero: true,
    //                             //fontColor: '#ccc'
    //                         }
    //                     }],
    //                     yAxes: [{
    //                         display: true,
    //                         scaleLabel: {
    //                             display: false
    //                         },
    //                         ticks: {
    //                             beginAtZero: true,
    //                             //fontColor: '#ccc'
    //                         },
    //                     }]
    //                 },
    //             }
    //         });

    //     },
    //     error: function(err) {
    //         console.log(err);
    //         $('.assessmentParticipants-preloader').hide()
    //     }
    // });