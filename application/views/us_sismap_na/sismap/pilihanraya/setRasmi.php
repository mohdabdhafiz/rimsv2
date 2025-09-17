<?php 
$this->load->view('us_sismap_na/susunletak/atas');
$this->load->view('us_sismap_na/susunletak/sidebar');
$this->load->view('us_sismap_na/susunletak/navbar');
?>

<main id="main" class="main">



    <section class="section">
        
        <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><?php echo anchor('pilihanraya', "<i class='bx bxs-city'></i> Pilihan Raya", "class='text-decoration-none'"); ?></li>
          <li class="breadcrumb-item active" aria-current="page"><i class='bx bxs-select-multiple'></i> Senarai</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Senarai Pilihan Raya</h1>
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Nama Pilihan Raya</th>
                            <th>Operasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($senaraiPilihanraya as $pru): ?>
                        <tr>
                            <td><?= $pru->pilihanraya_nama ?></td>
                            <td>
                                <!-- Large Modal -->
              <button type="button" class="btn btn-outline-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#largeModal<?= $pru->pilihanraya_bil ?>">
                Senarai
              </button>

              <div class="modal fade" id="largeModal<?= $pru->pilihanraya_bil ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Senarai Parlimen / DUN</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            
                    <?php
                    if($pru->pilihanraya_jenis == 'DUN'):
                        $senaraiDun = $dataDun->senarai_dun_pilihanraya($pru->pilihanraya_bil);
                    ?>
                    <ol>
                        <?php foreach($senaraiDun as $dun): ?>
                        <li>
                            <div class="d-flex justify-content-between align-items-center m-1">
                                <?= $dun->dun_nama ?>
                                <?= form_open('pilihanraya/setCalonRasmiDun') ?>
                                <input type="hidden" name="inputDunBil" value="<?= $dun->dun_bil ?>">
                                <input type="hidden" name="inputPilihanrayaBil" value="<?= $pru->pilihanraya_bil ?>">
                                <button type="submit" class="btn btn-outline-primary shadow-sm">Set Rasmi</button> 
                                </form>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ol>
                    <?php endif; ?>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Large Modal-->
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


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>
