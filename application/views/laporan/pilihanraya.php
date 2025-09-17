<?php foreach($senaraiPilihanraya as $pr):
    ?>
<div class="mb-3">
<h1>Laporan <?php echo $pr->pilihanraya_nama; ?></h1>
</div>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="utama-tab" data-bs-toggle="tab" data-bs-target="#utama" type="button" role="tab" aria-controls="utama" aria-selected="true">Utama</button>
  </li>
    <?php if($senaraiParlimenPencalonan){ ?>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="parlimen-tab" data-bs-toggle="tab" data-bs-target="#parlimen" type="button" role="tab" aria-controls="parlimen" aria-selected="true">Analisa Parlimen</button>
  </li>
  <?php } ?>
  <?php if($senaraiDUNPencalonan){ ?>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="dun-tab" data-bs-toggle="tab" data-bs-target="#dun" type="button" role="tab" aria-controls="dun" aria-selected="false">Analisa DUN</button>
  </li>
  <?php } ?>
</ul>
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="utama" role="tabpanel" aria-labelledby="utama-tab">
    <?php $this->load->view('laporan/utama'); ?>
  </div>
<?php if($senaraiParlimenPencalonan){ ?>
  <div class="tab-pane fade" id="parlimen" role="tabpanel" aria-labelledby="parlimen-tab">
    <?php $this->load->view('laporan/parlimen_analisa'); ?>
  </div>
  <?php } ?>
  <?php if($senaraiDUNPencalonan){ ?>
  <div class="tab-pane fade" id="dun" role="tabpanel" aria-labelledby="dun-tab">
    <?php $this->load->view('laporan/dun_analisa'); ?>
  </div>
  <?php } ?>
</div>
<?php endforeach; ?>


