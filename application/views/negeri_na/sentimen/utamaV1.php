<?php 
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/sidebar');
$this->load->view('negeri_na/susunletak/navbar');
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LKS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="row g-3 mb-3">

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
var chartData = <?php echo $chart_data; ?>; 
var labels = []; 
var data = [];
for (var i = 0; i < chartData.length; i++) { 
    labels.push(chartData[i].minggu); // Replace 'label_column' with your label column 
    data.push(chartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
}
const myChart = new Chart(ctx, {
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


const ctxPelapor = document.getElementById('pelaporChart').getContext('2d');
var pelaporChartData = <?php echo $pelaporChartData; ?>; 
var labels = []; 
var data = [];
for (var i = 0; i < pelaporChartData.length; i++) { 
    labels.push(pelaporChartData[i].pelaporNama); // Replace 'label_column' with your label column 
    data.push(pelaporChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
}
const pelaporMyChart = new Chart(ctxPelapor, {
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

const organisasiCtx = document.getElementById('organisasiChart').getContext('2d');
var organisasiChartData = <?php echo $organisasiChartData; ?>; 
var labels = []; 
var data = [];
for (var i = 0; i < organisasiChartData.length; i++) { 
    labels.push(organisasiChartData[i].pelaporPenempatan); // Replace 'label_column' with your label column 
    data.push(organisasiChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
}
const organisasiMyChart = new Chart(organisasiCtx, {
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

const negeriCtx = document.getElementById('negeriChart').getContext('2d');
var negeriChartData = <?php echo $negeriChartData; ?>; 
var labels = []; 
var data = [];
for (var i = 0; i < negeriChartData.length; i++) { 
    labels.push(negeriChartData[i].sentimen); // Replace 'label_column' with your label column 
    data.push(negeriChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
}
const negeriMyChart = new Chart(negeriCtx, {
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

const daerahCtx = document.getElementById('daerahChart').getContext('2d');
var daerahChartData = <?php echo $daerahChartData; ?>; 
var labels = []; 
var data = [];
var labelPositif = [];
var labelNeutral = [];
var labelNegatif = [];
for (var i = 0; i < daerahChartData.length; i++) { 
    labels.push(daerahChartData[i].daerahNama); // Replace 'label_column' with your label column 
    data.push(daerahChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
    labelPositif.push(daerahChartData[i].bilanganPositif);
    labelNegatif.push(daerahChartData[i].bilanganNegatif);
    labelNeutral.push(daerahChartData[i].bilanganNeutral);
}
const daerahMyChart = new Chart(daerahCtx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Daerah',
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
        },
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const parlimenCtx = document.getElementById('parlimenChart').getContext('2d');
var parlimenChartData = <?php echo $parlimenChartData; ?>; 
var labels = []; 
var data = [];
var labelPositif = [];
var labelNeutral = [];
var labelNegatif = [];
for (var i = 0; i < parlimenChartData.length; i++) { 
    labels.push(parlimenChartData[i].parlimenNama); // Replace 'label_column' with your label column 
    data.push(parlimenChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
    labelPositif.push(parlimenChartData[i].bilanganPositif);
    labelNegatif.push(parlimenChartData[i].bilanganNegatif);
    labelNeutral.push(parlimenChartData[i].bilanganNeutral);
}
const parlimenMyChart = new Chart(parlimenCtx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Bilangan Laporan',
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
        },
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const dunCtx = document.getElementById('dunChart').getContext('2d');
var dunChartData = <?php echo $dunChartData; ?>; 
var labels = []; 
var data = [];
var labelPositif = [];
var labelNeutral = [];
var labelNegatif = [];
for (var i = 0; i < dunChartData.length; i++) { 
    labels.push(dunChartData[i].dunNama); // Replace 'label_column' with your label column 
    data.push(dunChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
    labelPositif.push(dunChartData[i].bilanganPositif);
    labelNegatif.push(dunChartData[i].bilanganNegatif);
    labelNeutral.push(dunChartData[i].bilanganNeutral);
}
const dunMyChart = new Chart(dunCtx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Bilangan Laporan',
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
        },
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const kawasanCtx = document.getElementById('kawasanChart').getContext('2d');
var kawasanChartData = <?php echo $kawasanChartData; ?>; 
var labels = []; 
var data = [];
var labelPositif = [];
var labelNeutral = [];
var labelNegatif = [];
for (var i = 0; i < kawasanChartData.length; i++) { 
    labels.push(kawasanChartData[i].kawasan); // Replace 'label_column' with your label column 
    data.push(kawasanChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
    labelPositif.push(kawasanChartData[i].bilanganPositif);
    labelNegatif.push(kawasanChartData[i].bilanganNegatif);
    labelNeutral.push(kawasanChartData[i].bilanganNeutral);
}
const kawasanMyChart = new Chart(kawasanCtx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Bilangan Laporan',
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
        },
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const pekerjaanCtx = document.getElementById('pekerjaanChart').getContext('2d');
var pekerjaanChartData = <?php echo $pekerjaanChartData; ?>; 
var labels = []; 
var data = [];
var labelPositif = [];
var labelNeutral = [];
var labelNegatif = [];
for (var i = 0; i < pekerjaanChartData.length; i++) { 
    labels.push(pekerjaanChartData[i].pekerjaan); // Replace 'label_column' with your label column 
    data.push(pekerjaanChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
    labelPositif.push(pekerjaanChartData[i].bilanganPositif);
    labelNegatif.push(pekerjaanChartData[i].bilanganNegatif);
    labelNeutral.push(pekerjaanChartData[i].bilanganNeutral);
}
const pekerjaanMyChart = new Chart(pekerjaanCtx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Bilangan Laporan',
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
        },
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const umurCtx = document.getElementById('umurChart').getContext('2d');
var umurChartData = <?php echo $umurChartData; ?>; 
var labels = []; 
var data = [];
var labelPositif = [];
var labelNeutral = [];
var labelNegatif = [];
for (var i = 0; i < umurChartData.length; i++) { 
    labels.push(umurChartData[i].umur); // Replace 'label_column' with your label column 
    data.push(umurChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
    labelPositif.push(umurChartData[i].bilanganPositif);
    labelNegatif.push(umurChartData[i].bilanganNegatif);
    labelNeutral.push(umurChartData[i].bilanganNeutral);
}
const umurMyChart = new Chart(umurCtx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Bilangan Laporan',
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
        },
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const kaumCtx = document.getElementById('kaumChart').getContext('2d');
var kaumChartData = <?php echo $kaumChartData; ?>; 
var labels = []; 
var data = [];
var labelPositif = [];
var labelNeutral = [];
var labelNegatif = [];
for (var i = 0; i < kaumChartData.length; i++) { 
    labels.push(kaumChartData[i].kaum); // Replace 'label_column' with your label column 
    data.push(kaumChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
    labelPositif.push(kaumChartData[i].bilanganPositif);
    labelNegatif.push(kaumChartData[i].bilanganNegatif);
    labelNeutral.push(kaumChartData[i].bilanganNeutral);
}
const kaumMyChart = new Chart(kaumCtx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Bilangan Laporan',
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
        }
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const jantinaCtx = document.getElementById('jantinaChart').getContext('2d');
var jantinaChartData = <?php echo $jantinaChartData; ?>; 
var labels = []; 
var data = [];
var labelPositif = [];
var labelNeutral = [];
var labelNegatif = [];
for (var i = 0; i < jantinaChartData.length; i++) { 
    labels.push(jantinaChartData[i].jantina); // Replace 'label_column' with your label column 
    data.push(jantinaChartData[i].bilanganLaporan); // Replace 'data_column' with your data column 
    labelPositif.push(jantinaChartData[i].bilanganPositif);
    labelNegatif.push(jantinaChartData[i].bilanganNegatif);
    labelNeutral.push(jantinaChartData[i].bilanganNeutral);
}
const jantinaMyChart = new Chart(jantinaCtx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Bilangan Laporan',
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
        }
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


</script>


<?php $this->load->view('negeri_na/susunletak/bawah'); ?>