import ApexCharts from "apexcharts";

// document.addEventListener("DOMContentLoaded", function () {
//     const bookingsChart = {
//         // Menyimpan instance chart untuk diakses nanti
//         chart: null,

//         // Elemen-elemen DOM yang akan dimanipulasi
//         elements: {
//             chartContainer: document.getElementById("area-chart"),
//             totalBookings: document.getElementById("total-bookings"),
//             totalBookingsLabel: document.getElementById("total-bookings-label"),
//             dropdownLinks: document.querySelectorAll("#lastDaysdropdown a"),
//             dropdownButton: document.getElementById("dropdownDefaultButton"),
//         },

//         // Konfigurasi awal untuk ApexCharts
//         chartOptions: {
//             chart: {
//                 height: "100%",
//                 width: "100%",
//                 type: "area",
//                 fontFamily: "Inter, sans-serif",
//                 toolbar: { show: false },
//                 locales: [
//                     {
//                         name: "en",
//                         options: { chart: { loading: { text: "Loading..." } } },
//                     },
//                 ],
//                 defaultLocale: "en",
//             },
//             tooltip: { enabled: true, x: { show: false } },
//             fill: {
//                 type: "gradient",
//                 gradient: {
//                     opacityFrom: 0.55,
//                     opacityTo: 0,
//                     shade: "#1C64F2",
//                     gradientToColors: ["#1C64F2"],
//                 },
//             },
//             dataLabels: { enabled: false },
//             stroke: { width: 6, colors: ["#1C64F2"] },
//             grid: { show: false },
//             series: [], // Data series akan diisi dari API
//             xaxis: {
//                 categories: [], // Label tanggal akan diisi dari API
//                 labels: {
//                     show: true,
//                     style: {
//                         fontFamily: "Inter, sans-serif",
//                         cssClass: "text-xs font-normal fill-gray-500",
//                     },
//                 },
//                 axisBorder: { show: false },
//                 axisTicks: { show: false },
//             },
//             yaxis: {
//                 show: false,
//                 labels: { formatter: (value) => `${value} bookings` },
//             },
//         },

//         // Fungsi untuk mengambil data dari API time-series
//         async fetchData(days) {
//             // Tampilkan indikator loading pada chart
//             this.chart.showLoading();
//             try {
//                 const response = await axios.get(`booking-stats?days=${days}`);
//                 if (!response.ok) {
//                     throw new Error(`HTTP error! Status: ${response.status}`);
//                 }
//                 const data = await response.json();
//                 console.log("Fetched data:", data);
//                 return data;
//             } catch (error) {
//                 console.error("Gagal mengambil data untuk chart:", error);
//                 this.elements.chartContainer.innerHTML = `<p class="text-center text-red-500">Gagal memuat data.</p>`;
//                 return []; // Kembalikan array kosong jika error
//             } finally {
//                 // Selalu sembunyikan loading setelah selesai, baik sukses maupun gagal
//                 this.chart.hideLoading();
//             }
//         },

//         // Fungsi untuk mengupdate chart dengan data baru
//         async updateChart(days, label) {
//             const apiData = await this.fetchData(days);

//             // Format data untuk ApexCharts
//             const categories = apiData.map((item) => item.date); // Sumbu X (tanggal)
//             const seriesData = apiData.map((item) => item.count); // Sumbu Y (jumlah booking)

//             // Update chart dengan data baru
//             this.chart.updateOptions({
//                 xaxis: { categories: categories },
//             });

//             this.chart.updateSeries([
//                 {
//                     name: "Bookings",
//                     data: seriesData,
//                     color: "#1A56DB",
//                 },
//             ]);

//             // Update total booking dan label
//             const totalBookings = seriesData.reduce(
//                 (total, num) => total + num,
//                 0
//             );
//             this.elements.totalBookings.innerText = totalBookings;
//             this.elements.totalBookingsLabel.innerText = label;

//             // Update teks tombol dropdown
//             this.elements.dropdownButton.firstChild.textContent = label + " ";
//         },

//         // Fungsi inisialisasi utama
//         init() {
//             // Pastikan elemen container ada sebelum membuat chart
//             if (!this.elements.chartContainer) {
//                 console.error("Elemen #area-chart tidak ditemukan.");
//                 return;
//             }

//             // Render chart kosong pertama kali
//             this.chart = new ApexCharts(
//                 this.elements.chartContainer,
//                 this.chartOptions
//             );
//             this.chart.render();

//             // Pasang event listener untuk setiap link di dropdown
//             this.elements.dropdownLinks.forEach((link) => {
//                 link.addEventListener("click", (event) => {
//                     event.preventDefault();
//                     const days = parseInt(link.getAttribute("data-days"));
//                     const label = link.getAttribute("data-label");
//                     this.updateChart(days, label);
//                 });
//             });

//             // Panggil updateChart untuk memuat data awal (7 hari terakhir)
//             this.updateChart(7, "Last 7 days");
//         },
//     };

//     // Jalankan semuanya
//     bookingsChart.init();
// });
