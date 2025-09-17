<h3>Maklumat Peranan</h3>
<div class="p-3 border rounded bg-white mb-3">
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <tr>
                <td>
                    <strong>Nombor Siri</strong>
                    <br><?= $peranan->perananBil ?>
                </td>
                <td colspan=2>
                    <strong>Nama Peranan</strong>
                    <br><?= $peranan->perananNama ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Tugas: (Lupa)</strong>
                    <br><?= $peranan->perananPetugas ?>
                </td>
                <td>
                    <strong>Didaftarkan Oleh:</strong>
                    <br><?= $peranan->penggunaNama ?>
                </td>
                <td>
                    <strong>Pada:</strong>
                    <br><?= $peranan->perananWaktu ?>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="d-flex justify-content-between align-items-start">
    <h3>Senarai Organisasi</h3>
    <a href="<?= site_url("japen/tambahMaklumatPerananBil/".$peranan->perananBil) ?>" class="btn btn-sm shadow-sm btn-primary">TAMBAH</a>
</div>
<div class="p-3 border rounded bg-white mb-3">
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Nombor Siri</th>
                    <th>Nama Organisasi</th>
                    <th>Didaftarkan Oleh</th>
                    <th>Pada</th>
                    <th>Operasi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($senaraiOrganisasi as $organisasi): ?>
                <tr>
                    <td><?= $organisasi->organisasiBil ?></td>
                    <td><?= $organisasi->japenNama ?></td>
                    <td><?= $organisasi->penggunaNama ?></td>
                    <td><?= $organisasi->organisasiWaktu ?></td>
                    <td>
                        <div class="row g-1">
                            <div class="col d-flex align-items-stretch">
                                <a href="<?= site_url("japen/kemaskiniOrganisasi/".$organisasi->organisasiBil) ?>" class="btn btn-sm btn-primary shadow-sm w-100 d-flex flex-column">
                                    <div class="m-auto">KEMASKINI</div>
                                </a>
                            </div>
                            <div class="col d-flex align-items-stretch">
                                <a href="<?= site_url("japen/padamOrganisasi/".$organisasi->organisasiBil) ?>" class="btn btn-sm btn-danger shadow-sm w-100 d-flex flex-column">
                                    <div class="m-auto">PADAM</div>
                                </a>
                            </div>
                        </div>    
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<h3>Senarai Pegawai Penerangan Negeri</h3>
<div class="p-3 border rounded bg-white mb-3"></div>
<h3>Senarai Ketua Unit</h3>
<div class="p-3 border rounded bg-white mb-3"></div>
<h3>Senarai Pegawai Penerangan Daerah</h3>
<div class="p-3 border rounded bg-white mb-3"></div>
<h3>Senarai Anggota</h3>
<div class="p-3 border rounded bg-white mb-3"></div>
