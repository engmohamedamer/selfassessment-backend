
    var ctx = document.getElementById('assessmentParticipantsChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Assess1', 'Assess2', 'Assess3', 'Assess4', 'Assess6', 'Assess7', 'Assess18'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3, 10],
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



    var ctx = document.getElementById('participantsStatusChart').getContext('2d');
    var chart = new Chart(ctx, {
      type: 'pie',
      data: {
          datasets: [{
              data: [
                  40,
                  10,
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




    var ctx = document.getElementById('assessmentChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "My First dataset",
                    // fillColor: "#be1e2d",
                    // strokeColor: "rgba(220,220,220,0.8)",
                    // highlightFill: "rgba(220,220,220,0.75)",
                    // highlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55, 40],
                    backgroundColor: [
                        '#b3b3b3',
                        '#b3b3b3',
                        '#b3b3b3',
                        '#b3b3b3',
                        '#b3b3b3',
                        '#b3b3b3',
                        '#b3b3b3',
                        '#b3b3b3',
                        '#b3b3b3',
                        '#b3b3b3',
                    //     'rgba(54, 162, 235, 0.2)',
                    //     'rgba(255, 206, 86, 0.2)',
                    //     'rgba(75, 192, 192, 0.2)',
                    //     'rgba(153, 102, 255, 0.2)',
                    //     'rgba(153, 102, 255, 0.2)',
                    //     'rgba(255, 159, 64, 0.2)'
                    ],
                },
                {
                    label: "My Second dataset",
                    fillColor: "#00a79d",
                    strokeColor: "rgba(151,187,205,0.8)",
                    highlightFill: "rgba(151,187,205,0.75)",
                    highlightStroke: "rgba(151,187,205,1)",
                    data: [28, 48, 40, 19, 86, 27, 90],
                    backgroundColor: [
                        "green",
                        "green",
                        "green",
                        "green",
                        "green",
                        "green",
                        "green",
                        "green",
                    ],
                }
            ]
        },
        options: {
            scaleFontColor: "white"
        }
    }); 