<?php 
$this->load->view('us_lapis_na/susunletak/atas');
$this->load->view('us_lapis_na/susunletak/sidebar');
$this->load->view('us_lapis_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@BENCANA</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item active">RIMS@BENCANA</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">
                <i class="bi bi-search"></i>
                Carian
            </h1>
            <?= form_open('bencana/keputusanCarian') ?>
            <div class="row g-3">
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <input type="date" name="inputTarikhMula" id="inputTarikhMula" class="form-control" placeholder="Tarikh Mula">
                        <label for="inputTarikhMula" class="form-label">Tarikh Mula</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <input type="date" name="inputTarikhTamat" id="inputTarikhTamat" placeholder="Tarikh Tamat" class="form-control">
                        <label for="inputTarikhTamat" class="form-label">Tarikh Tamat</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <select name="inputNegeri" id="inputNegeri" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiNegeri as $negeri): ?>
                                <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputNegeri" class="form-label">Negeri</label>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <select name="inputDaerah" id="inputDaerah" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiDaerah as $daerah): ?>
                                <option value="<?= $daerah->bil ?>"><?= $daerah->nt_nama ?> - <?= $daerah->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputDaerah" class="form-label">Daerah</label>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <select name="inputStatus" id="inputStatus" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiStatus as $status): ?>
                                <option value="<?= $status->bencana_status ?>"><?= $status->bencana_status ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputStatus" class="form-label">Status Laporan</label>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-md-6 col-sm-12">
                    <button type="submit" class="btn btn-outline-primary shadow-sm w-100">
                        <i class="bi bi-search"></i>
                        Cari
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>



    </section>

</main>



<?php $this->load->view('us_lapis_na/susunletak/bawah'); ?>