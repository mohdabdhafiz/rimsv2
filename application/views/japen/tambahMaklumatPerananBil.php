<h3>Tambah Maklumat Nama Baharu Organisasi</h3>
<div class="p-3 border rounded mb-3 bg-white">
    <?= validation_errors() ?>
    <?= form_open("japen/tambahMaklumatPerananBil/".$organisasi->perananBil); ?>
        <div class="form-floating mb-3">
            <input type="text" name="inputPerananNama" id="inputPerananNama" class="form-control" value="<?= $organisasi->perananNama ?>" disabled>
            <label for="inputPerananNama" class="form-label">Nama Peranan</label>
            <input type="hidden" name="inputPerananBil" value="<?= $organisasi->perananBil ?>">
        </div>
        <div class="form-floating mb-3">
            <input type="text" name="inputJapenNama" id="inputJapenNama" class="form-control" required value="<?= set_value("inputJapenNama") ?>">
            <label for="inputJapenNama" class="form-label">Nama Organisasi</label>
        </div>
        <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
        <input type="hidden" name="inputPenggunaWaktu" value="<?= date("Y-m-d H:i:s") ?>">
        <button type="submit" class="btn btn-primary w-100">TAMBAH NAMA BAHARU ORGANISASI</button>
    <?= form_close(); ?>
</div>