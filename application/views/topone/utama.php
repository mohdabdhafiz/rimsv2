<div class="container-fluid">
    <p class="text-end">ID: <?php echo strtoupper($this->session->userdata('pengguna_nama')); ?></p>
    <div class="p-3 border rounded mb-3">
        <h1 class="display-1">JANGKAAN CALON PARLIMEN PRU15</h1>
        <p class="small text-muted">Senarai Jangkaan Calon Parlimen PRU15 Seluruh Negara</p>
    </div>
<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="p-3 border rounded">
<?php $bilangan_calon = 0; 
$bilangan_calon = count($senarai_calon);
$bilangan_parlimen = count($data_parlimen->senarai());
if($bilangan_calon != 0){
?>

<div class="row g-3 mb-3" id="negeri">
<h2 class="display-2">PENCALONAN MENGIKUT NEGERI</h2>
    <div class="col">
        <canvas id="chart_rumusan_ikut_negeri"></canvas>
    </div>
    <div class="col">
<div class="table-responsive">
<table class="table table-hover table-bordered">
    <tr class="bg-secondary text-white">
        <th class="text-center" valign="middle">BIL</th>
        <th valign="middle">NEGERI</th>
        <th class="text-center" valign="middle">BILANGAN PARLIMEN</th>
        <th class="text-center" valign="middle">BILANGAN PENCALONAN</th>
    </tr>
    <?php 
    $count = 1;
    $jumlah_calon = 0;
    $jumlah_parlimen = 0;
    $senarai_negeri = array();
    $bil_calon_negeri = array();
    foreach($rumusan_ikut_negeri as $rumusan): 
    array_push($senarai_negeri, $rumusan->pt_negeri);
    array_push($bil_calon_negeri, $rumusan->kira);
    ?>
    <tr>
        <td class="text-center" valign="middle"><?php echo $count++; ?></td>
        <td valign="middle"><?php 
        $slug_negeri = url_title($rumusan->pt_negeri);
        echo anchor('winnable_candidate/maklumat_negeri/'.$slug_negeri, $rumusan->pt_negeri); 
        ?></td>
        <td class="text-center" valign="middle"><?php $bilangan_parlimen_negeri = count($data_parlimen->paparIkutNegeri($rumusan->pt_negeri)); 
        $jumlah_parlimen = $jumlah_parlimen + $bilangan_parlimen_negeri; 
        echo $bilangan_parlimen_negeri; ?></td>
        <td class="text-center" valign="middle"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
    </tr>
    <?php endforeach; ?>
    <tr class="bg-light">
        <th colspan=3 class="text-center" valign="middle">JUMLAH</th>
        <th class="text-center" valign="middle"><?php echo $jumlah_calon; ?></th>
    </tr>
</table>
</div>
    </div>
</div>




<div class="row g-3 mb-3" id="parti">
    <h2 class="display-2">PENCALONAN MENGIKUT PARTI</h2>
    <div class="col">
        <canvas id="chart_ikut_parti"></canvas>
    </div>
    <div class="col">
        <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr class="bg-secondary text-white">
                <th valign="middle" class="text-center">BIL</th>
                <th valign="middle">PARTI</th>
                <th valign="middle" class="text-center">BILANGAN PARLIMEN</th>
                <th valign="middle" class="text-center">BILANGAN PENCALONAN</th>
            </tr>
            <?php 
            $count = 1;
            $jumlah_calon = 0;
            $jumlah_peratusan = 0;
            $senarai_parti = array();
            $bil_calon_parti = array();
            foreach($ikut_parti as $rumusan): 
            array_push($senarai_parti, $data_parti->parti($rumusan->wct_parti_bil)->parti_singkatan);
            array_push($bil_calon_parti, $rumusan->kira);
            ?>
            <tr>
                <td class="text-center"><?php echo $count++; ?></td>
                <td><?php $nama_parti = $data_parti->parti($rumusan->wct_parti_bil)->parti_nama." (".$data_parti->parti($rumusan->wct_parti_bil)->parti_singkatan.")"; 
                echo anchor('winnable_candidate/maklumat_parti/'.$rumusan->wct_parti_bil, $nama_parti); ?></td>
                <td class="text-center" valign="middle"><?php 
                $bil_parti_parlimen = 0;
                $bil_parti_parlimen = count($data_wc->calon_parti($rumusan->wct_parti_bil));
                echo $bil_parti_parlimen;
                ?></td>
                <td class="text-center" valign="middle"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-light">
                <th colspan=3 class="text-center">JUMLAH</th>
                <th class="text-center"><?php echo $jumlah_calon; ?></th>
            </tr>
        </table>
        </div>
    </div>
</div>


<div class="row g-3 mb-3" id="umur">
    <h2 class="display-2">PENCALONAN MENGIKUT KATEGORI UMUR</h2>
    <div class="col">
        <canvas id="chart_ikut_umur"></canvas>
    </div>
    <div class="col">
        <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr class="bg-secondary text-white">
                <th valign="middle" class="text-center">BIL</th>
                <th valign="middle">KATEGORI UMUR</th>
                <th class="text-center" valign="middle">BILANGAN PARLIMEN</th>
                <th valign="middle" class="text-center">BILANGAN PENCALONAN</th>
            </tr>
            <?php 
            $count = 1;
            $jumlah_calon = 0;
            $jumlah_peratusan = 0;
            $senarai_umur = array();
            $bil_calon_umur = array();
            foreach($ikut_umur as $rumusan): 
            array_push($senarai_umur, $rumusan->wct_kategori_umur);
            array_push($bil_calon_umur, $rumusan->kira);
            ?>
            <tr>
                <td valign="middle" class="text-center"><?php echo $count++; ?></td>
                <td valign="middle"><?php echo $rumusan->wct_kategori_umur; ?></td>
                <td class="text-center" valign="middle"><?php
                $bil_umur_parlimen = 0;
                $bil_umur_parlimen = count($data_wc->calon_umur($rumusan->wct_kategori_umur));
                echo $bil_umur_parlimen;
                ?></td>
                <td valign="middle" class="text-center"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-light">
                <th valign="middle" colspan=3 class="text-center">JUMLAH</th>
                <th valign="middle" class="text-center"><?php echo $jumlah_calon; ?></th>
            </tr>
        </table>
        </div>
    </div>
</div>

<div class="row g-3 mb-3" id="jantina">
    <h2 class="display-2">PENCALONAN MENGIKUT JANTINA</h2>
    <div class="col">
        <canvas id="chart_ikut_jantina"></canvas>
    </div>
    <div class="col">
        <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr class="bg-secondary text-white">
                <th valign="middle" class="text-center">BIL</th>
                <th valign="middle">JANTINA</th>
                <th class="text-center">BILANGAN PARLIMEN</th>
                <th valign="middle" class="text-center">BILANGAN PENCALONAN</th>
            </tr>
            <?php 
            $count = 1;
            $jumlah_calon = 0;
            $jumlah_peratusan = 0;
            $senarai_jantina = array();
            $bil_calon_jantina = array();
            foreach($ikut_jantina as $rumusan): 
            array_push($senarai_jantina, $rumusan->wct_jantina);
            array_push($bil_calon_jantina, $rumusan->kira);
            ?>
            <tr>
                <td valign="middle" class="text-center"><?php echo $count++; ?></td>
                <td valign="middle"><?php echo $rumusan->wct_jantina; ?></td>
                <td class="text-center" valign="middle"><?php
                $bil_jantina_parlimen = 0;
                $bil_jantina_parlimen = count($data_wc->jantina_parlimen($rumusan->wct_jantina));
                echo $bil_jantina_parlimen;
                ?></td>
                <td valign="middle" class="text-center"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-light">
                <th valign="middle" colspan=3 class="text-center">JUMLAH</th>
                <th valign="middle" class="text-center"><?php echo $jumlah_calon; ?></th>
            </tr>
        </table>
        </div>
    </div>
</div>

<div class="row g-3 mb-3" id="kaum">
    <h2 class="display-2">PENCALONAN MENGIKUT KAUM</h2>
    <div class="col">
        <canvas id="chart_ikut_kaum"></canvas>
    </div>
    <div class="col">
        <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr class="bg-secondary text-white">
                <th valign="middle" class="text-center">BIL</th>
                <th valign="middle">KAUM</th>
                <th class="text-center" valign="middle">BILANGAN PARLIMEN</th>
                <th valign="middle" class="text-center">BILANGAN PENCALONAN</th>
            </tr>
            <?php 
            $count = 1;
            $jumlah_calon = 0;
            $jumlah_peratusan = 0;
            $senarai_kaum = array();
            $bil_calon_kaum = array();
            foreach($ikut_kaum as $rumusan): 
            array_push($senarai_kaum, $rumusan->wct_kaum);
            array_push($bil_calon_kaum, $rumusan->kira);
            ?>
            <tr>
                <td valign="middle" class="text-center"><?php echo $count++; ?></td>
                <td valign="middle"><?php echo $rumusan->wct_kaum; ?></td>
                <td class="text-center" valign="middle"><?php 
                $bil_kaum_parlimen = 0;
                $bil_kaum_parlimen = count($data_wc->kaum_parlimen($rumusan->wct_kaum));
                echo $bil_kaum_parlimen;
                ?></td>
                <td valign="middle" class="text-center"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-light">
                <th valign="middle" colspan=3 class="text-center">JUMLAH</th>
                <th valign="middle" class="text-center"><?php echo $jumlah_calon; ?></th>
            </tr>
        </table>
        </div>
    </div>
</div>

<div class="row g-3 mb-3" id="status">
    <h2 class="display-2">PENCALONAN MENGIKUT PENYANDANG ATAU BUKAN PENYANDANG</h2>
    <div class="col">
        <canvas id="chart_ikut_status"></canvas>
    </div>
    <div class="col">
        <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr class="bg-secondary text-white">
                <th valign="middle" class="text-center">BIL</th>
                <th valign="middle">STATUS CALON</th>
                <th class="text-center" valign="middle">BILANGAN PARLIMEN</th>
                <th valign="middle" class="text-center">BILANGAN PENCALONAN</th>
            </tr>
            <?php 
            $count = 1;
            $jumlah_calon = 0;
            $jumlah_peratusan = 0;
            $senarai_status = array();
            $bil_calon_status = array();
            foreach($ikut_status as $rumusan): 
            array_push($senarai_status, $rumusan->wct_status_calon);
            array_push($bil_calon_status, $rumusan->kira);
            ?>
            <tr>
                <td valign="middle" class="text-center"><?php echo $count++; ?></td>
                <td valign="middle"><?php echo $rumusan->wct_status_calon; ?></td>
                <td class="text-center" valign="middle">
                    <?php 
                    $bil_status_parlimen = 0;
                    $bil_status_parlimen = count($data_wc->status_parlimen($rumusan->wct_status_calon));
                    echo $bil_status_parlimen;
                    ?> 
                </td>
                <td valign="middle" class="text-center"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-light">
                <th valign="middle" colspan=3 class="text-center">JUMLAH</th>
                <th valign="middle" class="text-center"><?php echo $jumlah_calon; ?></th>
            </tr>
        </table>
        </div>
    </div>
</div>

<div class="row g-3">
    <h2 class="display-2">RUMUSAN ETNOGRAFI JaPen</h2>
    <div class="col">
        <canvas id="chart_etno"></canvas>
    </div>
    <div class="col">
        <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr class="bg-secondary text-white">
                <th valign="middle" class="text-center">BIL</th>
                <th valign="middle">STATUS GRADING</th>
                <th valign="middle" class="text-center">BILANGAN PARLIMEN</th>
                <th valign="middle" class="text-center">PERATUSAN</th>
            </tr>
            <?php 
            $count = 1;
            $jumlah_parlimen = 0;
            $jumlah_peratusan = 0;
            $senarai_grading = array();
            $bil_parlimen = array();
            foreach($ikut_grading as $rumusan): 
            array_push($senarai_grading, $rumusan->harian_parlimen_grading);
            array_push($bil_parlimen, $rumusan->kira);
            ?>
            <tr>
                <td class="text-center"><?php echo $count++; ?></td>
                <td><?php  
                echo $rumusan->harian_parlimen_grading; ?></td>
                <td class="text-center"><?php 
                $bil_grading_parlimen = 0;
                $bil_grading_parlimen = count($data_grading->grading_parlimen($rumusan->harian_parlimen_grading));
                $jumlah_parlimen = $jumlah_parlimen + $bil_grading_parlimen; echo $bil_grading_parlimen; ?></td>
                <td class="text-center"><?php $peratus = ($bil_grading_parlimen/$bilangan_parlimen)*100;
                $jumlah_peratusan = $jumlah_peratusan + $peratus;
                $peratus = number_format($peratus, 2, '.', ','); 
                echo $peratus; ?>%</td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="mt-3 p-3 border rounded bg-warning">
            <p><strong>Nota:</strong></p>
            <p>Senarai Parti Yang Diambil Kira</p>
            <ul>
                <li>BN</li>
                <li>GPS</li>
            </ul>
        </div>
        </div>
    </div>
</div>

<?php } ?>
</div>


</div>



</div>

</div>

<script>
const ctx = document.getElementById('chart_rumusan_ikut_negeri').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($senarai_negeri); ?>,
        datasets: [{
            label: 'Bilangan Pencalonan',
            data: <?php echo json_encode($bil_calon_negeri); ?>,
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

const ctx1 = document.getElementById('chart_ikut_parti').getContext('2d');
const myChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($senarai_parti); ?>,
        datasets: [{
            label: 'Bilangan Pencalonan',
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
        },
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});


const ctx3 = document.getElementById('chart_ikut_umur').getContext('2d');
const myChart3 = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($senarai_umur); ?>,
        datasets: [{
            label: 'Bilangan Pencalonan',
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
        },
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});

const ctx5 = document.getElementById('chart_ikut_jantina').getContext('2d');
const myChart5 = new Chart(ctx5, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($senarai_jantina); ?>,
        datasets: [{
            label: 'Bilangan Pencalonan',
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
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});

const ctx6 = document.getElementById('chart_ikut_kaum').getContext('2d');
const myChart6 = new Chart(ctx6, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($senarai_kaum); ?>,
        datasets: [{
            label: 'Bilangan Pencalonan',
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
        },
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});

const ctx4 = document.getElementById('chart_ikut_status').getContext('2d');
const myChart4 = new Chart(ctx4, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($senarai_status); ?>,
        datasets: [{
            label: 'Bilangan Pencalonan',
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
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});

const ctx7 = document.getElementById('chart_etno').getContext('2d');
const myChart7 = new Chart(ctx7, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($senarai_grading); ?>,
        datasets: [{
            label: 'Grading',
            data: <?php echo json_encode($bil_parlimen); ?>,
            backgroundColor: [
                '#FFFFFF',
                '#BEBEBE',
                '#696969',
                '#000000'
            ],
            borderColor: [
                '#696969'
            ],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});

</script>