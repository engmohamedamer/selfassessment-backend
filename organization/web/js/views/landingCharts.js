
    

    var ctx = document.getElementById('participantsStatusChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'pie',
      data: {
          datasets: [{
              data: [
                  20,
                  30,
                  50
              ],
              backgroundColor: [
                  "#ecf0f1",
                  "#f39c12",
                  "#2ecc71"
              ],
          }],
          labels: [
              "لم يبدأ",
              "قيد الإستكمال",
              "اكتمل"
          ]
      },
      options: {
          responsive: true
      }
    });

    // var ctx = document.getElementById('assessmentChart').getContext('2d');
    // var chart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: ["Q1", "Q2", "Q3", "Q4", "Q5", "Q6", "Q7"],
    //         datasets: [
    //             {
    //                 label: "عدد من أجابوا على السؤال",
    //                 fillColor: "#be1e2d",
    //                 strokeColor: "rgba(220,220,220,0.8)",
    //                 highlightFill: "rgba(220,220,220,0.75)",
    //                 highlightStroke: "rgba(220,220,220,1)",
    //                 data: [28, 48, 40, 19, 46, 27, 50],
    //                 backgroundColor: [
    //                     "#f39c12",
    //                     "#e74c3c",
    //                     "#3498db",
    //                     "#d35400",
    //                     "#f1c40f",
    //                     "#1abc9c",
    //                     "#34495e",
    //                     "#8e44ad",
    //                 ],
    //             },
    //             {
    //                 label: "عدد الإجابات الصحيحة",
    //                 fillColor: "#00a79d",
    //                 strokeColor: "rgba(151,187,205,0.8)",
    //                 highlightFill: "rgba(151,187,205,0.75)",
    //                 highlightStroke: "rgba(151,187,205,1)",
    //                 data: [18, 28, 30, 11, 36, 17, 40],
    //                 backgroundColor: [
    //                     "#2ecc71",
    //                     "#2ecc71",
    //                     "#2ecc71",
    //                     "#2ecc71",
    //                     "#2ecc71",
    //                     "#2ecc71",
    //                     "#2ecc71",
    //                     "#2ecc71",
    //                 ],
    //             }
    //         ]
    //     },
    //     options: {
    //         scaleFontColor: "white"
    //     }
    // }); 



    var assessmentParticipants;
    $.ajax({
    url: "/site/org-survey",
    type: "GET",
    beforeSend: function () { },
    complete: function () { },
    success: res => {
        console.log(res);
        
        // assessmentParticipants = JSON.parse(res)
        // var line1 = assessmentParticipants.data1.map(Number);
        // var line2 = assessmentParticipants.data2.map(Number);
        // var MONTHS = assessmentParticipants.months;









        var ctx = document.getElementById('assessmentParticipantsChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: res.labels,
                datasets: [{
                    label: 'عدد المشاركات في الإستبيان',
                    data: res.data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        }); 










        // var config = {
        // type: "line",
        // data: {
        //     labels: MONTHS,
        //     datasets: [
        //     {
        //         label: "طلبات المدارس الجديدة",
        //         backgroundColor: window.chartColors.red,
        //         borderColor: window.chartColors.red,
        //         data: line1,
        //         fill: false
        //     },
        //     {
        //         label: "المدارس المضافة",
        //         fill: false,
        //         backgroundColor: window.chartColors.blue,
        //         borderColor: window.chartColors.blue,
        //         data: line2
        //     }
        //     ]
        // },
        // options: {
        //     responsive: true,
        //     title: {
        //     display: true,
        //     text: "طلبات المدارس الجديدة",
        //     fontColor: 'white',
        //     },
        //     tooltips: {
        //     mode: "index",
        //     intersect: false
        //     },
        //     hover: {
        //     mode: "nearest",
        //     intersect: true
        //     },
        //     legend: {
        //     labels: {
        //         // This more specific font property overrides the global property
        //         fontColor: 'white'
        //     }
        //     },
        //     scales: {
        //     xAxes: [
        //         {
        //         display: true,
        //         scaleLabel: {
        //             display: false,
        //             labelString: "Month"
        //         },
        //         ticks: {
        //             beginAtZero: true,
        //             fontColor: 'white'
        //         }
        //         }
        //     ],
        //     yAxes: [
        //         {
        //         display: true,
        //         scaleLabel: {
        //             display: false
        //         },
        //         ticks: {
        //             beginAtZero: true,
        //             fontColor: 'white'
        //         },
        //         }
        //     ]
        //     }
        // }
        // };

        // var ctx = document.getElementById("linechart").getContext("2d");
        // var myLine = new Chart(ctx, config);
    },
    error: function (err) {
        console.log(err);
    }
    });