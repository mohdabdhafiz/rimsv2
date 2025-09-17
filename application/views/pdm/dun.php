<div class="container-fluid mb-3">
    <h1>DUN <?php echo strtoupper($dun->dun_nama); ?></h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <tbody>
                <?php echo form_open('dun/proses_tambah_dm'); ?>
                <tr>
                    <td valign='bottom' colspan=2><label for="input_nama_dm" class="form-label">Nama Daerah Mengundi (CTH: 888/88/88 DAERAH MENGUNDI):</label>
                        <input type="text" name="input_nama_dm" id="input_nama_dm" class="form-control" autofocus></td>
                    <td valign="bottom">
                        <label for="input_bilangan_pengundi" class="form-label">Bilangan Pengundi DM:</label>
                        <input type="text" name="input_bilangan_pengundi" id="input_bilangan_pengundi" class="form-control">
                    </td>
                    <td valign='bottom'>
                        <input type="hidden" name="input_dun_bil" value="<?= $dun->dun_bil ?>">
                        <button type="submit" class="btn btn-outline-success w-100">Tambah</button></td>
                </tr>
                </form>
                <tr>
                    <th>DAERAH MENGUNDI (DM)</th>
                    <th>BILANGAN PENGUNDI (ORANG)</th>
                    <th>KEMASKINI</th>
                    <th>PADAM</th>
                </tr>
                <?php
                    $senarai_pdm = $data_pdm->dun($dun->dun_bil);
                    $count = 1; 
                    array_multisort($senarai_pdm, SORT_DESC);
                    foreach($senarai_pdm as $pdm): ?>
                    <tr>
                    <?php echo form_open('dun/proses_kemaskini_pdm'); ?>
                        <td><input type="text" name="input_nama_dm" id="input_nama_dm" class="form-control" value="<?= $pdm->pdt_nama ?>"></td>
                        <td><input type="text" name="input_bilangan_pengundi" id="input_bilangan_pengundi" class="form-control" value="<?php echo $pdm->pdt_bilangan_pengundi; ?>"></td>
                        <td>
                            <input type="hidden" name="input_dun_bil" value="<?= $dun->dun_bil ?>">
                            <input type="hidden" name="input_dm_bil" value="<?= $pdm->pdt_bil ?>">
                            <button type="submit" class="btn btn-outline-success w-100">Simpan</button></td>
                    </form>
                    <?php echo form_open('dun/proses_padam_pdm'); ?>
                        <td>
                            <input type="hidden" name="input_dun_bil" value="<?= $dun->dun_bil ?>">
                            <input type="hidden" name="input_dm_bil" value="<?= $pdm->pdt_bil ?>">
                            <button type="submit" class="btn btn-outline-danger w-100">Padam</button>
                        </td>
                    </form>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
                    </div>