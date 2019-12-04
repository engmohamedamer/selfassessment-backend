    $.ajax({
    url: "/site/org-survey-stats",
    type: "GET",
    beforeSend: function () { $('.participantsStatus-preloader').show()},
    complete: function () { },
    success: res => {
        var ctx = document.getElementById('participantsStatusChart').getContext('2d');
        var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: res.data,
                backgroundColor: [
                    "#2ecc71",
                    "#f39c12",
                    "#22CECE"
                ],
            }],
            labels: res.labels
        },
        options: {
            responsive: true,
            legend: {
                display: false
            },
            // tooltips: {
            //     callbacks: {
            //       label: function(tooltipItem) {
            //         console.log(tooltipItem)
            //             return tooltipItem.yLabel;
            //         }
            //   }
            // }
        }
        });
        $('.participantsStatus-preloader').hide()
    },
    error: function (err) {
        console.log(err);
        $('.participantsStatus-preloader').hide()
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


var primcolor= $("body").attr("data-Primcolor")

    $.ajax({
    url: "/site/org-survey",
    type: "GET",
    beforeSend: function () { $('.assessmentParticipants-preloader').show()},
    complete: function () { },
    success: res => {
        $('.assessmentParticipants-preloader').hide()
        var ctx = document.getElementById('assessmentParticipantsChart').getContext('2d');
        var chart = new Chart(ctx, {


            
            type: 'line',
            data: {
                labels: res.labels,
                datasets: [{
                    label: 'عدد المشاركين في الإستبيان',
                    data: res.data,
                    backgroundColor     : 'transparent',
                    borderColor         : primcolor,
                    pointBorderColor    : primcolor,
                    pointBackgroundColor: primcolor,
                    // backgroundColor: [
                    //     'rgba(255, 99, 132, 0.2)',

                    //     // '#16a085',
                    //     // '#e67e22',
                    //     // '#2c3e50',
                    //     // '#2980b9',
                    //     // '#c0392b',
                    //     // '#27ae60',
                    //     // '#f39c12'
                    // ],
                    // borderColor: [
                    //     'rgba(255, 99, 132, 1)',
                    //     'rgba(54, 162, 235, 1)',
                    //     'rgba(255, 206, 86, 1)',
                    //     'rgba(75, 192, 192, 1)',
                    //     'rgba(153, 102, 255, 1)',
                    //     'rgba(153, 102, 255, 1)',
                    //     'rgba(255, 159, 64, 1)'
                    // ],
                   // borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                
                tooltips: {
                mode: "index",
                intersect: false
                },
                hover: {
                mode: "nearest",
                intersect: true
                },
                legend: {
                labels: {
                    // This more specific font property overrides the global property
                    // fontColor: '#ccc'
                }
                },
                scales: {
                    xAxes: [
                        {
                        display: true,
                        scaleLabel: {
                            display: false,
                        },
                        ticks: {
                            beginAtZero: true,
                            //fontColor: '#ccc'
                        }
                        }
                    ],
                    yAxes: [
                        {
                        display: true,
                        scaleLabel: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true,
                            //fontColor: '#ccc'
                        },
                        }
                    ]
                },
            }
        }); 
        
    },
    error: function (err) {
        console.log(err);
        $('.assessmentParticipants-preloader').hide()
    }
    });


//////////////////////////////
// Avatar images
///////////////
/*
     * LetterAvatar
     * 
     * Artur Heinze
     * Create Letter avatar based on Initials
     * based on https://gist.github.com/leecrossley/6027780
     */
    (function(w, d) {
        function LetterAvatar(name, size) {
          name = name || "";
          size = size || 60;
      
          var colours = [
              "#1abc9c",
              "#2ecc71",
              "#3498db",
              "#9b59b6",
              "#34495e",
              "#16a085",
              "#27ae60",
              "#2980b9",
              "#8e44ad",
              "#2c3e50",
              "#f1c40f",
              "#e67e22",
              "#e74c3c",
              "#ecf0f1",
              "#95a5a6",
              "#f39c12",
              "#d35400",
              "#c0392b",
              "#bdc3c7",
              "#7f8c8d"
            ],
            nameSplit = String(name)
              .toUpperCase()
              .split(" "),
            initials,
            charIndex,
            colourIndex,
            canvas,
            context,
            dataURI;
      
          if (nameSplit.length == 1) {
            initials = nameSplit[0] ? nameSplit[0].charAt(0) : "?";
          } else {
            initials = nameSplit[0].charAt(0) + nameSplit[1].charAt(0);
          }
      
          if (w.devicePixelRatio) {
            size = size * w.devicePixelRatio;
          }
      
          charIndex = (initials == "?" ? 72 : initials.charCodeAt(0)) - 64;
          colourIndex = charIndex % 20;
          canvas = d.createElement("canvas");
          canvas.width = size;
          canvas.height = size;
          context = canvas.getContext("2d");
      
          context.fillStyle = colours[colourIndex - 1];
          context.fillRect(0, 0, canvas.width, canvas.height);
          context.font = Math.round(canvas.width / 2) + "px Arial";
          context.textAlign = "center";
          context.fillStyle = "#FFF";
          context.fillText(initials, size / 2, size / 1.5);
      
          dataURI = canvas.toDataURL();
          canvas = null;
      
          return dataURI;
        }
      
        LetterAvatar.transform = function() {
          Array.prototype.forEach.call(d.querySelectorAll("img[avatar]"), function(
            img,
            name
          ) {
            name = img.getAttribute("avatar");
            img.src = LetterAvatar(name, img.getAttribute("width"));
            img.removeAttribute("avatar");
            img.setAttribute("alt", name);
          });
        };
      
        // AMD support
        if (typeof define === "function" && define.amd) {
          define(function() {
            return LetterAvatar;
          });
      
          // CommonJS and Node.js module support.
        } else if (typeof exports !== "undefined") {
          // Support Node.js specific `module.exports` (which can be a function)
          if (typeof module != "undefined" && module.exports) {
            exports = module.exports = LetterAvatar;
          }
      
          // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
          exports.LetterAvatar = LetterAvatar;
        } else {
          window.LetterAvatar = LetterAvatar;
      
          d.addEventListener("DOMContentLoaded", function(event) {
            LetterAvatar.transform();
          });
        }
      })(window, document);
      