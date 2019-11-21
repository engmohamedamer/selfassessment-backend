
    // var ctx = document.getElementById('schoolChart').getContext('2d');
    // var chart = new Chart(ctx, {
    //     // The type of chart we want to create
    //     type: 'line',
    
    //     // The data for our dataset
    //     data: {
    //         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    //         datasets: [{
    //             label: 'My First dataset',
    //             backgroundColor: 'rgb(255, 99, 132)',
    //             borderColor: 'rgb(255, 99, 132)',
    //             data: [0, 10, 5, 2, 20, 30, 45]
    //         }]
    //     },
    
    //     // Configuration options go here
    //     options: {}
    // });



    var ctx = document.getElementById('assessmentChart').getContext('2d');
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
                  "#F7464A",
                  "#46BFBD",
                  "#FDB45C"
              ],
          }],
          labels: [
              "Principal Amount",
              "Interest Amount",
              "Processing Fee"
          ]
      },
      options: {
          responsive: true
      }
    });