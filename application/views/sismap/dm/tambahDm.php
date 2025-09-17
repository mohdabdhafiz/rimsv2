<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

    <section class="section">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Parlimen - Daerah Mengundi (DM)</h1>
    <div class="p-3 border rounded mb-3">
        <h2 class="text-primary">TAMBAH DAERAH MENGUNDI</h2>
        <?php echo validation_errors(); ?>
        <?php echo form_open('parlimen/proses_tambah_dm'); ?>
        <div class="mb-3">
            <label for="input_parlimen_bil" class="form-label">1) Pilih Parlimen:</label>
            <select name="input_parlimen_bil" id="input_parlimen_bil" class="form-control" autofocus>
                <option value="0">Sila Pilih</option>
                <?php foreach($senarai_parlimen as $parlimen): ?>
                    <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="input_nama_dm" class="form-label">2) Nama Daerah Mengundi:</label>
            <input type="text" name="input_nama_dm" id="input_nama_dm" class="form-control">
            <span class="small text-muted">Contoh: 082/12/01 CHERATING</span>
        </div>
        <div class="mb-3">
            <label for="input_nama_dm" class="form-label">3) Bilangan Pengundi:</label>
            <input type="text" name="input_bilangan_pengundi" id="input_bilangan_pengundi" class="form-control">
        </div>
        <button type="submit" class="btn btn-outline-success w-100">Simpan</button>
</form>
    </div>

    <div class="p-3 border rounded mb-3">
        <h2 class="text-primary">SENARAI DAERAH MENGUNDI</h2>
        <div class="row g-3">
            <?php foreach($senarai_parlimen as $parlimen): ?>
            <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                <h4><?= $parlimen->pt_nama; ?></h4>
                <?php $senarai_pdm = $data_pdm->parlimen($parlimen->pt_bil); 
                    if(count($senarai_pdm) > 0){
                ?>
                 <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>DAERAH MENGUNDI (DM)</th>
                                    <th>BILANGAN PENGUNDI (ORANG)</th>
                                    <th>KEMASKINI MAKLUMAT</th>
                                    <th>PADAM MAKLUMAT</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                    $count = 1; 
                    foreach($senarai_pdm as $pdm): ?>
                    <tr>
                    <?php echo form_open('parlimen/proses_kemaskini_pdm'); ?>
                        <td><?= $count++ ?></td>
                        <td>
                            <textarea name="input_nama_dm" id="input_nama_dm" cols="10" rows="3" wrap="soft" class="form-control"><?= $pdm->ppt_nama ?></textarea>
                            </td>
                        <td><input type="text" name="input_bilangan_pengundi" id="input_bilangan_pengundi" class="form-control" value="<?= $pdm->ppt_bilangan_pengundi ?>"></td>
                        <td>
                            <input type="hidden" name="input_dm_bil" value="<?= $pdm->ppt_bil ?>">
                            <button type="submit" class="btn btn-outline-success w-100">Simpan</button></td>
                    </form>
                    <?php echo form_open('parlimen/proses_padam_pdm'); ?>
                        <td>
                            <input type="hidden" name="input_dm_bil" value="<?= $pdm->ppt_bil ?>">
                            <button type="submit" class="btn btn-outline-danger w-100">Padam</button>
                        </td>
                    </form>
                    </tr>
                    <?php endforeach; ?>
                
                    </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
            </div>
        </div>
    </section>


</main>


<?php $this->load->view($footer); ?>