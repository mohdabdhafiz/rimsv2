<div class="container p-5">
    <h1>KEPUTUSAN CARIAN:</h1>
    <div class="table-responsive">
    <table class="table">
        <tr>
            <th>NAMA</th>
            <td><?php echo $pengundi->nama; ?></td>
        </tr>
        <tr>
            <th>KAD PENGENALAN</th>
            <td><?php echo $pengundi->ic; ?></td>
        </tr>
        <tr>
            <th>DUN</th>
            <td><?php echo $pengundi->dun; ?></td>
        </tr>
        <tr>
            <th>DAERAH MENGUNDI</th>
            <td><?php echo $pengundi->daerah_mengundi; ?></td>
        </tr>
        <tr>
            <th>PUSAT MENGUNDI</th>
            <td><?php echo $pengundi->pusat_mengundi; ?></td>
        </tr>
        <tr>
            <td colspan=2><?php echo form_open('kehadiran/hadir'); ?>
                <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                <input type="hidden" name="input_no_ic" value="<?php echo $pengundi->ic; ?>">
                <input type="hidden" name="input_waktu_hadir" value="<?php echo date("Y-m-d H:i:s"); ?>">
                <input type="hidden" name="input_parlimen" value="<?php echo $pengundi->parlimen; ?>">
                <input type="hidden" name="input_dun" value="<?php echo $pengundi->dun; ?>">
                <input type="hidden" name="input_daerah_mengundi" value="<?php echo $pengundi->daerah_mengundi; ?>">
                <input type="hidden" name="input_pusat_mengundi" value="<?php echo $pengundi->pusat_mengundi; ?>">
                <button type="submit" class="btn btn-block btn-secondary w-100">HADIR</button>
            </form>
            </td>
        </tr>
    </table>
    </div>
    <?php echo anchor(base_url(), 'Cari Semula'); ?>
</div>