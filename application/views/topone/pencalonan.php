
    <div class="p-3 border rounded mb-3">
        <h1 class="display-1"><?= strtoupper($pru->pilihanraya_nama) ?></h1>
        <p class="small text-muted">Senarai Calon Parlimen PRU15 Seluruh Negara</p>
    </div>
<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="p-3 border rounded">
<?php $bilangan_calon = 0; 
$bilangan_calon = count($senarai_calon);
if($pru->pilihanraya_jenis == 'PARLIMEN'){
    $bilangan_parlimen = count($data_parlimen->senarai_parlimen_pilihanraya($pru->pilihanraya_bil));

}

if($pru->pilihanraya_jenis == 'DUN'){
    $bilangan_parlimen = count($data_dun->senarai_dun_pilihanraya($pru->pilihanraya_bil));
}

if($bilangan_calon != 0){
?>

<?php if($pru->pilihanraya_jenis == 'PARLIMEN'){ ?>
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
        <th class="text-center" valign="middle">BILANGAN PARLIMEN / DUN</th>
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
        $negeri_bil = $data_negeri->negeri_nama($rumusan->pt_negeri);
        echo anchor('laporan/maklumat_negeri_pru/'.$negeri_bil->nt_bil, $negeri_bil->nt_nama); 
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
<?php } ?>

<?php $senarai_penjuru = array();
            $bilangan_penjuru = array();
            ?>
<div class="row g-3 mb-3" id="penjuru">
    <h2 class="display-2">PENJURU</h2>
    <div class="col">
        <canvas id="chart_penjuru"></canvas>
    </div>
    <div class="col">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tr class="bg-secondary text-white">
                    <th class="text-center" valign="middle">PENJURU</th>
                    <th class="text-center" valign="middle">BILANGAN PARLIMEN / DUN</th>
                </tr>
                <?php 
                $penjuru_simpan = array();
                foreach($penjuru as $pen):
                    if(!in_array($pen->kira, $penjuru_simpan)){
                        array_push($penjuru_simpan, $pen->kira);
                    } 
                    ?>
                <?php endforeach; ?>
                <?php 
                array_multisort($penjuru_simpan, SORT_DESC);
                foreach($penjuru_simpan as $ps): 
                    $penjuru_parlimen = $data_wc->bilangan_penjuru($ps, $pru->pilihanraya_bil);
                array_push($senarai_penjuru, $ps);
                array_push($bilangan_penjuru, $penjuru_parlimen);?>
                <tr>
                    <td class="text-center" valign="middle"><?= $ps ?></td>
                    <td class="text-center" valign="middle"><?php echo $penjuru_parlimen; ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <th  class="text-center" valign="middle">JUMLAH</th>
                    <th  class="text-center" valign="middle"><?= count($penjuru) ?></th>
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
                <th valign="middle" class="text-center">BILANGAN PENCALONAN</th>
            </tr>
            <?php 
            $count = 1;
            $jumlah_calon = 0;
            $jumlah_peratusan = 0;
            $senarai_parti = array();
            $bil_calon_parti = array();
            foreach($ikut_parti as $rumusan): 
                if($pru->pilihanraya_jenis == 'PARLIMEN'){
                    $parti_singkatan = $data_parti->parti($rumusan->pencalonan_parlimen_partiBil)->parti_singkatan;
                    $parti_bil = $rumusan->pencalonan_parlimen_partiBil;
                }
                if($pru->pilihanraya_jenis == 'DUN'){
                    $parti_singkatan = $data_parti->parti($rumusan->pencalonan_parti)->parti_singkatan;
                    $parti_bil = $rumusan->pencalonan_parti;
                }
            array_push($senarai_parti, $parti_singkatan);
            array_push($bil_calon_parti, $rumusan->kira);
            ?>
            <tr>
                <td class="text-center" valign='middle'><?php echo $count++; ?></td>
                <td>
                    <div class="d-flex justify-content-between align-items-center">
                        <?php $nama_parti = $data_parti->parti($parti_bil)->parti_nama." (".$data_parti->parti($parti_bil)->parti_singkatan.")"; 
                    //echo anchor('pencalonan/maklumat_parti/'.$parti_bil, $nama_parti); 
                    echo $nama_parti;
                    ?>
                    <?= form_open('laporan/senaraiIkutPruParti') ?>
                        <input type="hidden" name="inputPartiBil" value="<?= $parti_bil ?>">
                        <input type="hidden" name="inputPilihanrayaBil" value="<?= $pru->pilihanraya_bil ?>">
                        <button type="submit" class="btn btn-outline-primary shadow-sm">Lihat</button>                    
                    </form>
                    </div>
                </td>
                <td class="text-center" valign="middle"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-light">
                <th colspan=2 class="text-center">JUMLAH</th>
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
                <th valign="middle" class="text-center">BILANGAN PENCALONAN</th>
            </tr>
            <?php 
            $count = 1;
            $jumlah_calon = 0;
            $jumlah_peratusan = 0;
            $senarai_umur = array();
            $bil_calon_umur = array();
            foreach($ikut_umur as $rumusan): 
            array_push($senarai_umur, $rumusan->ahli_umur);
            array_push($bil_calon_umur, $rumusan->kira);
            ?>
            <tr>
                <td valign="middle" class="text-center"><?php echo $count++; ?></td>
                <td valign="middle"><?php echo $rumusan->ahli_umur; ?></td>
                <td valign="middle" class="text-center"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-light">
                <th valign="middle" colspan=2 class="text-center">JUMLAH</th>
                <th valign="middle" class="text-center"><?php echo $jumlah_calon; ?></th>
            </tr>
        </table>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    <h2 class="display-2">CALON TERTUA DAN TERMUDA</h2>
    <div class="col">
        <div class="row g-3">
            <?php foreach($senarai_calon_tua as $st): ?>
            <div class="col">
        <div class="p-3 border rounded text-center">
        <?php $nama_foto = $data_foto->foto($st->ahli_foto); ?>
        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/>
        <h3>CALON TERTUA</h3>
        <p><strong><?= strtoupper($st->ahli_nama) ?></strong></p>
        <p><?= $st->ahli_umur ?></p>
        <p><?= $st->ahli_jantina ?></p>
        <?php if($pru->pilihanraya_jenis == 'PARLIMEN'){
            $nama_kawasan = $st->pencalonan_parlimen_parlimenNama;
        }
        if($pru->pilihanraya_jenis == 'DUN'){
            $kawasan = $data_dun->dun_bil($st->pencalonan_dun);
            $nama_kawasan = $kawasan->dun_nama;
        }
        ?>
        <p><?= strtoupper($nama_kawasan) ?></p>
        </div>
        </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="col">
        <div class="row g-3">
            <?php foreach($senarai_calon_muda as $st): ?>
            <div class="col">
        <div class="p-3 border rounded text-center">
        <?php $nama_foto = $data_foto->foto($st->ahli_foto); ?>
        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/>
        <h3>CALON MUDA</h3>
        <p><strong><?= strtoupper($st->ahli_nama) ?></strong></p>
        <p><?= $st->ahli_umur ?></p>
        <p><?= $st->ahli_jantina ?></p>
        <?php 
        if($pru->pilihanraya_jenis == 'PARLIMEN'){
            $kawasan = $data_parlimen->parlimen_bil($st->pencalonan_parlimen_parlimenBil);
            $nama_kawasan = $kawasan->pt_nama;
        }
        if($pru->pilihanraya_jenis == 'DUN'){
            $kawasan = $data_dun->dun_bil($st->pencalonan_dun);
            $nama_kawasan = $kawasan->dun_nama;
        }
        ?>
        <p><?= strtoupper($nama_kawasan) ?></p>
        </div>
        </div>
        <?php endforeach; ?>
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
                <th valign="middle" class="text-center">BILANGAN PENCALONAN</th>
            </tr>
            <?php 
            $count = 1;
            $jumlah_calon = 0;
            $jumlah_peratusan = 0;
            $senarai_jantina = array();
            $bil_calon_jantina = array();
            foreach($ikut_jantina as $rumusan): 
            array_push($senarai_jantina, $rumusan->ahli_jantina);
            array_push($bil_calon_jantina, $rumusan->kira);
            ?>
            <tr>
                <td valign="middle" class="text-center"><?php echo $count++; ?></td>
                <td valign="middle"><?php echo $rumusan->ahli_jantina; ?></td>
                <td valign="middle" class="text-center"><?php $jumlah_calon = $jumlah_calon + $rumusan->kira; echo $rumusan->kira; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="bg-light">
                <th valign="middle" colspan=2 class="text-center">JUMLAH</th>
                <th valign="middle" class="text-center"><?php echo $jumlah_calon; ?></th>
            </tr>
        </table>
        </div>
    </div>
</div>

<div class="row g-3">
    <h2 class="display-2">RUMUSAN ETNOGRAFI</h2>
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
                if($pru->pilihanraya_jenis == 'PARLIMEN'){
                    $grading = $rumusan->harian_parlimen_grading;
                }
                if($pru->pilihanraya_jenis == 'DUN'){
                    $grading = $rumusan->harian_grading;
                }
            array_push($senarai_grading, $grading);
            array_push($bil_parlimen, $rumusan->kira);
            ?>
            <tr>
                <td class="text-center"><?php echo $count++; ?></td>
                <td><?php  
                echo $grading; ?></td>
                <td class="text-center"><?php 
                $bil_grading_parlimen = 0;
                $senarai_penuh_grading = $data_grading->senarai_grading_penuh($pru->pilihanraya_bil);
                if($pru->pilihanraya_jenis == 'PARLIMEN'){
                    foreach($senarai_penuh_grading as $sp){
                        if($sp->harian_parlimen_grading == $grading){
                            $bil_grading_parlimen++;
                        }
                    }
                }
                if($pru->pilihanraya_jenis == 'DUN'){
                    foreach($senarai_penuh_grading as $sp){
                        if($sp->harian_grading == $grading){
                            $bil_grading_parlimen++;
                        }
                    }
                }
                echo $bil_grading_parlimen; ?></td>
                <td class="text-center"><?php $peratus = ($bil_grading_parlimen/$bilangan_parlimen)*100;
                $jumlah_peratusan = $jumlah_peratusan + $peratus;
                $peratus = number_format($peratus, 2, '.', ','); 
                echo $peratus; ?>%</td>
            </tr>
            <?php endforeach; ?>
        </table>
        </div>
    </div>
</div>


<div class="row g-3 my-3">
    <?php $senarai_penuh_grading = $data_grading->senarai_grading_penuh($pru->pilihanraya_bil); ?>
    <?php foreach($ikut_grading as $ik): ?>
    <div class="col-12 col-lg-3">
        <div class="p-3 border rounded">
            <?php 
            if($pru->pilihanraya_jenis == 'PARLIMEN'){
                $grading2 = $ik->harian_parlimen_grading;
            }
            if($pru->pilihanraya_jenis == 'DUN'){
                $grading2 = $ik->harian_grading;
            }
            ?>
        <h2><?= $grading2 ?></h2>
        <?php if($pru->pilihanraya_jenis == 'PARLIMEN') { ?>
        <ul>
        <?php
        foreach($senarai_penuh_grading as $sg): 
            if($sg->harian_parlimen_grading == $grading2){?>
            <li><?= $data_parlimen->parlimen_bil($sg->harian_parlimen_parlimen)->pt_nama ?></li>
            <?php } endforeach; ?>
        </ul>
        <?php } ?>
        <?php if($pru->pilihanraya_jenis == 'DUN') { ?>
        <ul>
        <?php
        foreach($senarai_penuh_grading as $sg): 
            if($sg->harian_grading == $grading2){
                $dun = $data_dun->dun_bil($sg->harian_dun); 
                if(!empty($dun)){
                    $nama_dun = $dun->dun_nama;
                }else{
                    $nama_dun = "";
                } ?>
            <li><?= $nama_dun ?></li>
            <?php } endforeach; ?>
        </ul>
        <?php } ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php } ?>
</div>


</div>



</div>



<script>

<?php if($pru->pilihanraya_jenis == 'PARLIMEN'): ?>
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
<?php endif; ?>

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
    }
});

const ctx8 = document.getElementById('chart_penjuru').getContext('2d');
const myChart8 = new Chart(ctx8, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($senarai_penjuru); ?>,
        datasets: [{
            label: 'Bilangan Penjuru',
            data: <?php echo json_encode($bilangan_penjuru); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
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