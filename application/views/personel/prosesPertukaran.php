<div class="text-center mb-3">
    <p class="text-secondary"><i class="bi bi-file-person-fill"></i> RIMS@PERSONEL / PERTUKARAN PEGAWAI</p>
</div>

<div class="text-center mb-3">
    <a href="<?= site_url('personel') ?>" class="btn btn-info shadow text-white"><i class="bi bi-file-person-fill"></i></a>
</div>

<div class="border rounded p-3 mb-3">
    <h2 class="text-center"><i class="bi bi-view-list"></i> Status Pertukaran Pegawai</h2>
    <p class="text-center">Anda pasti untuk meneruskan proses pertukaran ini?</p>
    <div class="row g-3 mb-3">
        <div class="col-auto col-lg-2 col-md-4 col-sm-12">
            <strong>Nombor Siri</strong> 
            <br><?= $anggota->bil ?>
        </div>
        <div class="col-auto col-lg-10 col-md-6 col-sm-12">
            <strong>Nama Penuh</strong> 
            <br><?= strtoupper($anggota->nama_penuh) ?>
        </div>
        <div class="col-auto col-lg-4 col-md-4 col-sm-12">
            <strong>Nombor Kad Pengenalan</strong> 
            <br><?= $anggota->pengguna_ic ?>
        </div>
        <div class="col-auto col-lg-4 col-md-4 col-sm-12">
            <strong>Nombor Telefon</strong> 
            <br><?= $anggota->no_tel ?>
        </div>
        <div class="col-auto col-lg-4 col-md-4 col-sm-12">
            <strong>e-Mel</strong> 
            <br><?= $anggota->emel ?>
        </div>
    </div>
    <div class="table-responsive mb-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Semasa</th>
                    <th>Baharu</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Jawatan</th>
                    <td><?= strtoupper($anggota->pekerjaan) ?></td>
                    <td><?= strtoupper($anggota->pekerjaan) ?></td>
                </tr>
                <tr>
                    <th>Penempatan</th>
                    <td class="text-success"><strong><?= strtoupper($anggota->pengguna_tempat_tugas) ?></strong></td>
                    <td class="text-danger"><strong><?= strtoupper($organisasi->jt_pejabat) ?></strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php echo form_open('personel/setujuPertukaran'); ?>
    <input type="hidden" name="inputAnggotaBil" value="<?= $anggota->bil ?>">
    <input type="hidden" name="inputAnggotaNama" value="<?= strtoupper($anggota->nama_penuh) ?>">
    <input type="hidden" name="inputAnggotaJawatan" value="<?= strtoupper($anggota->pekerjaan) ?>">
    <input type="hidden" name="inputAnggotaPenempatan" value="<?= strtoupper($anggota->pengguna_tempat_tugas) ?>">
    <input type="hidden" name="inputPerananBil" value="<?= $peranan->peranan_bil ?>">
    <input type="hidden" name="inputPerananNama" value="<?= strtoupper($peranan->peranan_nama) ?>">
    <input type="hidden" name="inputOrganisasiBil" value="<?= $organisasi->jt_bil ?>">
    <input type="hidden" name="inputOrganisasiNama" value="<?= strtoupper($organisasi->jt_pejabat) ?>">
    <input type="hidden" name="inputPertukaranTarikh" value="<?= date('Y-m-d') ?>">
    <input type="hidden" name="inputPertukaranPengguna" value="<?= $pengguna->bil ?>">
    <input type="hidden" name="inputPertukaranWaktu" value="<?= date('Y-m-d H:i:s') ?>">
    <div class="text-center">
        <button type="submit" class="btn btn-outline-success shadow-sm"><i class="bi bi-check2"></i> Setuju</button>
        <a href="<?= site_url('personel/pertukaran') ?>" class="btn btn-outline-danger shadow-sm"><i class="bi bi-x-square"></i> Batal</a>
    </div>
    </form>
</div>