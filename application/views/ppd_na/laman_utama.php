<?php
$this->load->view('ppd_na/susunletak/atas');
$this->load->view('ppd_na/susunletak/navbar');
$this->load->view('ppd_na/susunletak/sidebar');
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row row-cols-5">

                 <!-- Negeri Card -->
                 <div class="col col-lg col-sm-6">
                        <div class="card info-card sales-card">

                            <!--<div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>-->

                            <div class="card-body">
                                <h5 class="card-title">Keseluruhan</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Negeri Card -->

                    <!-- Negeri Card -->
                    <div class="col col-lg col-sm-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Negeri</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Johor</a></li>
                                    <li><a class="dropdown-item" href="#">Kedah</a></li>
                                    <li><a class="dropdown-item" href="#">Kelantan</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Negeri <span>| Johor</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Negeri Card -->

                    <!-- Daerah Card -->
                    <div class="col col-lg col-sm-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Daerah</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Batu Pahat</a></li>
                                    <li><a class="dropdown-item" href="#">Johor Bahru</a></li>
                                    <li><a class="dropdown-item" href="#">Kluang</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Daerah <span>| Batu Pahat</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>3,264</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Daerah Card -->

                    <!-- Parlimen Card -->
                    <div class="col col-lg col-sm-6">

                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Parlimen</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">P.001 Padang Besar</a></li>
                                    <li><a class="dropdown-item" href="#">P.002 Kangar</a></li>
                                    <li><a class="dropdown-item" href="#">P.003 Arau</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Parlimen <span>| P.001 Padang Besar</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>1244</h6>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Parlimen Card -->

                    <!-- DUN Card -->
                    <div class="col col-lg col-sm-6">

                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>DUN</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">N.01 Buloh Kasap</a></li>
                                    <li><a class="dropdown-item" href="#">N.02 Jementah</a></li>
                                    <li><a class="dropdown-item" href="#">N.03 Pemanis</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">DUN <span>| N.01 Buloh Kasap</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>1244</h6>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End DUN Card -->

</div>
<div class="row">

                    <!-- Recent Sales -->
                    <div class="col-3">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">OBP Mengikut Negeri</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Negeri</th>
                                            <th scope="col">Bilangan OBP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($negeri as $n){ ?>
                                        <?php foreach($h as $o){ ?>
                                            
                                        <tr>
                                            <th scope="row"><?= $n->nt_nama ?></th>
                                            <?php if($n->nt_bil == $o->negeri_id): 
                                                $obp = 0; ?>
                                            <td><?= 0 ?></td>
                                            <?php endif;} ?>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Reports -->
                    <div class="col-9">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">OBP Mengikut Negeri</h5>

                                <!-- Line Chart -->
                                <canvas id="negeri"></canvas>



                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Recent Sales -->
                    <div class="col-4">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">OBP Mengikut Jantina</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Jantina</th>
                                            <th scope="col">Bilangan OBP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Lelaki</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Perempuan</th>
                                            <td>64</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Recent Sales -->
                    <div class="col-4">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">OBP Mengikut Kategori Umur</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kategori Umur</th>
                                            <th scope="col">Bilangan OBP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">18-24</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">25-40</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">41-60</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">61-70</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">71-80</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">81 dan ke atas</th>
                                            <td>64</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Recent Sales -->
                    <div class="col-4">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">OBP Mengikut Kaum</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kaum</th>
                                            <th scope="col">Bilangan OBP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Melayu</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Cina</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">India</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Bumiputera Islam Sabah(Lain-Lain Kaum)</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Bumiputera Bukan Islam(Kadazan, Dusun, Murut)</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Iban</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Bidayuh</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Melanau</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Orang Ulu</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Orang Asli</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Punjabi/Sikh</th>
                                            <td>64</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Lain-Lain Kaum</th>
                                            <td>64</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Recent Sales -->
                    <div class="col-4">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">OBP Mengikut Jantina</h5>

                                <!-- Line Chart -->
                                <canvas id="jantina"></canvas>
                                <!-- End Line Chart -->
                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Reports -->
                    <div class="col-4">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">OBP Mengikut Kategori Umur</h5>

                                <!-- Line Chart -->
                                <canvas id="kategoriUmur"></canvas>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Top Selling -->
                    <div class="col-4">
                        <div class="card top-selling overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body pb-0">
                                <h5 class="card-title">OBP Mengikut Kaum</h5>

                                <!-- Line Chart -->
                                <canvas id="kaum"></canvas>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>

</main><!-- End #main -->

<?php
$this->load->view('ppd_na/susunletak/bawah');
?>

<script>
const negeri = document.getElementById('negeri');

new Chart(negeri, {
    type: 'bar',
    data: {
        labels: ['Johor', 'Kedah', 'Kelantan', 'Melaka', 'Negeri Sembilan', 'Pahang', 'Perak', 'Perlis', 'Pulau Pinang', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu', 'W.P Kuala Lumpur', 'W.P Labuan', 'W.P Putrajaya'
        ],
        datasets: [{
            label: 'Bilangan OBP',
            data: [4, 3, 1, 1, 1, 1],
            backgroundColor: ['rgba(255, 99, 132, 0.8)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 205, 86, 0.4)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Bilangan OBP Mengikut Negeri'
            },
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const umur = document.getElementById('kategoriUmur');

new Chart(umur, {
    type: 'polarArea',
    data: {
        labels: ['18-24', '25-40', '41-60', '61-70', '71-80',
            '81 dan ke atas'
        ],
        datasets: [{
            label: 'Bilangan OBP',
            data: [4, 3, 1, 1, 1, 1],
            backgroundColor: ['rgba(255, 99, 132, 0.8)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 205, 86, 0.4)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Bilangan OBP Mengikut Kategori Umur'
            },
        }
    }
});

const jantina = document.getElementById('jantina');

new Chart(jantina, {
    type: 'pie',
    data: {
        labels: ['Lelaki', 'Perempuan'],
        datasets: [{
            label: 'Bilangan OBP',
            data: [4, 3],
            backgroundColor: ['rgba(255, 99, 132, 0.8)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 205, 86, 0.4)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Bilangan OBP Mengikut Jantina'
            },
        }
    }
});

const kaum = document.getElementById('kaum');

new Chart(kaum, {
    type: 'doughnut',
    data: {
        labels: ['Melayu', 'India', 'Cina', 'Bumiputera Islam Sabah(Lain-Lain Kaum)', 'Bumiputera Bukan Islam Sabah(Kadazan, Dusun, Murut)', 'Iban', 'Bidayuh', 'Melanau', 'Orang Ulu', 'Orang Asli', 'Punjabi/Sikh',  'Lain-Lain Kaum'
        ],
        datasets: [{
            label: 'Bilangan OBP',
            data: [4, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
            backgroundColor: ['rgba(255, 99, 132, 0.8)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(255, 205, 86, 0.4)',
                'rgb(232, 160, 191)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgb(102, 90, 72)',
                'rgb(130, 148, 96)',
                'rgb(223, 211, 195)',
                'rgb(188, 206, 248)',
                'rgba(75, 192, 192, 0.2)',
                'rgb(96, 150, 180)',
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Bilangan OBP Mengikut Kaum'
            },
        }
    }
});
</script>