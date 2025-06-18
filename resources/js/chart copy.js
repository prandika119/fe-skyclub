import ApexCharts from 'apexcharts';

document.addEventListener('DOMContentLoaded', function () {
    async function fetchData(days = 7) {
      const response = await fetch(`/admin/bookings-data?days=${days}`);
      const data = await response.json();
      console.log('Fetched data:', data); // Tambahkan log ini
      return data;
    }

    function formatData(data) {
      const categories = data.map(item => item.date);
      const seriesData = data.map(item => item.count);
      console.log('Formatted data:', { categories, seriesData }); // Tambahkan log ini
      return { categories, seriesData };
    }

    function calculateTotal(seriesData) {
      return seriesData.reduce((total, num) => total + num, 0);
    }

    const options = {
      chart: {
        height: "150%",
        maxWidth: "150%",
        type: "area",
        fontFamily: "Inter, sans-serif",
        dropShadow: {
          enabled: false,
        },
        toolbar: {
          show: false,
        },
      },
      tooltip: {
        enabled: true,
        x: {
          show: true,
        },
      },
      fill: {
        type: "gradient",
        gradient: {
          opacityFrom: 0.55,
          opacityTo: 0,
          shade: "#FF0000", // Warna merah
          gradientToColors: ["#FF0000"], // Warna merah
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        width: 6,
        colors: ['#FF0000'], // Warna merah
      },
      grid: {
        show: true,
        strokeDashArray: 4,
        padding: {
          left: 2,
          right: 2,
          top: 10,
          bottom: 10
        },
      },
      series: [],
      xaxis: {
        categories: [],
        labels: {
          show: false,
        },
        axisBorder: {
          show: true,
        },
        axisTicks: {
          show: false,
        },
      },
      yaxis: {
        show: false,
      },
    };

    const chart = new ApexCharts(document.getElementById("area-chart"), options);
    chart.render();

    async function updateChart(days, label) {
      const data = await fetchData(days);
      const { categories, seriesData } = formatData(data);
      chart.updateOptions({
        xaxis: {
          categories: categories
        }
      });
      chart.updateSeries([{
        name: "Bookings",
        data: seriesData,
        color: "#FF0000", // Warna merah
      }]);

      // Update total bookings
      const totalBookings = calculateTotal(seriesData);
      document.getElementById('total-bookings').innerText = totalBookings;
      document.getElementById('total-bookings-label').innerText = label;
    }

    // Initial load
    updateChart(7, 'Last 7 days');

    // Event listener for dropdown
    document.querySelectorAll('#lastDaysdropdown a').forEach(item => {
      item.addEventListener('click', function (event) {
        event.preventDefault();
        const days = parseInt(this.getAttribute('data-days'));
        const label = this.getAttribute('data-label');
        if (days !== null) {
          updateChart(days, label);
          document.getElementById('dropdownDefaultButton').innerHTML = `${label} <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/></svg>`;
        }
      });
    });
});
