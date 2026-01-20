<div class="text-center mb-3">
    <h1 class="display-1"><i class="bi bi-file-person-fill"></i> RIMS@PERSONEL</h1>
</div>

<div class="text-center mb-3">
    <a href="<?= site_url('utama') ?>" class="btn btn-info shadow text-white"><i class="bi bi-house-fill"></i></a>
</div>

<div class="text-center mb-3">
    <div class="row g-3">
        <div class="col-12 col-lg-4 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-person"></i> Bilangan Akaun Anggota</h4>
                </div>
                <div class="card-body">
                    <h1 class="display-1"><?= $bilanganAnggota->bilangan ?></h1>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-shop"></i> Bilangan Akaun Pejabat</h4>
                </div>
                <div class="card-body">
                    <h1 class="display-1"><?= $bilanganTadbir->bilangan ?></h1>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-md-4 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-shop"></i> Keseluruhan Akaun RIMS</h4>
                </div>
                <div class="card-body">
                    <h1 class="display-1"><?= $jumlahAkaun->bilangan ?></h1>
                </div>
                <div class="card-footer text-end">
                    <a href="<?= site_url('pengguna') ?>" class="btn btn-primary shadow text-white"><i class="bi bi-view-stacked"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center mb-3 border rounded p-3">
    <h2>Aktiviti</h2>
    <div class="row g-3">
        <div class="col-12 col-lg-3 col-md-4 col-sm-6">
            <a href="<?= site_url('personel/pertukaran') ?>" class="btn btn-secondary shadow w-100 h-100">
                <i class="bi bi-list"></i>
                Pertukaran Pegawai
            </a>
        </div>
    </div>
</div>
