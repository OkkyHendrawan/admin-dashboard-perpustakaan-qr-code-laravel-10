
// function rgbToHex(rgb) {
//     // Extract RGB values using regular expressions
//     const rgbValues = rgb.match(/\d+/g);

//     if (rgbValues.length === 3) {
//         var [r, g, b] = rgbValues.map(Number);
//     }
//     // Ensure the values are within the valid range (0-255)
//     r = Math.max(0, Math.min(255, r));
//     g = Math.max(0, Math.min(255, g));
//     b = Math.max(0, Math.min(255, b));

//     // Convert each component to its hexadecimal representation
//     const rHex = r.toString(16).padStart(2, '0');
//     const gHex = g.toString(16).padStart(2, '0');
//     const bHex = b.toString(16).padStart(2, '0');

//     // Combine the hexadecimal values with the "#" prefix
//     const hexColor = `#${rHex}${gHex}${bHex}`;

//     return hexColor.toUpperCase(); // Convert to uppercase for consistency
// }

// // common function to get charts colors from class
// function getChartColorsArray(chartId) {
//     const chartElement = document.getElementById(chartId);
//     if (chartElement) {
//         const colors = chartElement.dataset.chartColors;
//         if (colors) {
//             const parsedColors = JSON.parse(colors);
//             const mappedColors = parsedColors.map((value) => {
//                 const newValue = value.replace(/\s/g, "");
//                 if (!newValue.includes("#")) {
//                     const element = document.querySelector(newValue);
//                     if (element) {
//                         const styles = window.getComputedStyle(element);
//                         const backgroundColor = styles.backgroundColor;
//                         return backgroundColor || newValue;
//                     } else {
//                         const divElement = document.createElement('div');
//                         divElement.className = newValue;
//                         document.body.appendChild(divElement);

//                         const styles = window.getComputedStyle(divElement);
//                         const backgroundColor = styles.backgroundColor.includes("#") ? styles.backgroundColor : rgbToHex(styles.backgroundColor);
//                         return backgroundColor || newValue;
//                     }
//                 } else {
//                     return newValue;
//                 }
//             });
//             return mappedColors;
//         } else {
//             console.warn(`chart-colors attribute not found on: ${chartId}`);
//         }
//     }
// }

// //Line Column
// var options = {
//     series: [{
//         name: 'Buku',
//         type: 'column',
//         data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
//     }, {
//         name: 'Peminjaman',
//         type: 'line',
//         data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
//     }],
//     chart: {
//         height: 350,
//         type: 'line',
//     },
//     stroke: {
//         width: [0, 4]
//     },
//     colors: getChartColorsArray("lineColumnChart"),
//     dataLabels: {
//         enabled: true,
//         enabledOnSeries: [1]
//     },
//     labels: ['01 Jan 2001', '02 Jan 2001', '03 Jan 2001', '04 Jan 2001', '05 Jan 2001', '06 Jan 2001', '07 Jan 2001', '08 Jan 2001', '09 Jan 2001', '10 Jan 2001', '11 Jan 2001', '12 Jan 2001'],
//     xaxis: {
//         type: 'datetime'
//     },
//     yaxis: [{
//         title: {
//             text: 'Website Blog',
//         },

//     }, {
//         opposite: true,
//         title: {
//             text: 'Social Media'
//         }
//     }]
// };

// var chart = new ApexCharts(document.querySelector("#lineColumnChart"), options);
// chart.render();

// //Multiple Y-Axis
// var options = {
//     series: [{
//         name: 'Income',
//         type: 'column',
//         data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
//     }, {
//         name: 'Cashflow',
//         type: 'column',
//         data: [1.1, 3, 3.1, 4, 4.1, 4.9, 6.5, 8.5]
//     }, {
//         name: 'Revenue',
//         type: 'line',
//         data: [20, 29, 37, 36, 44, 45, 50, 58]
//     }],
//     chart: {
//         height: 350,
//         type: 'line',
//         stacked: false
//     },
//     dataLabels: {
//         enabled: false
//     },
//     stroke: {
//         width: [1, 1, 4]
//     },
//     xaxis: {
//         categories: [2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016],
//     },
//     colors: getChartColorsArray("multipleYaxisChart"),
//     yaxis: [
//         {
//             axisTicks: {
//                 show: true,
//             },
//             axisBorder: {
//                 show: true,
//                 color: getChartColorsArray("multipleYaxisChart")[0]
//             },
//             title: {
//                 text: "Income (thousand crores)",
//             },
//             tooltip: {
//                 enabled: true
//             }
//         },
//         {
//             seriesName: 'Income',
//             opposite: true,
//             axisTicks: {
//                 show: true,
//             },
//             axisBorder: {
//                 show: true,
//                 color: getChartColorsArray("multipleYaxisChart")[1]
//             },
//             title: {
//                 text: "Operating Cashflow (thousand crores)",
//             },
//         },
//         {
//             seriesName: 'Revenue',
//             opposite: true,
//             axisTicks: {
//                 show: true,
//             },
//             axisBorder: {
//                 show: true,
//                 color: getChartColorsArray("multipleYaxisChart")[2]
//             },
//             title: {
//                 text: "Revenue (thousand crores)",
//             }
//         },
//     ],
//     tooltip: {
//         fixed: {
//             enabled: true,
//             position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
//             offsetY: 30,
//             offsetX: 60
//         },
//     },
//     legend: {
//         horizontalAlign: 'left',
//         offsetX: 40
//     }
// };

// var chart = new ApexCharts(document.querySelector("#multipleYaxisChart"), options);
// chart.render();

// function rgbToHex(rgb) {
//     // Extract RGB values using regular expressions
//     const rgbValues = rgb.match(/\d+/g);

//     if (rgbValues.length === 3) {
//         var [r, g, b] = rgbValues.map(Number);
//     }
//     // Ensure the values are within the valid range (0-255)
//     r = Math.max(0, Math.min(255, r));
//     g = Math.max(0, Math.min(255, g));
//     b = Math.max(0, Math.min(255, b));

//     // Convert each component to its hexadecimal representation
//     const rHex = r.toString(16).padStart(2, '0');
//     const gHex = g.toString(16).padStart(2, '0');
//     const bHex = b.toString(16).padStart(2, '0');

//     // Combine the hexadecimal values with the "#" prefix
//     const hexColor = `#${rHex}${gHex}${bHex}`;

//     return hexColor.toUpperCase(); // Convert to uppercase for consistency
// }

// // common function to get charts colors from class
// function getChartColorsArray(chartId) {
//     const chartElement = document.getElementById(chartId);
//     if (chartElement) {
//         const colors = chartElement.dataset.chartColors;
//         if (colors) {
//             const parsedColors = JSON.parse(colors);
//             const mappedColors = parsedColors.map((value) => {
//                 const newValue = value.replace(/\s/g, "");
//                 if (!newValue.includes("#")) {
//                     const element = document.querySelector(newValue);
//                     if (element) {
//                         const styles = window.getComputedStyle(element);
//                         const backgroundColor = styles.backgroundColor;
//                         return backgroundColor || newValue;
//                     } else {
//                         const divElement = document.createElement('div');
//                         divElement.className = newValue;
//                         document.body.appendChild(divElement);

//                         const styles = window.getComputedStyle(divElement);
//                         const backgroundColor = styles.backgroundColor.includes("#") ? styles.backgroundColor : rgbToHex(styles.backgroundColor);
//                         return backgroundColor || newValue;
//                     }
//                 } else {
//                     return newValue;
//                 }
//             });
//             return mappedColors;
//         } else {
//             console.warn(`chart-colors attribute not found on: ${chartId}`);
//         }
//     }
// }

// //basic polar
// var options = {
//     series: [14, 23, 21, 17, 15, 10, 12, 17, 21],
//     chart: {
//         height: 350,
//         type: 'polarArea',
//     },
//     stroke: {
//         colors: ['#fff']
//     },
//     colors: getChartColorsArray("basicPolar"),
//     fill: {
//         opacity: 0.8
//     },
//     legend: {
//         position: 'bottom'
//     }
// };

// var chart = new ApexCharts(document.querySelector("#basicPolar"), options);
// chart.render();

// //basic column chart
// var options = {
//     series: [{
//         name: 'Net Profit',
//         data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
//     }, {
//         name: 'Revenue',
//         data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
//     }, {
//         name: 'Free Cash Flow',
//         data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
//     }],
//     chart: {
//         type: 'bar',
//         height: 350
//     },
//     plotOptions: {
//         bar: {
//             horizontal: false,
//             columnWidth: '55%',
//             endingShape: 'rounded'
//         },
//     },
//     dataLabels: {
//         enabled: false
//     },
//     colors: getChartColorsArray("basicColumnChart"),
//     stroke: {
//         show: true,
//         width: 2,
//         colors: ['transparent']
//     },
//     xaxis: {
//         categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
//     },
//     yaxis: {
//         title: {
//             text: '$ (thousands)'
//         }
//     },
//     fill: {
//         opacity: 1
//     },
//     tooltip: {
//         y: {
//             formatter: function (val) {
//                 return "$ " + val + " thousands"
//             }
//         }
//     }
// };

// var chart = new ApexCharts(document.querySelector("#basicColumnChart"), options);
// chart.render();
