<main id="main" class="main">
<div class="pagetitle">
    <h1>RIMS@PROGRAM - DOKUMEN SOKONGAN</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('program') ?>">Utama</a></li>
        </ol>
    </nav>
</div>
<section class="section">
    <?php $this->load->view($nav); ?>
    <div class="row g-3">
        <div class="col col-lg-3 d-flex align-items-stretch">
            <div class="p-3 border rounded bg-white w-100 text-center">
                <h1 class="display-1"><?= $bilanganLaporan ?></h1>
                <div class="mt-auto">
                    <small>Bilangan Dokumen</small>
                </div>
            </div>
        </div>
    </div>
</section>
</main>