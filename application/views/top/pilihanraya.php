<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $pr->pilihanraya_singkatan ?></li>
  </ol>
</nav>

<div class="mb-3">
    <?php $this->load->view('top/nav'); ?>
</div>

<div class="p-3 border rounded mb-3">
    <p><strong><?= $pr->pilihanraya_nama ?></strong></p>
    <div class="table-responsive">
      <table class="table table-sm table-bordered table-striped">
        <tr>
          <th>Nama Pilihan Raya</th>
          <td><?= $pr->pilihanraya_nama ?></td>
</tr>
<tr>
          <th>Singkatan Pilihan Raya</th>
          <td><?= $pr->pilihanraya_singkatan ?></td>
</tr>
<tr>
          <th>Tahun</th>
          <td><?= $pr->pilihanraya_tahun ?></td>
</tr>
<tr>
          <th>Tarikh Penamaan Calon</th>
          <td><?= $pr->pilihanraya_penamaan_calon ?></td>
</tr>
<tr>
          <th>Tarikh Lock Status</th>
          <td><?= $pr->pilihanraya_lock_status ?></td>
</tr>
<tr>
          <th>Jenis Pilihan Raya</th>
          <td><?= $pr->pilihanraya_jenis ?></td>
</tr>
      </table>
    </div>
</div>

<?php
$kedudukanSemasa = array();
if($pr->pilihanraya_jenis == 'DUN'){
  $senaraiPartiBertanding = $dataCalonDun->senarai_parti_pilihanraya($pr->pilihanraya_bil);
  $senaraiDunBertanding = $dataPr->senaraiDun($pr->pilihanraya_bil);
}

if(!empty($senaraiPartiBertanding)){

  function declareKedudukan($bilParti, $namaParti, $singkatanParti, $bilanganKerusi, $dataParti){
    $k = array();
    $tmpParti = $dataParti->parti($bilParti);
    $pw = $tmpParti->parti_warna;
    $array_pw = array();
    $array_pw = explode(";", $pw);
    $array_pw_1 = array();
    $array_pw_1 = explode(":", $array_pw[0]);
    $warnaParti = 'rgba(255, 99, 132, 1)';
    if(!empty($array_pw_1[1])){
      $warnaParti = $array_pw_1[1];
    }
    $k = array(
      'bilParti' => $bilParti,
      'namaParti' => $namaParti,
      'singkatanParti' => $singkatanParti,
      'bilanganKerusi' => $bilanganKerusi,
      'warnaParti' => $warnaParti
    );
    return $k;
  }

  foreach($senaraiPartiBertanding as $partiBertanding){
    $kedudukan = array();
    $bilanganKerusi = $dataHarian->harianParti($partiBertanding->parti_bil, $pr->pilihanraya_bil);
    $ke = declareKedudukan($partiBertanding->parti_bil, $partiBertanding->parti_nama, $partiBertanding->parti_singkatan, count($bilanganKerusi), $dataParti);
    $kedudukan = array($ke);
    $kedudukanSemasa = array_merge($kedudukanSemasa, $kedudukan);
  }
}
?>

<?php if(!empty($kedudukanSemasa)): 
  $tempBilanganKerusi = array();
  foreach($kedudukanSemasa as $ks){
    $tempBilanganKerusi[] = $ks['bilanganKerusi'];
  }
  array_multisort($tempBilanganKerusi, SORT_DESC, $kedudukanSemasa);
  ?>
<div class="p-3 border rounded mb-3">
  <p><strong>Etnografi JaPen</strong></p>
  <div class="row g-3">
    <div class="col">
        <canvas id="kedudukan_semasa"></canvas>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if($pr->pilihanraya_jenis == 'DUN'): ?>
<div class="p-3 border rounded mb-3">
  <p><strong>Senarai DUN</strong></p>
  <div class="table-responsive">
    <table class="table table-sm">
      <tr>
        <th>#</th>
        <th>DUN</th>
        <th>Parti Menang</th>
      </tr>
      <?php 
      $bilangan = 1;
      foreach($senaraiDunBertanding as $dun): ?>
      <tr>
        <td><?= $bilangan++ ?></td>
        <td><?= $dun->dun_nama ?></td>
        <td>
          <?php
          $pemenangDun = $dataGrading->menangDun($dun->dun_bil, $pr->pilihanraya_bil);
          if(!empty($pemenangDun)){
            $parti = $dataParti->parti($pemenangDun->pencalonan_parti);
            echo $parti->parti_nama." (".$parti->parti_singkatan.")";
          }
          ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<?php endif; ?>



<script>
  <?php
$tmpSenaraiParti = array();
$tmpBilanganKerusi = array();
foreach($kedudukanSemasa as $k){
  $tmpSenaraiParti[] = $k['singkatanParti'];
  $tmpBilanganKerusi[] = $k['bilanganKerusi'];
  $tmpWarnaParti[] = $k['warnaParti'];
}
  ?>
const ctx = document.getElementById('kedudukan_semasa').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($tmpSenaraiParti); ?>,
        datasets: [{
            label: 'Bilangan Kerusi',
            data: <?php echo json_encode($tmpBilanganKerusi); ?>,
            backgroundColor: <?php echo json_encode($tmpWarnaParti); ?>
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