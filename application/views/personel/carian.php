<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PERSONEL</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url("personel") ?>">Personel</a></li>
                <li class="breadcrumb-item active"><a href="<?= site_url("personel/carian") ?>">Carian</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title"><i class="bi bi-file-earmark-person"></i> Carian Personel RIMS</h1>
            <?= form_open("personel/keputusanCarian") ?>
                <div class="form-floating mb-3">
                    <input type="text" name="inputCarian" id="inputCarian" class="form-control">
                    <label for="inputCarian" class="form-label">Carian</label>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-outline-primary shadow-sm"><i class="bi bi-search"></i> Cari</button>
                </div>
            </form>
            <p>Bilangan Personel RIMS : <?= $bilanganPengguna ?></p>
        </div>
    </div>
    

    </section>

</main>

<?php $this->load->view($footer); ?>