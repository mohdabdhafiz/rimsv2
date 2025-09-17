<?php 
$this->load->view('admin_na/susunletak/atas');
$this->load->view('admin_na/susunletak/sidebar');
$this->load->view('admin_na/susunletak/navbar');
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@ADMIN</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="<?= base_url() ?>">Utama</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

<div class="">
    
    <section class="section">

    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Padam Semua Program</h1>
            <p>Anda pasti untuk memadam semua program?</p>
            <?= form_open('admin/prosesPadamProgram') ?>
                <button type="submit" name="inputSetuju" value="Setuju" class="btn btn-outline-danger shadow-sm w-100">
                    <i class="bi bi-trash"></i>
                    Padam Semua Program
                </button>
            </form>
        </div>
    </div>

    </section>

</main>



<?php $this->load->view('admin_na/susunletak/bawah'); ?>