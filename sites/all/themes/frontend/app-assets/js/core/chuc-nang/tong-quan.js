// $(document).ready(function (){
//   var $statisticsOrderChart = document.querySelector('#statistics-order-chart');
//   var statisticsOrderChartOptions;
//   var $barColor = '#f3f3f3';
//   var $statisticsProfitChart = document.querySelector('#statistics-profit-chart');
//   var statisticsProfitChartOptions;
//   var $trackBgColor = '#EBEBEB';
//   var $earningsChart = document.querySelector('#earnings-chart');
//   var earningsChartOptions;
//   var $earningsStrokeColor2 = '#28c76f66';
//   var $earningsStrokeColor3 = '#28c76f33';
//   var earningsChart;
//
//   //
//   earningsChartOptions = {
//     chart: {
//       type: 'donut',
//       height: 120,
//       toolbar: {
//         show: false
//       }
//     },
//     dataLabels: {
//       enabled: false
//     },
//     series: [parseInt($('#earnings-chart').attr("data-het-han")),parseInt($('#earnings-chart').attr("data-gia-han"))],
//     legend: { show: false },
//     comparedResult: [parseInt($('#earnings-chart').attr("data-het-han")),parseInt($('#earnings-chart').attr("data-gia-han"))],
//     labels: ['Hết hạn', 'Gia hạn'],
//     stroke: { width: 0 },
//     colors: [$earningsStrokeColor2, window.colors.solid.success],
//     grid: {
//       padding: {
//         right: -20,
//         bottom: -8,
//         left: -20
//       }
//     },
//     plotOptions: {
//       pie: {
//         startAngle: -10,
//         donut: {
//           labels: {
//             show: true,
//             name: {
//               offsetY: 15
//             },
//             value: {
//               offsetY: -15,
//               formatter: function (val) {
//                 return parseInt(val) + '%';
//               }
//             },
//             total: {
//               show: true,
//               offsetY: 15,
//               label: 'Gia hạn',
//               formatter: function (w) {
//                 return $('#earnings-chart').attr("data-gia-han")+'%';
//               }
//             }
//           }
//         }
//       }
//     },
//     responsive: [
//       {
//         breakpoint: 1325,
//         options: {
//           chart: {
//             height: 100
//           }
//         }
//       },
//       {
//         breakpoint: 1200,
//         options: {
//           chart: {
//             height: 120
//           }
//         }
//       },
//       {
//         breakpoint: 1045,
//         options: {
//           chart: {
//             height: 100
//           }
//         }
//       },
//       {
//         breakpoint: 992,
//         options: {
//           chart: {
//             height: 120
//           }
//         }
//       }
//     ]
//   };
//   earningsChart = new ApexCharts($earningsChart, earningsChartOptions);
//   earningsChart.render();
//   //
//   statisticsOrderChartOptions = {
//     chart: {
//       height: 70,
//       type: 'bar',
//       stacked: true,
//       toolbar: {
//         show: false
//       }
//     },
//     grid: {
//       show: false,
//       padding: {
//         left: 0,
//         right: 0,
//         top: -15,
//         bottom: -15
//       }
//     },
//     plotOptions: {
//       bar: {
//         horizontal: false,
//         columnWidth: '20%',
//         startingShape: 'rounded',
//         colors: {
//           backgroundBarColors: [$barColor, $barColor, $barColor, $barColor, $barColor],
//           backgroundBarRadius: 5
//         }
//       }
//     },
//     legend: {
//       show: false
//     },
//     dataLabels: {
//       enabled: false
//     },
//     colors: [window.colors.solid.warning],
//     series: [
//       {
//         name: '2020',
//         data: [45, 85, 65, 45, 65]
//       }
//     ],
//     xaxis: {
//       labels: {
//         show: false
//       },
//       axisBorder: {
//         show: false
//       },
//       axisTicks: {
//         show: false
//       }
//     },
//     yaxis: {
//       show: false
//     },
//     tooltip: {
//       x: {
//         show: false
//       }
//     }
//   };
//   statisticsOrderChart = new ApexCharts($statisticsOrderChart, statisticsOrderChartOptions);
//   statisticsOrderChart.render();
//   //
//   statisticsProfitChartOptions = {
//     chart: {
//       height: 70,
//       type: 'line',
//       toolbar: {
//         show: false
//       },
//       zoom: {
//         enabled: false
//       }
//     },
//     grid: {
//       borderColor: $trackBgColor,
//       strokeDashArray: 5,
//       xaxis: {
//         lines: {
//           show: true
//         }
//       },
//       yaxis: {
//         lines: {
//           show: false
//         }
//       },
//       padding: {
//         top: -30,
//         bottom: -10
//       }
//     },
//     stroke: {
//       width: 3
//     },
//     colors: [window.colors.solid.info],
//     series: [
//       {
//         data: [0, 20, 5, 30, 15, 45]
//       }
//     ],
//     markers: {
//       size: 2,
//       colors: window.colors.solid.info,
//       strokeColors: window.colors.solid.info,
//       strokeWidth: 2,
//       strokeOpacity: 1,
//       strokeDashArray: 0,
//       fillOpacity: 1,
//       discrete: [
//         {
//           seriesIndex: 0,
//           dataPointIndex: 5,
//           fillColor: '#ffffff',
//           strokeColor: window.colors.solid.info,
//           size: 5
//         }
//       ],
//       shape: 'circle',
//       radius: 2,
//       hover: {
//         size: 3
//       }
//     },
//     xaxis: {
//       labels: {
//         show: true,
//         style: {
//           fontSize: '0px'
//         }
//       },
//       axisBorder: {
//         show: false
//       },
//       axisTicks: {
//         show: false
//       }
//     },
//     yaxis: {
//       show: false
//     },
//     tooltip: {
//       x: {
//         show: false
//       }
//     }
//   };
//   statisticsProfitChart = new ApexCharts($statisticsProfitChart, statisticsProfitChartOptions);
//   statisticsProfitChart.render();
//   $(".brand-text").html('TỔNG QUAN')
//   // loadData("/get-thong-ke-hop-dong-by-year",{token:$("#tokenbody").val()},function (){
//   //   blockPage()
//   // },function (data){
//   //   var $textMutedColor = '#b9b9c3';
//   //   var revenueReportChartOptions;
//   //   var $revenueReportChart = document.querySelector('#revenue-report-chart');
//   //   revenueReportChartOptions = {
//   //     chart: {
//   //       height: 230,
//   //       stacked: true,
//   //       type: 'bar',
//   //       toolbar: { show: false }
//   //     },
//   //     plotOptions: {
//   //       bar: {
//   //         columnWidth: '17%',
//   //         endingShape: 'rounded'
//   //       },
//   //       distributed: true
//   //     },
//   //     colors: [window.colors.solid.primary, window.colors.solid.warning],
//   //     series: [
//   //       {
//   //         name: 'Earning',
//   //         data: data.tongThu
//   //       },
//   //       {
//   //         name: 'Expense',
//   //         data: data.tongChi
//   //       }
//   //     ],
//   //     dataLabels: {
//   //       enabled: false
//   //     },
//   //     legend: {
//   //       show: false
//   //     },
//   //     grid: {
//   //       padding: {
//   //         top: -20,
//   //         bottom: -10
//   //       },
//   //       yaxis: {
//   //         lines: { show: false }
//   //       }
//   //     },
//   //     xaxis: {
//   //       categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep','Oct','Nov','Dec'],
//   //       labels: {
//   //         style: {
//   //           colors: $textMutedColor,
//   //           fontSize: '0.86rem'
//   //         }
//   //       },
//   //       axisTicks: {
//   //         show: false
//   //       },
//   //       axisBorder: {
//   //         show: false
//   //       }
//   //     },
//   //     yaxis: {
//   //       labels: {
//   //         style: {
//   //           colors: $textMutedColor,
//   //           fontSize: '0.86rem'
//   //         }
//   //       }
//   //     }
//   //   };
//   //   revenueReportChart = new ApexCharts($revenueReportChart, revenueReportChartOptions);
//   //   revenueReportChart.render();
//   // })
// })

