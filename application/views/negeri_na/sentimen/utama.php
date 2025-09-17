<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LPK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="row g-3 mb-3">

    <div class="col-12">
            <div class="alert alert-danger">
                <span>DALAM PEMBINAAN. SEDANG DIBANGUNKAN. ISU PADA KIRAAN.</span>
            </div>
    </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Mingguan</h5>
                <canvas id="mingguanChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Pelapor</h5>
                <canvas id="pelaporChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Organisasi</h5>
                <canvas id="organisasiChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Negeri</h5>
                <canvas id="negeriChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Daerah</h5>
                <canvas id="daerahChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Parlimen</h5>
                <canvas id="parlimenChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>DUN</h5>
                <canvas id="dunChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Kawasan</h5>
                <canvas id="kawasanChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Pekerjaan</h5>
                <canvas id="pekerjaanChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Kategori Umur</h5>
                <canvas id="umurChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Kaum</h5>
                <canvas id="kaumChart"></canvas>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="p-3 border rounded bg-white">
                <h5>Jantina</h5>
                <canvas id="jantinaChart"></canvas>
            </div>
        </div>

    </div>

    </section>

</main>

<script>
const ctx = document.getElementById('mingguanChart').getContext('2d');
let myChart;
const pelaporCtx = document.getElementById('pelaporChart').getContext('2d');
let pelaporMyChart;

function pelaporFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenPelapor') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.pelaporNama);
            const pelaporData = chartData.map(item => item.bilanganLaporan);

            // If the chart already exists, update its data
            if (pelaporMyChart) {
                pelaporMyChart.data.labels = labels;
                pelaporMyChart.data.datasets[0].data = pelaporData;
                pelaporMyChart.update();
            } else {
                // Create the chart for the first time
                pelaporMyChart = new Chart(pelaporCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: pelaporData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Function to fetch data and update the chart
function mingguanFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenMingguan') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.minggu);
            const data = chartData.map(item => item.bilanganLaporan);

            // If the chart already exists, update its data
            if (myChart) {
                myChart.data.labels = labels;
                myChart.data.datasets[0].data = data;
                myChart.update();
            } else {
                // Create the chart for the first time
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(() => {
    mingguanFetchDataAndUpdateChart();
    pelaporFetchDataAndUpdateChart();
}, 2001);

// Initial data fetch to create the chart
mingguanFetchDataAndUpdateChart();
pelaporFetchDataAndUpdateChart();

const organisasiCtx = document.getElementById('organisasiChart').getContext('2d');
let organisasiMyChart;

function organisasiFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenOrganisasi') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.pelaporPenempatan);
            const data = chartData.map(item => item.bilanganLaporan);

            // If the chart already exists, update its data
            if (organisasiMyChart) {
                organisasiMyChart.data.labels = labels;
                organisasiMyChart.data.datasets[0].data = data;
                organisasiMyChart.update();
            } else {
                // Create the chart for the first time
                organisasiMyChart = new Chart(organisasiCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(organisasiFetchDataAndUpdateChart, 2002);

// Initial data fetch to create the chart
organisasiFetchDataAndUpdateChart();


const negeriCtx = document.getElementById('negeriChart').getContext('2d');
let negeriMyChart;

function negeriFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenNegeri') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.sentimen);
            const data = chartData.map(item => item.bilanganLaporan);

            // If the chart already exists, update its data
            if (negeriMyChart) {
                negeriMyChart.data.labels = labels;
                negeriMyChart.data.datasets[0].data = data;
                negeriMyChart.update();
            } else {
                // Create the chart for the first time
                negeriMyChart = new Chart(negeriCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(negeriFetchDataAndUpdateChart, 2004);

// Initial data fetch to create the chart
negeriFetchDataAndUpdateChart();

const daerahCtx = document.getElementById('daerahChart').getContext('2d');
let daerahMyChart;

function daerahFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenDaerah') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.daerahNama);
            const data = chartData.map(item => item.bilanganLaporan);
            const labelPositif = chartData.map(item => item.bilanganPositif);
            const labelNeutral = chartData.map(item => item.bilanganNeutral);
            const labelNegatif = chartData.map(item => item.bilanganNegatif);

            // If the chart already exists, update its data
            if (daerahMyChart) {
                daerahMyChart.data.labels = labels;
                daerahMyChart.data.datasets[0].data = data;
                daerahMyChart.data.datasets[1].data = labelPositif;
                daerahMyChart.data.datasets[2].data = labelNeutral;
                daerahMyChart.data.datasets[3].data = labelNegatif;
                daerahMyChart.update();
            } else {
                // Create the chart for the first time
                daerahMyChart = new Chart(daerahCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Positif',
                            data: labelPositif,
                            backgroundColor: 'rgba(178, 222, 39, 0.2)',
                            borderColor: 'rgba(178, 222, 39, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Neutral',
                            data: labelNeutral,
                            backgroundColor: 'rgba(137, 196, 244, 0.2)',
                            borderColor: 'rgba(137, 196, 244, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Negatif',
                            data: labelNegatif,
                            backgroundColor: 'rgba(150, 40, 27, 0.2)',
                            borderColor: 'rgba(150, 40, 27, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(daerahFetchDataAndUpdateChart, 1000);

// Initial data fetch to create the chart
daerahFetchDataAndUpdateChart();

const parlimenCtx = document.getElementById('parlimenChart').getContext('2d');
let parlimenMyChart;

function parlimenFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenParlimen') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.parlimenNama);
            const parlimenData = chartData.map(item => item.bilanganLaporan);
            const labelPositif = chartData.map(item => item.bilanganPositif);
            const labelNeutral = chartData.map(item => item.bilanganNeutral);
            const labelNegatif = chartData.map(item => item.bilanganNegatif);

            // If the chart already exists, update its data
            if (parlimenMyChart) {
                parlimenMyChart.data.labels = labels;
                parlimenMyChart.data.datasets[0].data = parlimenData;
                parlimenMyChart.data.datasets[1].data = labelPositif;
                parlimenMyChart.data.datasets[2].data = labelNeutral;
                parlimenMyChart.data.datasets[3].data = labelNegatif;
                parlimenMyChart.update();
            } else {
                // Create the chart for the first time
                parlimenMyChart = new Chart(parlimenCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: parlimenData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Positif',
                            data: labelPositif,
                            backgroundColor: 'rgba(178, 222, 39, 0.2)',
                            borderColor: 'rgba(178, 222, 39, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Neutral',
                            data: labelNeutral,
                            backgroundColor: 'rgba(137, 196, 244, 0.2)',
                            borderColor: 'rgba(137, 196, 244, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Negatif',
                            data: labelNegatif,
                            backgroundColor: 'rgba(150, 40, 27, 0.2)',
                            borderColor: 'rgba(150, 40, 27, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(parlimenFetchDataAndUpdateChart, 2004);

// Initial data fetch to create the chart
parlimenFetchDataAndUpdateChart();

const dunCtx = document.getElementById('dunChart').getContext('2d');
let dunMyChart;

function dunFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenDun') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.dunNama);
            const dunData = chartData.map(item => item.bilanganLaporan);
            const labelPositif = chartData.map(item => item.bilanganPositif);
            const labelNeutral = chartData.map(item => item.bilanganNeutral);
            const labelNegatif = chartData.map(item => item.bilanganNegatif);

            // If the chart already exists, update its data
            if (dunMyChart) {
                dunMyChart.data.labels = labels;
                dunMyChart.data.datasets[0].data = dunData;
                dunMyChart.data.datasets[1].data = labelPositif;
                dunMyChart.data.datasets[2].data = labelNegatif;
                dunMyChart.data.datasets[3].data = labelNeutral;
                dunMyChart.update();
            } else {
                // Create the chart for the first time
                dunMyChart = new Chart(dunCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: dunData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Positif',
                            data: labelPositif,
                            backgroundColor: 'rgba(178, 222, 39, 0.2)',
                            borderColor: 'rgba(178, 222, 39, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Negatif',
                            data: labelNegatif,
                            backgroundColor: 'rgba(150, 40, 27, 0.2)',
                            borderColor: 'rgba(150, 40, 27, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Neutral',
                            data: labelNeutral,
                            backgroundColor: 'rgba(137, 196, 244, 0.2)',
                            borderColor: 'rgba(137, 196, 244, 1)',
                            borderWidth: 1
                        },]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(dunFetchDataAndUpdateChart, 2000);

// Initial data fetch to create the chart
dunFetchDataAndUpdateChart();

const kawasanCtx = document.getElementById('kawasanChart').getContext('2d');
let kawasanMyChart;

function kawasanFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenKawasan') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.kawasan);
            const data = chartData.map(item => item.bilanganLaporan);
            const labelPositif = chartData.map(item => item.bilanganPositif);
            const labelNeutral = chartData.map(item => item.bilanganNeutral);
            const labelNegatif = chartData.map(item => item.bilanganNegatif);

            // If the chart already exists, update its data
            if (kawasanMyChart) {
                kawasanMyChart.data.labels = labels;
                kawasanMyChart.data.datasets[0].data = data;
                kawasanMyChart.data.datasets[1].data = labelPositif;
                kawasanMyChart.data.datasets[2].data = labelNeutral;
                kawasanMyChart.data.datasets[3].data = labelNegatif;
                kawasanMyChart.update();
            } else {
                // Create the chart for the first time
                kawasanMyChart = new Chart(kawasanCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Positif',
                            data: labelPositif,
                            backgroundColor: 'rgba(178, 222, 39, 0.2)',
                            borderColor: 'rgba(178, 222, 39, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Neutral',
                            data: labelNeutral,
                            backgroundColor: 'rgba(137, 196, 244, 0.2)',
                            borderColor: 'rgba(137, 196, 244, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Negatif',
                            data: labelNegatif,
                            backgroundColor: 'rgba(150, 40, 27, 0.2)',
                            borderColor: 'rgba(150, 40, 27, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(kawasanFetchDataAndUpdateChart, 2004);

// Initial data fetch to create the chart
kawasanFetchDataAndUpdateChart();

const pekerjaanCtx = document.getElementById('pekerjaanChart').getContext('2d');
let pekerjaanMyChart;

function pekerjaanFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenPekerjaan') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.pekerjaan);
            const data = chartData.map(item => item.bilanganLaporan);
            const labelPositif = chartData.map(item => item.bilanganPositif);
            const labelNeutral = chartData.map(item => item.bilanganNeutral);
            const labelNegatif = chartData.map(item => item.bilanganNegatif);

            // If the chart already exists, update its data
            if (pekerjaanMyChart) {
                pekerjaanMyChart.data.labels = labels;
                pekerjaanMyChart.data.datasets[0].data = data;
                pekerjaanMyChart.data.datasets[1].data = labelPositif;
                pekerjaanMyChart.data.datasets[2].data = labelNeutral;
                pekerjaanMyChart.data.datasets[3].data = labelNegatif;
                pekerjaanMyChart.update();
            } else {
                // Create the chart for the first time
                pekerjaanMyChart = new Chart(pekerjaanCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Positif',
                            data: labelPositif,
                            backgroundColor: 'rgba(178, 222, 39, 0.2)',
                            borderColor: 'rgba(178, 222, 39, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Neutral',
                            data: labelNeutral,
                            backgroundColor: 'rgba(137, 196, 244, 0.2)',
                            borderColor: 'rgba(137, 196, 244, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Negatif',
                            data: labelNegatif,
                            backgroundColor: 'rgba(150, 40, 27, 0.2)',
                            borderColor: 'rgba(150, 40, 27, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(pekerjaanFetchDataAndUpdateChart, 1000);

// Initial data fetch to create the chart
pekerjaanFetchDataAndUpdateChart();

const umurCtx = document.getElementById('umurChart').getContext('2d');
let umurMyChart;

function umurFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenUmur') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.umur);
            const data = chartData.map(item => item.bilanganLaporan);
            const labelPositif = chartData.map(item => item.bilanganPositif);
            const labelNeutral = chartData.map(item => item.bilanganNeutral);
            const labelNegatif = chartData.map(item => item.bilanganNegatif);

            // If the chart already exists, update its data
            if (umurMyChart) {
                umurMyChart.data.labels = labels;
                umurMyChart.data.datasets[0].data = data;
                umurMyChart.data.datasets[1].data = labelPositif;
                umurMyChart.data.datasets[2].data = labelNeutral;
                umurMyChart.data.datasets[3].data = labelNegatif;
                umurMyChart.update();
            } else {
                // Create the chart for the first time
                umurMyChart = new Chart(umurCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Positif',
                            data: labelPositif,
                            backgroundColor: 'rgba(178, 222, 39, 0.2)',
                            borderColor: 'rgba(178, 222, 39, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Neutral',
                            data: labelNeutral,
                            backgroundColor: 'rgba(137, 196, 244, 0.2)',
                            borderColor: 'rgba(137, 196, 244, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Negatif',
                            data: labelNegatif,
                            backgroundColor: 'rgba(150, 40, 27, 0.2)',
                            borderColor: 'rgba(150, 40, 27, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(umurFetchDataAndUpdateChart, 1000);

// Initial data fetch to create the chart
umurFetchDataAndUpdateChart();

const kaumCtx = document.getElementById('kaumChart').getContext('2d');
let kaumMyChart;

function kaumFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenKaum') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.kaum);
            const data = chartData.map(item => item.bilanganLaporan);
            const labelPositif = chartData.map(item => item.bilanganPositif);
            const labelNeutral = chartData.map(item => item.bilanganNeutral);
            const labelNegatif = chartData.map(item => item.bilanganNegatif);

            // If the chart already exists, update its data
            if (kaumMyChart) {
                kaumMyChart.data.labels = labels;
                kaumMyChart.data.datasets[0].data = data;
                kaumMyChart.data.datasets[1].data = labelPositif;
                kaumMyChart.data.datasets[2].data = labelNeutral;
                kaumMyChart.data.datasets[3].data = labelNegatif;
                kaumMyChart.update();
            } else {
                // Create the chart for the first time
                kaumMyChart = new Chart(kaumCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Positif',
                            data: labelPositif,
                            backgroundColor: 'rgba(178, 222, 39, 0.2)',
                            borderColor: 'rgba(178, 222, 39, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Neutral',
                            data: labelNeutral,
                            backgroundColor: 'rgba(137, 196, 244, 0.2)',
                            borderColor: 'rgba(137, 196, 244, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Negatif',
                            data: labelNegatif,
                            backgroundColor: 'rgba(150, 40, 27, 0.2)',
                            borderColor: 'rgba(150, 40, 27, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(kaumFetchDataAndUpdateChart, 2004);

// Initial data fetch to create the chart
kaumFetchDataAndUpdateChart();

const jantinaCtx = document.getElementById('jantinaChart').getContext('2d');
let jantinaMyChart;

function jantinaFetchDataAndUpdateChart() {
    fetch('<?= site_url('clr/negeriSentimenJantina') ?>') // Replace with your PHP endpoint
        .then(response => response.json())
        .then(chartData => {
            // Extract labels and data
            const labels = chartData.map(item => item.jantina);
            const data = chartData.map(item => item.bilanganLaporan);
            const labelPositif = chartData.map(item => item.bilanganPositif);
            const labelNeutral = chartData.map(item => item.bilanganNeutral);
            const labelNegatif = chartData.map(item => item.bilanganNegatif);

            // If the chart already exists, update its data
            if (jantinaMyChart) {
                jantinaMyChart.data.labels = labels;
                jantinaMyChart.data.datasets[0].data = data;
                jantinaMyChart.data.datasets[1].data = labelPositif;
                jantinaMyChart.data.datasets[2].data = labelNeutral;
                jantinaMyChart.data.datasets[3].data = labelNegatif;
                jantinaMyChart.update();
            } else {
                // Create the chart for the first time
                jantinaMyChart = new Chart(jantinaCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Bilangan Laporan",
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Positif',
                            data: labelPositif,
                            backgroundColor: 'rgba(178, 222, 39, 0.2)',
                            borderColor: 'rgba(178, 222, 39, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Neutral',
                            data: labelNeutral,
                            backgroundColor: 'rgba(137, 196, 244, 0.2)',
                            borderColor: 'rgba(137, 196, 244, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Negatif',
                            data: labelNegatif,
                            backgroundColor: 'rgba(150, 40, 27, 0.2)',
                            borderColor: 'rgba(150, 40, 27, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Fetch data and update the chart every second
setInterval(jantinaFetchDataAndUpdateChart, 2004);

// Initial data fetch to create the chart
jantinaFetchDataAndUpdateChart();

</script>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>