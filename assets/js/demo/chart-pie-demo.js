// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
if (ctx) {
  var pieLabels = (typeof window.chartData !== 'undefined' && window.chartData.pieLabels) ? window.chartData.pieLabels : ["Direct", "Referral", "Social"];
  var pieData = (typeof window.chartData !== 'undefined' && window.chartData.pieData) ? window.chartData.pieData : [55, 30, 15];
  var bgColors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69'];
  var hoverColors = ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617', '#60616f', '#373840'];

  var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: pieLabels,
    datasets: [{
      data: pieData,
      backgroundColor: bgColors,
      hoverBackgroundColor: hoverColors,
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.labels[tooltipItem.index] || '';
          var val = chart.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
          if (typeof number_format === 'function') {
              val = 'Rp. ' + number_format(val);
          } else {
              val = 'Rp. ' + val;
          }
          return datasetLabel + ': ' + val;
        }
      }
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

  var legendHtml = '';
  pieLabels.forEach(function(label, i) {
      var color = bgColors[i % bgColors.length];
      legendHtml += '<span class="mr-2"><i class="fas fa-circle" style="color:' + color + '"></i> ' + label + '</span>';
  });
  var legendContainer = document.getElementById("pieChartLegend");
  if (legendContainer) {
      legendContainer.innerHTML = legendHtml;
  }
}
