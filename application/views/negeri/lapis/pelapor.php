<div class="p-3 border rounded mb-3">
    <h1>RIMS@PERSONEL</h1>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-6">
            <?php echo anchor('lapis/negeri_pelapor', 'Senarai Pelapor Keseluruhan', "class='btn btn-sm btn-outline-dark w-100'"); ?>
        </div>
        <div class="col-12 col-lg-6">
            <?php echo anchor('pengguna/negeri_belum', 'Senarai KAPAR Tiada Pelapor', "class='btn btn-sm btn-outline-dark w-100'"); ?>
        </div>
    </div>
</div>

<div class="p-3 border rounded mb-3">
            <h2>Senarai Pelapor Keseluruhan</h2>
            <div class="table-responsive mt-3">
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama</th>
                            <th>Jawatan</th>
                            <th>Penempatan</th>
                            <th>Nombor Telefon</th>
                            <th>e-Mel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $bilangan = 1;
                        $senarai_pelapor = $data_pengguna->pelapor_negeri($negeri);
                        foreach($senarai_pelapor as $pelapor): ?>
                        <tr>
                            <td><?= $bilangan++ ?></td>
                            <td><?= $pelapor->nama_penuh ?></td>
                            <td><?= $pelapor->pekerjaan ?></td>
                            <td><?= $pelapor->pengguna_tempat_tugas ?></td>
                            <td><?= $pelapor->no_tel ?></td>
                            <td><?= $pelapor->emel ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>