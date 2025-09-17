<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

    <section class="section">
        
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Maklumat Peribadi</h1>
            <div class="mb-3">
                <p>
                    <strong>Nama</strong>
                    <br><?= strtoupper($pengguna->nama_penuh) ?>
                </p>
            </div>
            <div class="mb-3">
                <p>
                    <strong>Nombor Kad Pengenalan</strong>
                    <br><?= ($pengguna->pengguna_ic) ?>
                </p>
            </div>
            <div class="mb-3">
                <p>
                    <strong>Nombor Telefon</strong>
                    <br><?= ($pengguna->no_tel) ?>
                </p>
            </div>
            <div class="mb-3">
                <p>
                    <strong>Jawatan Terakhir</strong>
                    <br><?= strtoupper($pengguna->pekerjaan) ?>
                </p>
            </div>
            <div class="mb-3">
                <p>
                    <strong>Penempatan Terakhir</strong>
                    <br><?= strtoupper($pengguna->pengguna_tempat_tugas) ?>
                </p>
            </div>
        </div>
    </div>

    </section>


</main>


<?php $this->load->view($footer); ?>