<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@LAPIS</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Utama</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    
    <section class="section">


        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Carian Muat Turun</h1>
                <?= form_open('lapis/muatTurun') ?>
                    <div class="form-floating mb-3">
                        <select name="inputNegeri" id="inputNegeri" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiNegeri as $negeri): ?>
                                <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputNegeri" class="form-label">Negeri:</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="inputKluster" id="inputKluster" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiKluster as $kluster): ?>
                                <option value="<?= $kluster->kit_bil ?>"><?= $kluster->kit_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputKluster" class="form-label">Kluster:</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="inputTahun" id="inputTahun" placeholder="Tahun:" class="form-control">
                        <label for="inputTahun" class="form-label">Tahun:</label>
                    </div>
                    <button type="submit" class="btn btn-outline-primary shadow-sm w-100">Muat Turun</button>
                </form>
            </div>
        </div>

    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>