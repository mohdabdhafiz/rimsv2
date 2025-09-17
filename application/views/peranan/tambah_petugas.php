<h3>TAMBAH PERANAN PENGGUNA - <?php echo strtoupper($peranan->peranan_nama); ?></h3>
<div class="mt-5 mb-5">
    <h4>
        <i class="bi bi-search"></i>
        CARIAN
    </h4>
<p>Carian Pengguna:</p>
<?php echo form_open('peranan/cari_pengguna'); ?>
<div class="row g-3">
    <div class="col col-lg-9 col-md-6 col-sm-12">
        <input type="text" placeholder="Nama Pengguna" name="inputNamaPengguna" id="inputNamaPengguna" value="<?php echo set_value('inputNamaPengguna'); ?>" class="form-control">
    </div>
    <div class="col col-lg-3 col-md-6 col-sm-12">
        <button type="submit" class="btn btn-primary w-100">Cari</button>
    </div>
</div>
</form>
</div>
<div class="mb-5">
    <h4>
        <i class="bi bi-gear"></i>
        OPERASI
    </h4>
    <div class="row g-3">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <a href="<?= site_url('peranan/daftarPengguna/'.$peranan->peranan_bil) ?>" class="btn btn-outline-primary shadow-sm w-100">
                <h1 class="display-1"><i class="bi bi-file-plus-fill"></i></h1>
                Daftar Pengguna Baharu Dalam Peranan <strong><?= strtoupper($peranan->peranan_nama) ?></strong>
            </a>
        </div>
    </div>
</div>
<div class="mb-5">
    <h4>
        <i class="bi bi-people"></i>
        PENGGUNA
    </h4>
<p><strong>Senarai Pengguna (Tiada Peranan)</strong></p>
<div class="row g-3">
    <?php foreach($senaraiTiadaPeranan as $pengguna): ?>
    <div class="col col-lg-4 col-md-4 col-sm-6">
        <div class="p-3 border rounded">
        <p>
            <?php echo $pengguna->nama_penuh; ?> <br>
            <?php echo $pengguna->pengguna_ic; ?> <br>
            <?php echo $pengguna->no_tel; ?> <br>
            <?php echo $pengguna->emel; ?>
        </p>
        <p>
            <?php echo form_open('pengguna/tambah_peranan'); ?>
            <input type="hidden" name="inputPenggunaBil" value="<?php echo $pengguna->bil; ?>">
            <input type="hidden" name="inputPerananBil" value="<?php echo $peranan->peranan_bil; ?>">
            <input type="hidden" name="inputPerananNama" value="<?php echo $peranan->peranan_nama; ?>">
            <button type="submit" class="btn btn-primary w-100">Tambah Peranan <?php echo $peranan->peranan_nama; ?></button>
            </form>
        </p>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>