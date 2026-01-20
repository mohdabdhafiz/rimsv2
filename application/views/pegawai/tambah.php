            <div class="card shadow">
                <div class="card-body">
                    <h1 class="card-title">Tambah Pegawai</h1>
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                    <?php echo validation_errors('<div class="alert alert-warning">', '</div>'); ?>
                    <?php echo form_open('pegawai/tambah'); ?>

                    <div class="mb-3">
                        <label for="pengguna_bil" class="form-label">Pilih Pegawai</label>
                        <select name="pengguna_bil" id="pengguna_bil" class="form-control">
                            <option value="">-- Pilih Pegawai --</option>
                            <?php foreach($penggunaList as $pengguna): ?>
                                <option value="<?php echo $pengguna->bil; ?>" <?php echo set_select('pengguna_bil', $pengguna->bil); ?>>
                                    <?php echo $pengguna->nama_penuh . ' (' . $pengguna->pengguna_ic . ')'; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                            
                    <div class="form-floating mb-3">
                        <select name="pruBil" id="pruBil" class="form-select">
                            <option value="">-- Pilih PRU --</option>
                            <?php foreach($pruList as $pru): ?>
                                <option value="<?php echo $pru->pilihanraya_bil; ?>" <?php echo set_select('pruBil', $pru->pilihanraya_bil); ?>>
                                    <?php echo $pru->pilihanraya_nama . ' (' . $pru->pilihanraya_singkatan . ')'; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="pruBil">Pilih PRU</label>
                    </div>
                    <div class="mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea class="form-control" name="catatan"><?php echo set_value('catatan'); ?></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>


<!-- Tambah CDN Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pengguna_bil').select2({
            placeholder: "-- Pilih Pegawai --",
            allowClear: true,
            width: '100%',
            theme: 'bootstrap4',
        });
    });
</script>
  