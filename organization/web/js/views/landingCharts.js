
    var ctx = document.getElementById('assessmentParticipantsChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Assess1', 'Assess2', 'Assess3', 'Assess4', 'Assess6', 'Assess7', 'Assess18'],
            datasets: [{
                label: 'عدد المشاركات في الإستبيان',
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

    var ctx = document.getElementById('assessmentChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Q1", "Q2", "Q3", "Q4", "Q5", "Q6", "Q7"],
            datasets: [
                {
                    label: "عدد من أجابوا على السؤال",
                    fillColor: "#be1e2d",
                    strokeColor: "rgba(220,220,220,0.8)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: [28, 48, 40, 19, 46, 27, 50],
                    backgroundColor: [
                        "#f39c12",
                        "#e74c3c",
                        "#3498db",
                        "#d35400",
                        "#f1c40f",
                        "#1abc9c",
                        "#34495e",
                        "#8e44ad",
                    ],
                },
                {
                    label: "عدد الإجابات الصحيحة",
                    fillColor: "#00a79d",
                    strokeColor: "rgba(151,187,205,0.8)",
                    highlightFill: "rgba(151,187,205,0.75)",
                    highlightStroke: "rgba(151,187,205,1)",
                    data: [18, 28, 30, 11, 36, 17, 40],
                    backgroundColor: [
                        "#2ecc71",
                        "#2ecc71",
                        "#2ecc71",
                        "#2ecc71",
                        "#2ecc71",
                        "#2ecc71",
                        "#2ecc71",
                        "#2ecc71",
                    ],
                }
            ]
        },
        options: {
            scaleFontColor: "white"
        }
    }); 