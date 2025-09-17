

<div class="row g-3 mb-3">
    <div class="col-12 col-lg-3">
        <div id="nav_ppd"></div>
    </div>

    <div class="col-12 col-lg-9">
        <div class="p-3 border rounded">
            <h1><?= $penggunaKemaskini->nama_penuh ?></h1>
            <p class="small text-muted">ID: <?= $penggunaKemaskini->bil ?></p>
            <?php echo validation_errors(); ?>
            <?php echo form_open('pengguna/proses_kemaskini'); ?>
                <div class="mb-3">
                    <label for="input_nama_penuh" class="form-label">1) Nama Penuh:</label>
                    <input type="text" name="input_nama_penuh" id="input_nama_penuh" class="form-control" value="<?= $penggunaKemaskini->nama_penuh ?>">
                </div>
                <div class="mb-3">
                    <label for="input_no_ic" class="form-label">2) Nombor Kad Pengenalan:</label>
                    <input type="text" id="input_no_ic" class="form-control" value="<?= $penggunaKemaskini->pengguna_ic ?>" disabled>
                    <input type="hidden" name="input_no_ic" value="<?= $penggunaKemaskini->pengguna_ic ?>">
                </div>
                <div class="mb-3">
                    <label for="input_no_tel" class="form-label">3) Nombor Telefon:</label>
                    <input type="text" name="input_no_tel" id="input_no_tel" class="form-control" value="<?= $penggunaKemaskini->no_tel ?>">
                </div>
                <div class="mb-3">
                    <label for="input_emel" class="form-label">4) e-Mel:</label>
                    <input type="email" name="input_emel" id="input_emel" class="form-control" value="<?= $penggunaKemaskini->emel ?>">
                </div>
                <div class="mb-3">
                    <label for="input_jawatan" class="form-label">5) Jawatan:</label>
                    <select class="form-control" name="input_jawatan" id="input_jawatan">
                        <option value="Pegawai Penerangan Gred S44" <?php if($penggunaKemaskini->pekerjaan == 'Pegawai Penerangan Gred S44') { echo "selected"; } ?>>Pegawai Penerangan Gred S44</option>
                        <option value="Pegawai Penerangan Gred S41" <?php if($penggunaKemaskini->pekerjaan == 'Pegawai Penerangan Gred S41') { echo "selected"; } ?>>Pegawai Penerangan Gred S41</option>
                        <option value="Penolong Pegawai Penerangan Gred S40" <?php if($penggunaKemaskini->pekerjaan == 'Penolong Pegawai Penerangan Gred S40') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S40</option>
                        <option value="Penolong Pegawai Penerangan Gred S38" <?php if($penggunaKemaskini->pekerjaan == 'Penolong Pegawai Penerangan Gred S38') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S38</option>
                        <option value="Penolong Pegawai Penerangan Gred S32" <?php if($penggunaKemaskini->pekerjaan == 'Penolong Pegawai Penerangan Gred S32') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S32</option>
                        <option value="Penolong Pegawai Penerangan Gred S29" <?php if($penggunaKemaskini->pekerjaan == 'Penolong Pegawai Penerangan Gred S29') { echo "selected"; } ?>>Penolong Pegawai Penerangan Gred S29</option>
                        <option value="Pembantu Penerangan Gred S28" <?php if($penggunaKemaskini->pekerjaan == 'Pembantu Penerangan Gred S28') { echo "selected"; } ?>>Pembantu Penerangan Gred S28</option>
                        <option value="Pembantu Penerangan Gred S26" <?php if($penggunaKemaskini->pekerjaan == 'Pembantu Penerangan Gred S26') { echo "selected"; } ?>>Pembantu Penerangan Gred S26</option>
                        <option value="Pembantu Penerangan Gred S22" <?php if($penggunaKemaskini->pekerjaan == 'Pembantu Penerangan Gred S22') { echo "selected"; } ?>>Pembantu Penerangan Gred S22</option>
                        <option value="Pembantu Penerangan Gred S19" <?php if($penggunaKemaskini->pekerjaan == 'Pembantu Penerangan Gred S19') { echo "selected"; } ?>>Pembantu Penerangan Gred S19</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="input_tempat" class="form-label">6) Tempat Bertugas:</label>
                    <input type="text" name="input_tempat" id="input_tempat" class="form-control" value="<?= $penggunaKemaskini->pengguna_tempat_tugas ?>">
                </div>
                <input type="hidden" name="input_bil" value="<?= $penggunaKemaskini->bil ?>">
                <input type="hidden" name="input_peranan_bil" value="<?= $this->session->userdata('peranan_bil') ?>">
                <input type="hidden" name="input_peranan_nama" value="<?= $this->session->userdata('peranan'); ?>">
                <input type="hidden" name="input_pengguna_status" value="<?= $penggunaKemaskini->pengguna_status ?>">
                <button type="submit" class="btn btn-primary w-100">Kemaskini</button>
            </form>
        </div>
    </div>


</div>

<script>

    async function setNav()
    {
        const data = await getNav();
        document.getElementById("nav_ppd").innerHTML = data;
    }

    async function getNav()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/ppd/nav');
        const data = await response.text();
        return data;
    }
    
    setNav();

</script>