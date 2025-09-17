<?php 
$this->load->view('urusetia_na/susunletak/atas');
$this->load->view('urusetia_na/susunletak/sidebar');
$this->load->view('urusetia_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@PROGRAM</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Utama</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi') ?>">Konfigurasi</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('konfigurasi/senaraipenerbitan') ?>">Senarai Penerbitan Program</a></li>
                <li class="breadcrumb-item active">Padam Maklumat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title text-danger">
                <i class="bi bi-trash"></i>
                Padam Maklumat
            </h1>
            <p><strong>Anda pasti untuk memadam maklumat ini?</strong></p>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <span class="small"><strong>Bil</strong></span>
                            <br><?= $penerbitan->senarai_penerbitan_bil ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="small"><strong>Penerbitan Program</strong></span>
                            <br><?= $penerbitan->senarai_penerbitan_penerbitan ?>
                        </td>
                    </tr>
                </table>
            </div>
            <?= form_open('konfigurasi/padamSenaraipenerbitan') ?>
            <input type="hidden" name="inputBil" value="<?= $penerbitan->senarai_penerbitan_bil ?>">
            <button type="submit" class="btn btn-outline-danger shadow-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Padam Maklumat">
                                        <i class="bi bi-trash"></i>
                                        Padam Maklumat Ini
                                    </button>
            </form>
        </div>
    </div>
    


    </section>

</main>


<?php $this->load->view('urusetia_na/susunletak/bawah'); ?>