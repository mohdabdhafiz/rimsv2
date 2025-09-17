<hr>
<div class="mb-5">
        <div class="mb-3">
        <h2>RIMS@SISMAP</h2>
        <small class="text-muted">SISTEM MAKLUMAT PILIHAN RAYA</small>
        </div>
        <div class="row g-3 mb-3">

                <div class="col-12 col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                        <div class="p-3 border rounded d-flex flex-column bg-white w-100">
                                <div class="my-auto text-center mb-3">
                                        <h1 class="display-3"><?= $bilanganJangkaanCalonParlimen; ?></h1>
                                        <p class="mb-0">Jangkaan Calon Parlimen</p>
                                </div>
                                <div class="mt-auto">
                                        <a href="<?= site_url('winnable_candidate') ?>" class="btn btn-primary w-100">Lihat</a>
                                </div>
                        </div>
                </div>

                <div class="col-12 col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                        <div class="p-3 border rounded d-flex flex-column bg-white w-100">
                                <div class="my-auto text-center mb-3">
                                        <h1 class="display-3"><?= $bilanganJangkaanCalonDun; ?></h1>
                                        <p class="mb-0">Jangkaan Calon DUN</p>
                                </div>
                                <div class="mt-auto">
                                        <a href="<?= site_url('winnable_candidate') ?>" class="btn btn-primary w-100">Lihat</a>
                                </div>
                        </div>
                </div>

                <div class="col-12 col-lg-4 col-md-4 col-sm-6 d-flex align-items-stretch">
                        <div class="p-3 border rounded d-flex flex-column bg-white w-100">
                                <div class="my-auto text-center mb-3">
                                        <h1 class="display-3"><?= $bilanganPru ?></h1>
                                        <p class="mb-0">PRU</p>
                                </div>
                                <div class="mt-auto">
                                        <a href="<?= site_url('pilihanraya') ?>" class="btn btn-primary w-100">Lihat</a>
                                </div>
                        </div>
                </div>

        </div>
        <div class="row g-3">
                <div class="col col-lg col-md-3 col-sm-4 d-flex align-items-stretch">
                        <a href="<?= site_url('winnable_candidate') ?>" class="btn w-100 p-3 border rounded text-center d-flex flex-column">
                                <div class="d-flex justify-content-start align-items-center m-auto">
                                        <i class='bi bi-incognito display-5 text-info me-3'></i> 
                                        <span class="text-start">JANGKAAN CALON</span>
                                </div>
                        </a>
                </div>
                <div class="col col-lg col-md-3 col-sm-4 d-flex align-items-stretch">
                        <a href="<?= site_url('pilihanraya') ?>" class="btn w-100 p-3 border rounded text-center d-flex flex-column">
                                <div class="d-flex justify-content-start align-items-center m-auto">
                                        <i class='bi bi-globe2 display-5 text-info me-3'></i> 
                                        <span class="text-start">PILIHAN RAYA</span>
                                </div>
                        </a>
                </div>
                <div class="col col-lg col-md-3 col-sm-4 d-flex align-items-stretch">
                        <a href="<?= site_url('harian') ?>" class="btn w-100 p-3 border rounded text-center d-flex flex-column">
                                <div class="d-flex justify-content-start align-items-center m-auto">
                                        <i class='bi bi-newspaper display-5 text-info me-3' ></i> 
                                        <span class="text-start">ETNOGRAFI</span>
                                </div>
                        </a>
                </div>
        </div>
</div>
<hr>

<div class="mb-3">
        <h2>RIMS@LAPIS</h2>
        <small class="text-muted">LAPORAN ISU SETEMPAT</small>
</div>
<div class="row g-3 mb-5">
        <div class="col d-flex align-items-stretch">
                <a href="<?= site_url('lapis') ?>" class="d-flex flex-column p-3 btn w-100 border rounded">
                        <div class="d-flex justify-content-start align-items-center m-auto">
                                <i class='bi bi-border-style display-5 text-danger me-3'></i> 
                                <span class="text-start">LAMAN RUMUSAN LAPORAN ISU SETEMPAT</span>
                        </div>
                </a>
        </div>
        <div class="col d-flex align-items-stretch">
                <a href="<?= site_url('lapis/pilih_kluster') ?>" class="d-flex flex-column p-3 btn w-100 border rounded">
                        <div class="d-flex justify-content-start align-items-center m-auto">
                                <i class='bi bi-border-style display-5 text-danger me-3'></i> 
                                <span class="text-start">BORANG LAPORAN ISU SETEMPAT</span>
                        </div>
                </a>
        </div>
</div>
<hr>

<h2>RIMS@LPK</h2>
<small class="text-muted">LAPORAN PERSEPSI TERHADAP KERAJAAN</small>
<div class="row g-3 mb-5 mt-1">
        <div class="col col-lg col-md-3 col-sm-4 d-flex align-items-stretch">
                <a href="<?= site_url('sentimen') ?>" class="btn p-3 border rounded text-center d-flex flex-column w-100">
                        <div class="d-flex justify-content-start align-items-center m-auto">       
                                <i class='bi bi-grid-1x2 display-5 text-secondary me-3'></i> 
                                <span class="text-start">LAMAN RUMUSAN LAPORAN PERSEPSI TERHADAP KERAJAAN</span>
                        </div> 
                </a>
        </div>
        <div class="col col-lg col-md-3 col-sm-4 d-flex align-items-stretch">
                <a href="<?= site_url('sentimen/senarai') ?>" class="btn p-3 border rounded text-center d-flex flex-column w-100">
                        <div class="d-flex justify-content-start align-items-center m-auto">       
                                <i class='bi bi-inbox-fill display-5 text-secondary me-3'></i> 
                                <span class="text-start">SENARAI LAPORAN PERSEPSI TERHADAP KERAJAAN (INDIVIDU)</span>
                                </div> 
                </a>
        </div>
        <div class="col col-lg col-md-3 col-sm-4 d-flex align-items-stretch">
                <a href="<?= site_url('sentimen/mengikutSenaraiAnggota') ?>" class="btn p-3 border rounded text-center d-flex flex-column w-100">
                        <div class="d-flex justify-content-start align-items-center m-auto">       
                                <i class='bi bi-inboxes-fill display-5 text-secondary me-3'></i> 
                                <span class="text-start">SENARAI LAPORAN PERSEPSI TERHADAP KERAJAAN (KESELURUHAN)</span>
                                </div> 
                </a>
        </div>
        <div class="col col-lg col-md-3 col-sm-4 d-flex align-items-stretch">
                <a href="<?= site_url('sentimen/borang') ?>" class="btn p-3 border rounded text-center d-flex flex-column w-100">
                        <div class="d-flex justify-content-start align-items-center m-auto">       
                                <i class='bi bi-border-style display-5 text-secondary me-3'></i> 
                                <span class="text-start">BORANG LAPORAN PERSEPSI TERHADAP KERAJAAN</span>
                                </div> 
                </a>
        </div>
        <div class="col col-lg col-md-3 col-sm-4 d-flex align-items-stretch">
                <a href="<?= site_url('sentimen/statusPenghantaran') ?>" class="btn p-3 border rounded text-center d-flex flex-column w-100">
                        <div class="d-flex justify-content-start align-items-center m-auto">       
                                <i class='bi bi-list-check display-5 text-secondary me-3'></i> 
                                <span class="text-start">STATUS PENGHANTARAN LAPORAN PERSEPSI TERHADAP KERAJAAN</span>
                                </div> 
                </a>
        </div>
</div>
<hr>

<h2>RIMS@PERSONEL</h2>
<small class="text-muted">LAPORAN AKAUN PEGAWAI JAPEN NEGERI</small>
    <div class="row g-3 mb-5 mt-1">
        <div class="col d-flex align-items-stretch">
            <?php echo anchor('lapis/negeri_pelapor', 'Senarai Pelapor', "class='btn btn-outline-dark w-100 d-flex justify-content-center align-items-center m-auto'"); ?>
        </div>
        <div class="col d-flex align-items-stretch">
            <?php echo anchor('pengguna', 'RIMS@PERSONEL', "class='btn btn-outline-dark w-100 d-flex justify-content-center align-items-center m-auto'"); ?>
        </div>
    </div>
<hr>