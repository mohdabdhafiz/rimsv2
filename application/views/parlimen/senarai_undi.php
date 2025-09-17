<?php foreach($senarai_pilihanraya as $pru): ?>
    <h2>SENARAI KRONOLOGI MAKLUMAT UNDI PARLIMEN <?= strtoupper($parlimen->pt_nama) ?></h2>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <tr class="bg-secondary text-white">
                <th>CALON</th>
                <th>BILANGAN UNDI</th>
                <th>WAKTU</th>
            </tr>
            <?php foreach($senarai_undi as $undi): ?>
            <tr>
                <td><?= $undi->ahli_nama ?></td>
                <td>
                <?php echo form_open('undi/proses_simpan'); ?>
                <input type="hidden" name="input_undi_bil" value="<?= $undi->kpt_bil ?>">
                <input type="hidden" name="input_parlimen_bil" value="<?= $parlimen->pt_bil ?>">
                <input type="text" name="input_bilangan_pengundi" id="input_bilangan_pengundi" class="form-control m-auto" style="width:100px;" value="<?= $undi->kpt_undi ?>"></td>
                <td><?= $undi->kpt_waktu ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endforeach; ?>