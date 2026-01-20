<?php 
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/sidebar');
$this->load->view('us_lapis_na/susunletak/navbar');

// Prepare data for the JavaScript chart
$negeriNames = json_encode(array_column($senaraiNegeri, 'negeriNama'));
$positifData = json_encode(array_column($senaraiNegeri, 'positif'));
$neutralData = json_encode(array_column($senaraiNegeri, 'neutral'));
$negatifData = json_encode(array_column($senaraiNegeri, 'negatif'));
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>RIMS@LPK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>"><i class="bi bi-house"></i> Laporan Persepsi Terhadap Kerajaan</a></li>
                <li class="breadcrumb-item active">Rumusan Kumulatif</li>
            </ol>
        </nav>
    </div><section class="section dashboard">

        <div class="card" data-aos="fade-up">
            <div class="card-body pt-3">
                 <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="<?= site_url('sentimen') ?>" class="nav-link"><i class="bi bi-house me-1"></i> Utama</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="<?= site_url('sentimen/senarai') ?>" class="nav-link"><i class="bi bi-list-ul me-1"></i> Senarai Laporan</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="<?= site_url('sentimen/borang') ?>" class="nav-link"><i class="bi bi-card-checklist me-1"></i> Borang Baharu</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link active"><i class="bi bi-bar-chart-line-fill me-1"></i> Rumusan Kumulatif</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="<?= site_url('sentimen/urus_tadbir') ?>" class="nav-link"><i class="bi bi-bar-chart-line-fill me-1"></i> Urus Tadbir Isu Sentimen</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card" data-aos="fade-up" data-aos-delay="200">
            <div class="card-body">
                <h5 class="card-title">Graf Rumusan Sentimen Mengikut Negeri <span>| Tahun <?= date('Y') ?></span></h5>

                <div id="sentimentChart"></div>

            </div>
        </div>
        <div class="card" data-aos="fade-up" data-aos-delay="400">
            <div class="card-body">
                <h5 class="card-title">Data Terperinci Mengikut Negeri</h5>
                <p>Jadual berikut memaparkan data terperinci yang boleh diisih dan dicari.</p>

                <div class="table-responsive">
                    <table class="table table-hover datatable">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col">Negeri</th>
                                <th scope="col" class="text-center">Positif</th>
                                <th scope="col" class="text-center">Neutral</th>
                                <th scope="col" class="text-center">Negatif</th>
                                <th scope="col" class="text-center">Sentimen Dominan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $count = 1; 
                            foreach($senaraiNegeri as $negeri):
                                if($negeri->dominan == 'POSITIF'){
                                    $badge_color = 'bg-success';
                                } elseif($negeri->dominan == 'NEGATIF'){
                                    $badge_color = 'bg-danger';
                                } else {
                                    $badge_color = 'bg-warning';
                                } 
                            ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $count++ ?></th>
                                <td><?= $negeri->negeriNama ?></td>
                                <td class="text-center"><?= $negeri->positif ?></td>
                                <td class="text-center"><?= $negeri->neutral ?></td>
                                <td class="text-center"><?= $negeri->negatif ?></td>
                                <td class="text-center">
                                    <span class="badge <?= $badge_color ?>"><?= $negeri->dominan ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </section>

</main>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        new ApexCharts(document.querySelector("#sentimentChart"), {
            series: [{
                name: 'Positif',
                data: <?= $positifData ?>
            }, {
                name: 'Neutral',
                data: <?= $neutralData ?>
            }, {
                name: 'Negatif',
                data: <?= $negatifData ?>
            }],
            chart: {
                type: 'bar',
                height: 400,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            colors: ['#198754', '#ffc107', '#dc3545'],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 5
                },
            },
            xaxis: {
                type: 'category',
                categories: <?= $negeriNames ?>,
            },
            legend: {
                position: 'top',
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " laporan"
                    }
                }
            }
        }).render();
    });
</script>

<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>