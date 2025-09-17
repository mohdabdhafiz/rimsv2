<div class="mb-1">
    <?php $this->load->view('ppd/program/nav'); ?>
</div>

<div class="p-3 border rounded mb-1">
  <p><strong>Padam Maklumat Program</strong></p>
  <p>Anda pasti untuk memadam maklumat ini?</p>
    <p>
        Nama Program<br> 
        <strong><?php echo $program->pt_nama; ?></strong>
    </p>
    <div class="row g-1">
        <div class="col-auto">
            <?= form_open('program/proses_padam') ?>
            <input type="hidden" name="inputProgramBil" value="<?= $program->pt_bil ?>">
            <button type="submit" class="btn btn-sm btn-danger">Ya, saya ingin memadam maklumat ini.</button>
            </form>
        </div>
        <div class="col-auto">
            <?php echo anchor('program/senarai_padam', 'Kembali Senarai Laporan Program', "class = 'btn btn-outline-secondary btn-sm'"); ?>
        </div>
    </div>
</div>
