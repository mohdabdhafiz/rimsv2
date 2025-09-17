<div class="p-3 mb-3">
    <p><strong>Calibration</strong></p>
    <ol>
        <li><?= anchor('admin/tambahNegeri', 'Negeri setiap laporan - tambah column') ?></li>
        <li><?= anchor('admin/tambahKodLaporan', 'Kod Laporan - tambah column') ?></li>
        <li><?= anchor('admin/ikutPelapor', 'Tambah column negeri ikut pelapor') ?></li>
    </ol>
</div>

<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="p-3 border rounded">
<?php $bilangan_calon = 0; 
$bilangan_calon = count($senarai_calon);
if($bilangan_calon != 0){
?>
<h3>JANGKAAN CALON PARLIMEN PRU15</h3>
<p><strong>RUMUSAN MENGIKUT NEGERI</strong></p>
<div class="row g-3 mb-3">
    <div class="col">
        <canvas id="chart_rumusan_ikut_negeri"></canvas>
    </div>
    <div class="col">
<div class="table-responsive">
<table class="table table-hover table-bordered">
    <tr>
        <th class="text-center">BIL</th>
        <th>NEGERI</th>
        <th class="text-center">BILANGAN CALON</th>
        <th class="text-center">PERATUSAN</th>
    </tr>
    <?php 
    $count = 1;
    $jumlah_calon = 0;
    $jumlah_peratusan = 0;
    $senarai_negeri = array();
    $bil_calon_negeri = array();
    foreach($rumusan_ikut_negeri as $rumusan): 
    array_push($senarai_negeri, $rumusan->pt_negeri);
    array_push($bil_calon_negeri, $rumusan->kira);
    ?>
    <tr>
        <td class="text-center"><?php echo $count++; ?></td>
        <td><?php echo $rumusan->pt_negeri; ?></td>
        <td class="text-center"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
        <td class="text-center"><?php $peratus = ($rumusan->kira/$bilangan_calon)*100;
        $jumlah_peratusan = $jumlah_peratusan + $peratus;
        $peratus = number_format($peratus, 2, '.', ','); 
        echo $peratus; ?>%</td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th colspan=2 class="text-center">JUMLAH</th>
        <th class="text-center"><?php echo $jumlah_calon; ?></th>
        <th class="text-center"><?php echo number_format($jumlah_peratusan, 2, '.', ','); ?>%</th>
    </tr>
</table>
</div>
    </div>
</div>

<div class="row g-3 mb-3">
    <p><strong>RUMUSAN MENGIKUT PARTI</strong></p>
    <div class="col">
        <canvas id="chart_ikut_parti"></canvas>
    </div>
    <div class="col">
        <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>BIL</th>
                <th>PARTI</th>
                <th>BILANGAN CALON</th>
                <th>PERATUSAN</th>
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
                <td><?php echo $data_parti->parti($rumusan->wct_parti_bil)->parti_nama; ?> (<?php echo $data_parti->parti($rumusan->wct_parti_bil)->parti_singkatan;?>)</td>
                <td class="text-center"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
                <td class="text-center"><?php $peratus = ($rumusan->kira/$bilangan_calon)*100;
                $jumlah_peratusan = $jumlah_peratusan + $peratus;
                $peratus = number_format($peratus, 2, '.', ','); 
                echo $peratus; ?>%</td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan=2 class="text-center">JUMLAH</th>
                <th class="text-center"><?php echo $jumlah_calon; ?></th>
                <th class="text-center"><?php echo number_format($jumlah_peratusan, 2, '.', ','); ?>%</th>
            </tr>
        </table>
        </div>
    </div>
</div>


<div class="row g-3 mb-3">
    <p><strong>RUMUSAN MENGIKUT KATEGORI UMUR</strong></p>
    <div class="col">
        <canvas id="chart_ikut_umur"></canvas>
    </div>
    <div class="col">
        <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>BIL</th>
                <th>KATEGORI UMUR</th>
                <th>BILANGAN CALON</th>
                <th>PERATUSAN</th>
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
                <td class="text-center"><?php echo $count++; ?></td>
                <td><?php echo $rumusan->wct_kategori_umur; ?></td>
                <td class="text-center"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
                <td class="text-center"><?php $peratus = ($rumusan->kira/$bilangan_calon)*100;
                $jumlah_peratusan = $jumlah_peratusan + $peratus;
                $peratus = number_format($peratus, 2, '.', ','); 
                echo $peratus; ?>%</td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan=2 class="text-center">JUMLAH</th>
                <th class="text-center"><?php echo $jumlah_calon; ?></th>
                <th class="text-center"><?php echo number_format($jumlah_peratusan, 2, '.', ','); ?>%</th>
            </tr>
        </table>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <p><strong>RUMUSAN MENGIKUT STATUS CALON (PENYANDANG ATAU BUKAN PENYANDANG)</strong></p>
    <div class="col">
        <canvas id="chart_ikut_status"></canvas>
    </div>
    <div class="col">
        <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <tr>
                <th>BIL</th>
                <th>STATUS CALON</th>
                <th>BILANGAN CALON</th>
                <th>PERATUSAN</th>
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
                <td class="text-center"><?php echo $count++; ?></td>
                <td><?php echo $rumusan->wct_status_calon; ?></td>
                <td class="text-center"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
                <td class="text-center"><?php $peratus = ($rumusan->kira/$bilangan_calon)*100;
                $jumlah_peratusan = $jumlah_peratusan + $peratus;
                $peratus = number_format($peratus, 2, '.', ','); 
                echo $peratus; ?>%</td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan=2 class="text-center">JUMLAH</th>
                <th class="text-center"><?php echo $jumlah_calon; ?></th>
                <th class="text-center"><?php echo number_format($jumlah_peratusan, 2, '.', ','); ?>%</th>
            </tr>
        </table>
        </div>
    </div>
</div>

<?php } ?>
</div>



</div>
<div class="col">
    <div class="p-3 rounded border">
        <h3>SENARAI PILIHAN RAYA</h3>

<div class="row g-3">

<?php foreach($senarai_pilihanraya as $pr): ?>
<div class="col col-lg-4">
    <div class="p-3 border rounded">
        <h2><?php echo $pr->pilihanraya_nama; ?></h2>
            <?php echo anchor('pilihanraya/maklumat/'.$pr->pilihanraya_bil, 'Maklumat Umum', "class='btn btn-primary w-100 mt-5 mb-3'"); ?>
            <?php echo anchor('pilihanraya/grading/'.$pr->pilihanraya_bil, 'SISMAP', "class='btn btn-secondary w-100 mb-3'"); ?>
        <?php echo anchor('laporan/pilihanraya/'.$pr->pilihanraya_bil, 'Laporan', "class = 'btn btn-info w-100'"); ?>
    </div>
</div>
<?php endforeach; ?>


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
            label: 'Bilangan Calon',
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