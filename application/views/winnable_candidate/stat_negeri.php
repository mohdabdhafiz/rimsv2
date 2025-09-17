<div class="container-fluid">

    <div class="p-3 border rounded mb-3 text-center">
        <p class="text-muted small">Jumlah Pencalonan</p>
        <h1 class="display-1"><?php $bilangan_calon_negeri = 0; $bilangan_calon_negeri = count($data_wcp->semua_negeri($data_wc_model->assign($pengguna->pengguna_peranan_bil)->wcat_negeri)); echo $bilangan_calon_negeri; ?></h1>
    </div>
</div>
<?php if($bilangan_calon_negeri != 0){ 
    $negeri = $data_wc_model->assign($pengguna->pengguna_peranan_bil)->wcat_negeri;
?>
<div class="container-fluid mb-3">
    <div class="row g-3">
        <div class="col-12 col-lg-12">
            <div class="p-3 border rounded">
                <h3>PENCALONAN MENGIKUT PARLIMEN</h3>
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <canvas id="chart_parlimen"></canvas>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-bordered table-hover">
                                <tr class="bg-secondary text-white">
                                    <th class="text-center" valign="middle">BIL</th>
                                    <th valign="middle">PARLIMEN</th>
                                    <th class="text-center" valign="middle">BILANGAN PENCALONAN</th>
                                </tr>
                                <?php $senarai_parlimen = array();
                                $bil_calon_parlimen = array();
                                $count = 1;
                                $jumlah_calon = 0; 
                                $jumlah_peratusan = 0;
                                foreach($data_wcp->ikut_negeri($negeri) as $maklumat_parlimen){
                                    array_push($senarai_parlimen, $data_parlimen->parlimen_bil($maklumat_parlimen->wct_parlimen_bil)->pt_nama);
                                    array_push($bil_calon_parlimen, $maklumat_parlimen->kira);
                                ?>
                                <tr>
                                    <td class="text-center" valign="middle"><?php echo $count++; ?></td>
                                    <td valign="middle"><?php echo anchor("parlimen/papar_parlimen/".$maklumat_parlimen->wct_parlimen_bil, $data_parlimen->parlimen_bil($maklumat_parlimen->wct_parlimen_bil)->pt_nama); ?></td>
                                    <td class="text-center" valign="middle"><?php $jumlah_calon = $jumlah_calon + (int)$maklumat_parlimen->kira; echo $maklumat_parlimen->kira; ?></td>
                                </tr>
                                <?php } ?>
                                <tr class="bg-light">
                                    <th colspan=2 class="text-center" valign="middle">JUMLAH</th>
                                    <th class="text-center" valign="middle"><?php echo $jumlah_calon; ?></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="p-3 border rounded">
                <h3>PENCALONAN MENGIKUT PARTI</h3>
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <canvas id="chart_parti"></canvas>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <tr class="bg-secondary text-white">
                                    <th class="text-center" valign="middle">BIL</th>
                                    <th valign="middle">PARTI</th>
                                    <th class="text-center" valign="middle">BILANGAN PARLIMEN</th>
                                    <th class="text-center" valign="middle">BILANGAN CALON</th>
                                </tr>
                                <?php
                                $count = 1; 
                                $jumlah_calon = 0; 
                                $jumlah_peratusan = 0;
                                $senarai_parti = array();
                                $bil_calon_parti = array();
                                foreach($data_wcp->ikut_negeri_parti($negeri) as $maklumat_parti){
                                    array_push($senarai_parti, $data_parti->parti($maklumat_parti->wct_parti_bil)->parti_singkatan);
                                    array_push($bil_calon_parti, $maklumat_parti->kira); ?>
                                <tr>
                                    <td class="text-center" valign="middle"><?php echo $count++; ?></td>
                                    <td valign="middle"><?php echo $data_parti->parti($maklumat_parti->wct_parti_bil)->parti_nama; ?> (<?php echo $data_parti->parti($maklumat_parti->wct_parti_bil)->parti_singkatan;?>)</td>
                                    <td class="text-center" valign="middle">19</td>
                                    <td class="text-center" valign="middle"><?php $jumlah_calon = $jumlah_calon + (int)$maklumat_parti->kira; echo $maklumat_parti->kira; ?></td>
                                </tr>
                                 
                                <?php   }
                                 ?> 
                                <tr class="bg-light">
                                    <th colspan=3 class="text-center" valign="middle">JUMLAH</th>
                                    <th class="text-center" valign="middle"><?php echo $jumlah_calon; ?></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="p-3 border rounded">
                <h3>ANALISA JANGKAAN CALON PARLIMEN PRU15 MENGIKUT KATEGORI UMUR</h3>
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <canvas id="chart_kategori_umur"></canvas>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered">
                            <tr>
                                <th class="text-center">BIL</th>
                                <th>KATEGORI UMUR</th>
                                <th class="text-center">BILANGAN CALON</th>
                                <th class="text-center">PERATUSAN</th>
                            </tr>
                            <?php 
                            $count = 1;
                            $jumlah_calon = 0;
                            $jumlah_peratusan = 0;
                            $senarai_kategori_umur = array();
                            $bil_calon_umur = array();
                            foreach($data_wcp->ikut_umur($negeri) as $maklumat_umur): 
                            array_push($senarai_kategori_umur, $maklumat_umur->wct_kategori_umur);
                            array_push($bil_calon_umur, $maklumat_umur->kira);
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $count++; ?></td>
                                <td><?php echo $maklumat_umur->wct_kategori_umur; ?></td>
                                <td class="text-center"><?php $jumlah_calon = $jumlah_calon + $maklumat_umur->kira; echo $maklumat_umur->kira; ?></td>
                                <td class="text-center"><?php $peratus = ($maklumat_umur->kira/$bilangan_calon_negeri)*100;
                                $jumlah_peratusan = $jumlah_peratusan + $peratus;
                                $peratus = number_format($peratus, 2, '.', ','); 
                                echo $peratus; 
                                ?>%</td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan=2  class="text-center">JUMLAH</th>
                                <th class="text-center"><?php echo $jumlah_calon; ?></th>
                                <th class="text-center"><?php echo $jumlah_peratusan; ?>%</th>
                            </tr>
                        </table>
                        </div>
                        <p class="small text-muted">Peratusan dikira dengan keseluruhan calon dalam negeri <?php echo $negeri; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="p-3 border rounded">
                <h3>ANALISA JANGKAAN CALON PARLIMEN PRU15 MENGIKUT KATEGORI JANTINA</h3>
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <canvas id="chart_jantina"></canvas>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered">
                            <tr>
                                <th class="text-center">BIL</th>
                                <th>JANTINA</th>
                                <th class="text-center">BILANGAN CALON</th>
                                <th class="text-center">PERATUSAN</th>
                            </tr>
                            <?php 
                            $count = 1;
                            $jumlah_calon = 0;
                            $jumlah_peratusan = 0;
                            $senarai_jantina = array();
                            $bil_calon_jantina = array();
                            foreach($data_wcp->ikut_jantina($negeri) as $maklumat_jantina): 
                            array_push($senarai_jantina, $maklumat_jantina->wct_jantina);
                            array_push($bil_calon_jantina, $maklumat_jantina->kira);
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $count++; ?></td>
                                <td><?php echo $maklumat_jantina->wct_jantina; ?></td>
                                <td class="text-center"><?php $jumlah_calon = $jumlah_calon + $maklumat_jantina->kira; echo $maklumat_jantina->kira; ?></td>
                                <td class="text-center"><?php $peratus = ($maklumat_jantina->kira/$bilangan_calon_negeri)*100;
                                $jumlah_peratusan = $jumlah_peratusan + $peratus;
                                $peratus = number_format($peratus, 2, '.', ','); 
                                echo $peratus; 
                                ?>%</td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan=2  class="text-center">JUMLAH</th>
                                <th class="text-center"><?php echo $jumlah_calon; ?></th>
                                <th class="text-center"><?php echo $jumlah_peratusan; ?>%</th>
                            </tr>
                        </table>
                        </div>
                        <p class="small text-muted">Peratusan dikira dengan keseluruhan calon dalam negeri <?php echo $negeri; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="p-3 border rounded">
                <h3>ANALISA JANGKAAN CALON PARLIMEN PRU15 MENGIKUT KAUM</h3>
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <canvas id="chart_kaum"></canvas>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered">
                            <tr>
                                <th class="text-center">BIL</th>
                                <th>KAUM</th>
                                <th class="text-center">BILANGAN CALON</th>
                                <th class="text-center">PERATUSAN</th>
                            </tr>
                            <?php 
                            $count = 1;
                            $jumlah_calon = 0;
                            $jumlah_peratusan = 0;
                            $senarai_kaum = array();
                            $bil_calon_kaum = array();
                            foreach($data_wcp->ikut_kaum($negeri) as $maklumat_kaum): 
                            array_push($senarai_kaum, $maklumat_kaum->wct_kaum);
                            array_push($bil_calon_kaum, $maklumat_kaum->kira);
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $count++; ?></td>
                                <td><?php echo $maklumat_kaum->wct_kaum; ?></td>
                                <td class="text-center"><?php $jumlah_calon = $jumlah_calon + $maklumat_kaum->kira; echo $maklumat_kaum->kira; ?></td>
                                <td class="text-center"><?php $peratus = ($maklumat_kaum->kira/$bilangan_calon_negeri)*100;
                                $jumlah_peratusan = $jumlah_peratusan + $peratus;
                                $peratus = number_format($peratus, 2, '.', ','); 
                                echo $peratus; 
                                ?>%</td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan=2  class="text-center">JUMLAH</th>
                                <th class="text-center"><?php echo $jumlah_calon; ?></th>
                                <th class="text-center"><?php echo $jumlah_peratusan; ?>%</th>
                            </tr>
                        </table>
                        </div>
                        <p class="small text-muted">Peratusan dikira dengan keseluruhan calon dalam negeri <?php echo $negeri; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="p-3 border rounded">
                <h3>ANALISA JANGKAAN CALON PARLIMEN PRU15 MENGIKUT PENYANDANG</h3>
                <div class="row g-3">
                    <div class="col-12 col-lg-6">
                        <canvas id="chart_penyandang"></canvas>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered">
                            <tr>
                                <th class="text-center">BIL</th>
                                <th>STATUS CALON</th>
                                <th class="text-center">BILANGAN CALON</th>
                                <th class="text-center">PERATUSAN</th>
                            </tr>
                            <?php 
                            $count = 1;
                            $senarai_status = array();
                            $bil_calon_status = array();
                            $jumlah_calon = 0;
                            $jumlah_peratusan = 0;
                            foreach($data_wcp->ikut_status($negeri) as $maklumat_status): 
                            array_push($senarai_status, $maklumat_status->wct_status_calon);
                            array_push($bil_calon_status, $maklumat_status->kira); ?>
                            <tr>
                                <td class="text-center"><?php echo $count++; ?></td>
                                <td><?php echo $maklumat_status->wct_status_calon; ?></td>
                                <td class="text-center"><?php $jumlah_calon = $jumlah_calon + $maklumat_status->kira; echo $maklumat_status->kira; ?></td>
                                <td class="text-center"><?php $peratus = ($maklumat_status->kira/$bilangan_calon_negeri)*100;
                                $jumlah_peratusan = $jumlah_peratusan + $peratus;
                                $peratus = number_format($peratus, 2, '.', ','); 
                                echo $peratus; ?>%</td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan=2  class="text-center">JUMLAH</th>
                                <th class="text-center"><?php echo $jumlah_calon; ?></th>
                                <th class="text-center"><?php echo $jumlah_peratusan; ?>%</th>
                            </tr>
                        </table>
                        </div>
                        <p class="small text-muted">Peratusan dikira dengan keseluruhan calon dalam negeri <?php echo $negeri; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('chart_parlimen').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($senarai_parlimen); ?>,
        datasets: [{
            label: 'Bilangan Calon',
            data: <?php echo json_encode($bil_calon_parlimen); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]
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
const ctx2 = document.getElementById('chart_parti').getContext('2d');
const myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($senarai_parti); ?>,
        datasets: [{
            label: 'Bilangan Calon',
            data: <?php echo json_encode($bil_calon_parti); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]
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

const ctx4 = document.getElementById('chart_kategori_umur').getContext('2d');
const myChart4 = new Chart(ctx4, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($senarai_kategori_umur); ?>,
        datasets: [{
            label: 'Bilangan Calon',
            data: <?php echo json_encode($bil_calon_umur); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]
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
const ctx6 = document.getElementById('chart_jantina').getContext('2d');
const myChart6 = new Chart(ctx6, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($senarai_jantina); ?>,
        datasets: [{
            label: 'Bilangan Calon',
            data: <?php echo json_encode($bil_calon_jantina); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]
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
const ctx7 = document.getElementById('chart_kaum').getContext('2d');
const myChart7 = new Chart(ctx7, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($senarai_kaum); ?>,
        datasets: [{
            label: 'Bilangan Calon',
            data: <?php echo json_encode($bil_calon_kaum); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]
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
const ctx5 = document.getElementById('chart_penyandang').getContext('2d');
const myChart5 = new Chart(ctx5, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($senarai_status); ?>,
        datasets: [{
            label: 'Bilangan Calon',
            data: <?php echo json_encode($bil_calon_status); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});
</script>
<?php } ?>