<h3>SENARAI PENGGUNA - <?php echo strtoupper($peranan->peranan_nama); ?></h3>
<p>Senarai Pengguna</p>
<div class="row g-3">
    <?php foreach($senaraiPengguna as $pengguna): ?>
    <div class="col col-lg-4 col-md-4 col-sm-12">
        <div class="p-3 border rounded">
            <p>
                <?php echo $pengguna->nama_penuh; ?> <br>
                <?php echo $pengguna->pengguna_ic; ?> <br>
                <?php echo $pengguna->no_tel; ?> <br>
                <?php echo $pengguna->emel; ?> <br>
                <?php echo $pengguna->pekerjaan; ?>
            </p>
            <p>
                <?php echo form_open('pengguna/tamat_peranan'); ?>
                <input type="hidden" name="inputPenggunaBil" value="<?php echo $pengguna->bil; ?>">
                <input type="hidden" name="inputPerananBil" value="<?php echo $peranan->peranan_bil; ?>">
                <button type="submit" class="btn btn-danger w-100">Buang Peranan</button>
                </form>
            </p>
        </div>
    </div>
    <?php endforeach; ?>
</div>