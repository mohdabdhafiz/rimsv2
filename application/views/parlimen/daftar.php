<div class="p-3 border rounded shadow mt-3 mb-3">
    <h1>Daftar Parlimen Baru</h1>
    <?php echo validation_errors(); ?>
    <?php echo form_open('parlimen/proses_daftar'); ?>
    <div class="mb-3 mt-3">
        <label for="inputParlimenNegeri" class="form-label">Negeri</label>
        <select autofocus class="form-select" aria-label="Senarai Negeri" name = "inputParlimenNegeri">
            <?php foreach($senaraiNegeri as $negeri): ?>
            <option value="<?php echo $negeri; ?>"><?php echo $negeri; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="inputParlimenNama" class="form-label">Nama Parlimen</label>
        <input type="text" name="inputParlimenNama" class="form-control" value="<?php echo set_value('inputParlimenNama'); ?>"/>
    </div>
    <input type="hidden" id="inputParlimenBilPengguna" name="inputParlimenBilPengguna" value="<?php echo $this->session->userdata("pengguna_bil"); ?>">
    <input type="hidden" id="inputParlimenNamaPengguna" name="inputParlimenNamaPengguna" value="<?php echo $this->session->userdata("pengguna_nama"); ?>">
    <div class="row g-3 mb-3 mt-2">
        <div class="col-sm-12 col col-lg-6">
        <input type="submit" name="submit" value="Tambah Parlimen" class="btn btn-primary w-100"/>
        </div>
        <div class="col-sm-12 col-12 col-lg-4"><button type="reset" class="btn btn-info text-white w-100">Set Semula</button>
        </div>
        <div class="col-sm-12 col-12 col-lg-2"><?php echo anchor('parlimen', 'Kembali ke Laman Parlimen', "class = 'btn btn-secondary w-100'"); ?>
        </div>
    </div>
    </form> 
</div>