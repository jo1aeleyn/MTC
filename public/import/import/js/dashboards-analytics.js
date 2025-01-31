/**
 * Dashboard Analytics
 */

'use strict';

(function () {
  let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.white;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;


// ResidentCountUpdate - Bar Chart
// --------------------------------------------------------------------
// const singleDataChartEl = document.querySelector('#ResidentCountUpdate');
// const singleDataChartOptions = {
//   series: [
//     {
//       name: 'Residents',
//       data: [] // Initialize with empty data
//     }
//   ],
//   chart: {
//     height: 300,
//     type: 'bar',
//     toolbar: { show: false },
//     animations: {
//       enabled: true,
//       easing: 'easeinout',
//       speed: 800
//     }
//   },
//   plotOptions: {
//     bar: {
//       horizontal: false,
//       columnWidth: '50%',
//       borderRadius: 12,
//       endingShape: 'rounded',
//       dataLabels: {
//         position: 'top'
//       }
//     }
//   },
//   colors: ['#00E396'],
//   dataLabels: {
//     enabled: true,
//     formatter: (value) => value,
//     offsetY: -20,
//     style: {
//       fontSize: '12px',
//       colors: ['#fff']
//     }
//   },
//   stroke: {
//     show: true,
//     width: 2,
//     colors: ['#fff']
//   },
//   tooltip: {
//     enabled: true,
//     theme: 'dark',
//     style: {
//       fontSize: '12px',
//       color: '#fff'
//     },
//     y: {
//       formatter: (value) => `${value} Residents`
//     }
//   },
//   legend: {
//     show: true,
//     position: 'top',
//     labels: {
//       colors: '#333'
//     }
//   },
//   grid: {
//     borderColor: '#ddd',
//     strokeDashArray: 4,
//     padding: {
//       top: 0,
//       bottom: -8,
//       left: 20,
//       right: 20
//     }
//   },
//   xaxis: {
//     categories: [],
//     labels: {
//       style: {
//         fontSize: '13px',
//         colors: '#566a7f' // Updated color for x-axis labels
//       }
//     },
//     axisTicks: {
//       show: false
//     },
//     axisBorder: {
//       show: false
//     }
//   },
//   yaxis: {
//     labels: {
//       style: {
//         fontSize: '13px',
//         colors: '#333'
//       }
//     }
//   }
// };

// if (singleDataChartEl) {
//   const singleDataChart = new ApexCharts(singleDataChartEl, singleDataChartOptions);
//   singleDataChart.render();

//   // Function to update chart data dynamically
//   function updateChartData(newData, categories) {
//     singleDataChart.updateOptions({
//       series: [{
//         name: 'Residents',
//         data: newData
//       }],
//       xaxis: {
//         categories: categories
//       }
//     });
//   }

//   const newData = [12, 15, 10, 8, 16];
//   const categories = ['Jan 2024', 'Feb 2024', 'Mar 2024', 'Apr 2024', 'May 2024'];

//   // Call this function whenever you need to update the chart
//   updateChartData(newData, categories);
// }

  // Growth Chart - Radial Bar Chart
  // --------------------------------------------------------------------
  const growthChartEl = document.querySelector('#growthChart'),
    growthChartOptions = {
      series: [78],
      labels: ['Growth'],
      chart: {
        height: 240,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          size: 150,
          offsetY: 10,
          startAngle: -150,
          endAngle: 150,
          hollow: {
            size: '55%'
          },
          track: {
            background: cardColor,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: 15,
              color: headingColor,
              fontSize: '15px',
              fontWeight: '600',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: -25,
              color: headingColor,
              fontSize: '22px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 5
      },
      grid: {
        padding: {
          top: -35,
          bottom: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof growthChartEl !== undefined && growthChartEl !== null) {
    const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
    growthChart.render();
  }

  // Average Feedbacks Line Chart
  // --------------------------------------------------------------------
  // const feedbackReportChartEl = document.querySelector('#averageFeedbackChart'),
  //   feedbackReportChartConfig = {
  //     chart: {
  //       height: 80,
  //       // width: 175,
  //       type: 'line',
  //       toolbar: {
  //         show: false
  //       },
  //       dropShadow: {
  //         enabled: true,
  //         top: 10,
  //         left: 5,
  //         blur: 3,
  //         color: config.colors.primary,
  //         opacity: 0.15
  //       },
  //       sparkline: {
  //         enabled: true
  //       }
  //     },
  //     grid: {
  //       show: false,
  //       padding: {
  //         right: 8
  //       }
  //     },
  //     colors: [config.colors.primary],
  //     dataLabels: {
  //       enabled: false
  //     },
  //     stroke: {
  //       width: 5,
  //       curve: 'smooth'
  //     },
  //     series: [
  //       {
  //         name: 'Average Feedback',
  //         data: [3.5, 4.2, 3.8, 4.5, 4.0, 4.3]
  //       }
  //     ],
  //     xaxis: {
  //       show: true,
  //       lines: {
  //         show: false
  //       },
  //       labels: {
  //         show: true,
  //         style: {
  //           colors: '#566a7f'
  //         }
  //       },
  //       axisBorder: {
  //         show: false
  //       },
  //       categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
  //     },
  //     yaxis: {
  //       title: {
  //         text: 'Average Score',
  //         style: {
  //           color: '#566a7f'
  //         }
  //       },
  //       labels: {
  //         style: {
  //           colors: '#566a7f'
  //         }
  //       }
  //     },
  //     title: {
  //       text: ' ',
  //       align: 'left',
  //       style: {
  //         fontSize: '14px',
  //         fontWeight: 'bold',
  //         color: '#566a7f'
  //       }
  //     }
  //   };

  // if (feedbackReportChartEl) {
  //   const feedbackReportChart = new ApexCharts(feedbackReportChartEl, feedbackReportChartConfig);
  //   feedbackReportChart.render();
  // }


  // Age Statistics Chart
  // --------------------------------------------------------------------



  // Income Chart - Area chart
  // --------------------------------------------------------------------
  // const incomeChartEl = document.querySelector('#requestsChart'),
  //   incomeChartConfig = {
  //     series: [
  //       {
  //         data: [24, 21, 30, 22, 42, 26, 35, 29]
  //       }
  //     ],
  //     chart: {
  //       height: 215,
  //       parentHeightOffset: 0,
  //       parentWidthOffset: 0,
  //       toolbar: {
  //         show: false
  //       },
  //       type: 'area'
  //     },
  //     dataLabels: {
  //       enabled: false
  //     },
  //     stroke: {
  //       width: 2,
  //       curve: 'smooth'
  //     },
  //     legend: {
  //       show: false
  //     },
  //     markers: {
  //       size: 6,
  //       colors: 'transparent',
  //       strokeColors: 'transparent',
  //       strokeWidth: 4,
  //       discrete: [
  //         {
  //           fillColor: config.colors.white,
  //           seriesIndex: 0,
  //           dataPointIndex: 7,
  //           strokeColor: config.colors.primary,
  //           strokeWidth: 2,
  //           size: 6,
  //           radius: 8
  //         }
  //       ],
  //       hover: {
  //         size: 7
  //       }
  //     },
  //     colors: [config.colors.primary],
  //     fill: {
  //       type: 'gradient',
  //       gradient: {
  //         shade: shadeColor,
  //         shadeIntensity: 0.6,
  //         opacityFrom: 0.5,
  //         opacityTo: 0.25,
  //         stops: [0, 95, 100]
  //       }
  //     },
  //     grid: {
  //       borderColor: borderColor,
  //       strokeDashArray: 3,
  //       padding: {
  //         top: -20,
  //         bottom: -8,
  //         left: -10,
  //         right: 8
  //       }
  //     },
  //     xaxis: {
  //       categories: ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
  //       axisBorder: {
  //         show: false
  //       },
  //       axisTicks: {
  //         show: false
  //       },
  //       labels: {
  //         show: true,
  //         style: {
  //           fontSize: '13px',
  //           colors: axisColor
  //         }
  //       }
  //     },
  //     yaxis: {
  //       labels: {
  //         show: false
  //       },
  //       min: 10,
  //       max: 50,
  //       tickAmount: 4
  //     }
  //   };
  // if (typeof incomeChartEl !== undefined && incomeChartEl !== null) {
  //   const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
  //   incomeChart.render();
  // }



  // Expenses Mini Chart - Radial Chart
  // --------------------------------------------------------------------
  const weeklyExpensesEl = document.querySelector('#requestsOfWeek'),
    weeklyExpensesConfig = {
      series: [65],
      chart: {
        width: 60,
        height: 60,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          startAngle: 0,
          endAngle: 360,
          strokeWidth: '8',
          hollow: {
            margin: 2,
            size: '45%'
          },
          track: {
            strokeWidth: '50%',
            background: borderColor
          },
          dataLabels: {
            show: true,
            name: {
              show: false
            },
            value: {
              formatter: function (val) {
                return '$' + parseInt(val);
              },
              offsetY: 5,
              color: '#697a8d',
              fontSize: '13px',
              show: true
            }
          }
        }
      },
      fill: {
        type: 'solid',
        colors: config.colors.primary
      },
      stroke: {
        lineCap: 'round'
      },
      grid: {
        padding: {
          top: -10,
          bottom: -15,
          left: -10,
          right: -10
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof weeklyExpensesEl !== undefined && weeklyExpensesEl !== null) {
    const weeklyExpenses = new ApexCharts(weeklyExpensesEl, weeklyExpensesConfig);
    weeklyExpenses.render();
  }
})();