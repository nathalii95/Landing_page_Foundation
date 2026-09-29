(function ($) {
  'use strict';
  
  // 1. Gráfico de barras (Visit Sale Chart)
  if ($("#visit-sale-chart").length) {
    const ctx = document.getElementById('visit-sale-chart');

    var graphGradient1 = document.getElementById('visit-sale-chart').getContext("2d");
    var graphGradient2 = document.getElementById('visit-sale-chart').getContext("2d");
    var graphGradient3 = document.getElementById('visit-sale-chart').getContext("2d");

    var gradientStrokeViolet = graphGradient1.createLinearGradient(0, 0, 0, 181);
    gradientStrokeViolet.addColorStop(0, 'rgba(218, 140, 255, 1)');
    gradientStrokeViolet.addColorStop(1, 'rgba(154, 85, 255, 1)');

    var gradientStrokeBlue = graphGradient2.createLinearGradient(0, 0, 0, 360);
    gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
    gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');

    var gradientStrokeRed = graphGradient3.createLinearGradient(0, 0, 0, 300);
    gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
    gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');

    const bgColor1 = ["rgba(218, 140, 255, 1)"];
    const bgColor2 = ["rgba(54, 215, 232, 1)"];
    const bgColor3 = ["rgba(255, 191, 150, 1)"];

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG'],
        datasets: [{
          label: "CHN",
          borderColor: gradientStrokeViolet,
          backgroundColor: gradientStrokeViolet,
          fillColor: bgColor1,
          hoverBackgroundColor: gradientStrokeViolet,
          pointRadius: 0,
          borderWidth: 1,
          fill: 'origin',
          data: [20, 40, 15, 35, 25, 50, 30, 20],
          barPercentage: 0.5,
          categoryPercentage: 0.5,
        },
        {
          label: "USA",
          borderColor: gradientStrokeRed,
          backgroundColor: gradientStrokeRed,
          hoverBackgroundColor: gradientStrokeRed,
          fillColor: bgColor2,
          pointRadius: 0,
          borderWidth: 1,
          fill: 'origin',
          data: [40, 30, 20, 10, 50, 15, 35, 40],
          barPercentage: 0.5,
          categoryPercentage: 0.5,
        },
        {
          label: "UK",
          borderColor: gradientStrokeBlue,
          backgroundColor: gradientStrokeBlue,
          hoverBackgroundColor: gradientStrokeBlue,
          fillColor: bgColor3,
          pointRadius: 0,
          borderWidth: 1,
          fill: 'origin',
          data: [70, 10, 30, 40, 25, 50, 15, 30],
          barPercentage: 0.5,
          categoryPercentage: 0.5,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        elements: {
          line: {
            tension: 0.4,
          },
        },
        scales: {
          y: {
            display: false,
            grid: {
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
            },
          },
          x: {
            display: true,
            grid: {
              display: false,
            },
          }
        },
        plugins: {
          legend: {
            display: false,
          }
        }
      },
      plugins: [{
        afterDatasetUpdate: function (chart, args, options) {
          const chartId = chart.canvas.id;
          const legendId = `${chartId}-legend`;
          const legendContainer = document.getElementById(legendId);
          if (!legendContainer) return;

          const ul = document.createElement('ul');
          for (let i = 0; i < chart.data.datasets.length; i++) {
            ul.innerHTML += `
              <li>
                <span style="background-color: ${chart.data.datasets[i].fillColor}"></span>
                ${chart.data.datasets[i].label}
              </li>
            `;
          }
          legendContainer.appendChild(ul);
        }
      }]
    });
  }

  // 2. Gráfico circular (Traffic Chart)
  if ($("#traffic-chart").length) {
    const ctx = document.getElementById('traffic-chart');

    var graphGradient1 = document.getElementById("traffic-chart").getContext('2d');
    var graphGradient2 = document.getElementById("traffic-chart").getContext('2d');
    var graphGradient3 = document.getElementById("traffic-chart").getContext('2d');

    var gradientStrokeBlue = graphGradient1.createLinearGradient(0, 0, 0, 181);
    gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
    gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
    var gradientLegendBlue = 'rgba(54, 215, 232, 1)';

    var gradientStrokeRed = graphGradient2.createLinearGradient(0, 0, 0, 50);
    gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
    gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
    var gradientLegendRed = 'rgba(254, 112, 150, 1)';

    var gradientStrokeGreen = graphGradient3.createLinearGradient(0, 0, 0, 300);
    gradientStrokeGreen.addColorStop(0, 'rgba(6, 185, 157, 1)');
    gradientStrokeGreen.addColorStop(1, 'rgba(132, 217, 210, 1)');
    var gradientLegendGreen = 'rgba(6, 185, 157, 1)';

    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ['Search Engines 30%', 'Direct Click 30%', 'Bookmarks Click 40%'],
        datasets: [{
          data: [30, 30, 40],
          backgroundColor: [gradientStrokeBlue, gradientStrokeGreen, gradientStrokeRed],
          hoverBackgroundColor: [gradientStrokeBlue, gradientStrokeGreen, gradientStrokeRed],
          borderColor: [gradientStrokeBlue, gradientStrokeGreen, gradientStrokeRed],
          legendColor: [gradientLegendBlue, gradientLegendGreen, gradientLegendRed]
        }]
      },
      options: {
        cutout: 50,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
        maintainAspectRatio: true,
        showScale: true,
        plugins: {
          legend: {
            display: false,
          }
        }
      },
      plugins: [{
        afterDatasetUpdate: function (chart, args, options) {
          const chartId = chart.canvas.id;
          const legendId = `${chartId}-legend`;
          const legendContainer = document.getElementById(legendId);
          if (!legendContainer) return;

          const ul = document.createElement('ul');
          for (let i = 0; i < chart.data.datasets[0].data.length; i++) {
            ul.innerHTML += `
                <li>
                  <span style="background-color: ${chart.data.datasets[0].legendColor[i]}"></span>
                  ${chart.data.labels[i]}
                </li>
              `;
          }
          legendContainer.appendChild(ul);
        }
      }]
    });
  }

  // 3. Datepicker en línea
  if ($("#inline-datepicker").length) {
    $('#inline-datepicker').datepicker({
      enableOnReadonly: true,
      todayHighlight: true,
    });
  }

  // 4. Gestión segura del Pro Banner (Solo se ejecuta si el banner existe en el HTML)
  const proBanner = document.querySelector('#proBanner');
  const navbar = document.querySelector('.navbar');
  const bodyWrapper = document.querySelector('.page-body-wrapper');
  const bannerClose = document.querySelector('#bannerClose');

  if (proBanner && navbar) {
    if (typeof $.cookie === 'function') {
      if ($.cookie('purple-pro-banner') != "true") {
        proBanner.classList.add('d-flex');
        navbar.classList.remove('fixed-top');
      } else {
        proBanner.classList.add('d-none');
        navbar.classList.add('fixed-top');
      }
    }

    if (navbar.classList.contains("fixed-top")) {
      if (bodyWrapper) bodyWrapper.classList.remove('pt-0');
      navbar.classList.remove('pt-5');
    } else {
      if (bodyWrapper) bodyWrapper.classList.add('pt-0');
      navbar.classList.add('pt-5', 'mt-3');
    }
  }

  if (bannerClose && proBanner && navbar) {
    bannerClose.addEventListener('click', function () {
      proBanner.classList.add('d-none');
      proBanner.classList.remove('d-flex');
      navbar.classList.remove('pt-5');
      navbar.classList.add('fixed-top');
      if (bodyWrapper) bodyWrapper.classList.add('proBanner-padding-top');
      navbar.classList.remove('mt-3');
      
      var date = new Date();
      date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
      if (typeof $.cookie === 'function') {
        $.cookie('purple-pro-banner', "true", {
          expires: date
        });
      }
    });
  }

})(jQuery);