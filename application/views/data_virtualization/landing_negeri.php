<?php 
$senarai_pru_parlimen = array();
$senarai_pru_dun = array();
//$senarai_parlimen_ikut_negeri = $data_parlimen->negeri($negeri);
$senarai_pilihanraya = $data_pilihanraya->negeri_pr_aktif($negeri);
foreach($senarai_pilihanraya as $pilihanraya){
    if(!in_array($pilihanraya->ppt_pilihanraya_bil, $senarai_pru_parlimen)){
        array_push($senarai_pru_parlimen, $pilihanraya->ppt_pilihanraya_bil);
    }
}

$senarai_pilihanraya_dun = $data_pilihanraya->negeri_dun_aktif($negeri);
foreach($senarai_pilihanraya_dun as $pilihanraya){
    if(!in_array($pilihanraya->pdt_pilihanraya_bil, $senarai_pru_dun)){
        array_push($senarai_pru_dun, $pilihanraya->pdt_pilihanraya_bil);
    }
}

if(empty($senarai_pru_parlimen) && empty($senarai_pru_dun)){
    redirect(base_url());
}
?>
      <div class="container-fluid">
        <div class="d-flex justify-content-end mb-3">
            <?php echo form_open('data_virtualization/pilih_pilihanraya'); ?>
            <div class="row g-3">
                <div class="col-12 col-lg-8">
            <select name="input_pilihanraya_bil" id="input_pilihanraya_bil" class="form-control">
                <?php foreach($senarai_pru_parlimen as $p): 
                    $pr = $data_pilihanraya->pilihanraya($p); ?>
                <option value="<?php echo $pr->pilihanraya_bil; ?>" <?php if($pr->pilihanraya_bil == $pru->pilihanraya_bil){ echo "selected"; } ?>><?php echo $pr->pilihanraya_nama; ?></option>
                <?php endforeach; ?>
                <?php foreach($senarai_pru_dun as $d): 
                    $pr = $data_pilihanraya->pilihanraya($d); ?>
                <option value="<?php echo $pr->pilihanraya_bil; ?>" <?php if($pr->pilihanraya_bil == $pru->pilihanraya_bil){ echo "selected"; } ?>><?php echo $pr->pilihanraya_nama; ?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <div class="col-12 col-lg-4">
            <button type="submit" class="btn btn-primary w-100">Pilih</button>
            </div>
            </div>
            </form>
        </div>
        <p class="text-muted small text-end ">PILIHAN RAYA ID: <?php echo $pru->pilihanraya_bil; ?></p>
          <div class="row text-center">
          <h1 class="display-1"><?php echo strtoupper($pru->pilihanraya_nama); ?></h1>
          </div>
          

          <?php 
          $s_penjuru = array();
          $b_penjuru = array();
          ?>
          <div class="row g-1">
              <div class="col-6 mb-4">
                    <h2 class="display-4">Penjuru</h2>
                    <canvas id="chart_penjuru" width="200" height="200" class="mb-3"></canvas>
                </div>
                    <?php 
                    $penjuru = "";
                    if($pru->pilihanraya_jenis == "PARLIMEN"){
                        $penjuru = $data_pencalonan_parlimen->penjuru($pru->pilihanraya_bil);  
                    }
                    if($pru->pilihanraya_jenis == "DUN"){
                        //$penjuru = $data_pencalonan_dun->kira_penjuru($pru->pilihanraya_bil);  
                    }
                    if(!empty($penjuru)) { 
                        $senarai_penjuru = array(); 
                        foreach($penjuru as $pen){
                            if(!in_array($pen->kira, $senarai_penjuru)){
                                array_push($senarai_penjuru, $pen->kira);
                            }
                        }
                        ?>
    <div class="col-6 mb-3">
        <div class="card p-3">
            <h2>Senarai Penjuru</h2>
            <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>BIL</th>
                    <th>BILANGAN PENJURU</th>
                    <th>BILANGAN PARLIMEN</th>
                </tr>
                <?php $count = 1; 
                array_multisort($senarai_penjuru, SORT_ASC);
                foreach($senarai_penjuru as $senarai): 
                array_push($s_penjuru, $senarai)?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $senarai; ?> PENJURU</td>
                            <td><?php $k = count($data_pencalonan_parlimen->bilangan_penjuru($senarai, $pru->pilihanraya_bil)); 
                            array_push($b_penjuru, $k);
                            echo $k; ?></td>
                        </tr>
                        <?php 
                endforeach; ?>
            </table>
            </div>
        </div>
    </div>
<?php }else{ ?>

    <div class="col-12 mb-3">
            <div class="card p-3 pb-0 bg-info text-white text-center">
                <p>TIADA PENCALONAN DIBUAT</p>
            </div>
        </div>

    <?php } ?>
              </div>

              <div class="col-12 mb-4">
                    <h2 class="display-4">Parti Bertanding</h2>
                    <div class="flourish-embed flourish-cards" data-src="visualisation/8544576"><script src="https://public.flourish.studio/resources/embed.js"></script></div>
              </div>

              <div class="col-lg-12 col-sm-6 mb-4">
                    <h2 class="display-4">Julat Umur Calon</h2>
                    <div class="flourish-embed flourish-chart" data-src="visualisation/8544591"><script src="https://public.flourish.studio/resources/embed.js"></script></div>
              </div>

              <div class="col-lg-12 col-sm-6 mb-4">
                    <h2 class="display-4">Rumusan Umur Calon</h2>
                    <div class="row">
                        <div class="col-6">
                            <h3>Calon Tertua</h3>
                            <div class="flourish-embed flourish-cards" data-src="visualisation/8544593"><script src="https://public.flourish.studio/resources/embed.js"></script></div>
                        </div>
                        <div class="col-6">
                            <h3>Calon Termuda</h3>
                            <div class="flourish-embed flourish-cards" data-src="visualisation/8544594"><script src="https://public.flourish.studio/resources/embed.js"></script></div>
                        </div>
                    </div>
              </div>

              <div class="col-12 mb-4">
                    <h2 class="display-4">Jantina Calon</h2>
                    <div class="flourish-embed flourish-chart" data-src="visualisation/8544596"><script src="https://public.flourish.studio/resources/embed.js"></script></div>
              </div>

          </div>
      </div>




      <script>
const ctx = document.getElementById('chart_penjuru').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($s_penjuru); ?>,
        datasets: [{
            label: 'Bilangan Penjuru',
            data: <?php echo json_encode($b_penjuru); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        indexAxis: 'y',
    }
});
</script>      