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
        <h1 class="card-title">Senarai Calon</h1>
        <p><?= $pru->pilihanraya_nama ?></p>
        <p><?= $dun->dun_nama ?></p>
        <?= form_open('pilihanraya/prosesSetCalonRasmiDun') ?>
        <div class="form-floating mb-3">
          <select name="inputCalonBil" id="inputCalonBil" class="form-control" required>
            <option value="">Sila pilih..</option>
            <?php foreach($senaraiCalon as $calon): ?>
              <option value="<?= $calon->pencalonan_bil ?>">
                <span class="display-6 text-primary"><?= $calon->parti_singkatan ?></span> -
                <?= $calon->ahli_nama ?>
              </option>
            <?php endforeach; ?>
          </select>
          <label for="inputCalonBil" class="form-label">Calon:</label>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-outline-primary shadow-sm">Menang</button>
        </div>
        </form>
      </div>
    </div>

    </section>


    </main>


<?php $this->load->view('us_sismap_na/susunletak/bawah'); ?>
