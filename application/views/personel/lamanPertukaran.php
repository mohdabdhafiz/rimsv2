<div class="text-center mb-3">
    <p class="text-secondary"><i class="bi bi-file-person-fill"></i> RIMS@PERSONEL / PERTUKARAN PEGAWAI</p>
</div>

<div class="text-center mb-3">
    <a href="<?= site_url('personel') ?>" class="btn btn-info shadow text-white"><i class="bi bi-file-person-fill"></i></a>
</div>

<div class="border rounded p-3 mb-3">
    <?php echo validation_errors(); ?>
    <h2><i class="bi bi-view-list"></i> Borang Pertukaran Pegawai</h2>
    <?php echo form_open('personel/pertukaran') ?>
    <div class="mb-3">
        <label for="inputAnggotaBil" class="form-label">Pegawai / Pengguna Akaun RIMS</label>
        <select name="inputAnggotaBil" id="inputAnggotaBil" class="form-control" required>
            <option value="">SILA PILIH..</option>
            <?php foreach($senaraiPegawai as $pegawai): ?>
                <option value="<?= $pegawai->bil ?>">[<?= $pegawai->bil ?>] <?= strtoupper($pegawai->nama_penuh) ?> (<?= strtoupper($pegawai->pekerjaan) ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="inputPerananBil" class="form-label">Peranan Baharu</label>
        <select name="inputPerananBil" id="inputPerananBil" class="form-control" required>
            <option value="">SILA PILIH..</option>
            <?php foreach($senaraiPeranan as $peranan): ?>
                <option value="<?= $peranan->peranan_bil ?>">[<?= $peranan->peranan_bil ?>] <?= strtoupper($peranan->peranan_nama) ?></option>
            <?php endforeach; ?>
        </select>
    </div>  
    <input type="hidden" name="inputPenggunaBil" value="<?= $pengguna->bil ?>">
    <input type="hidden" name="inputPenggunaWaktu" value="<?= date('Y-m-d H:i:s') ?>">
    <button type="submit" class="btn btn-primary shadow w-100">Hantar</button>
    </form>
</div>