<div class="p-3 border rounded mb-3">
    <h3>KPI PROGRAM</h3>
    <p><?php echo validation_errors(); ?></p>
    <div class="row g-3">
        <div class="col-12 col-lg">
            <?php echo anchor('program', 'Program', "class='btn btn-primary w-100'"); ?>
        </div>
    </div>
</div>
<div class="row g-3">
    <?php 
    $jumlah_peruntukan_keseluruhan = 0;
    foreach($senarai_jabatan as $jabatan): 
        $jumlah_peruntukan = 0;
    ?>
    <div class="col-12 col-lg-4 col-md-4 col-sm-12">
        <div class="p-3 border rounded">
            <p><strong><?php echo $jabatan->jt_pejabat; ?></strong></p>
                <div class="mb-3">
                    <table class="table table-bordered">
                        <?php foreach($senarai_jenis_program as $jenis_program):
                        ?>
                        <tr>
                            <th><?php echo $jenis_program->jt_nama; ?></th>
                            <td>
                                <?php 
                                $senarai_kpi = $data_kpi->kpi($jabatan->jt_bil, $jenis_program->jt_bil);
                                if(empty($senarai_kpi)){
                                    $data_kpi->tambah(
                                        $jabatan->jt_bil,
                                        $jabatan->jt_pejabat,
                                        $jenis_program->jt_bil,
                                        $jenis_program->jt_nama,
                                        $this->session->userdata('pengguna_bil'),
                                        $this->session->userdata('pengguna_nama'),
                                        date("Y-m-d H:i:s")
                                    );
                                }
                                
                                foreach($senarai_kpi as $kpi): ?>
                                <?php echo form_open('kpi/proses_kemaskini'); ?>
                                <label for="input_bilangan" class="form_label">Bilangan KPI</label>
                                <input type="text" name="input_bilangan" id="input_bilangan" class="form-control" value="<?php echo $kpi->kt_bilangan; ?>">
                                <input type="hidden" name="input_jenis_program_bil" value="<?php echo $jenis_program->jt_bil; ?>">
                                <input type="hidden" name="input_jenis_program_nama" value="<?php echo $jenis_program->jt_nama; ?>">
                                <input type="hidden" name="input_japen_bil" value="<?php echo $jabatan->jt_bil; ?>">
                                <input type="hidden" name="input_japen_pejabat" value="<?php echo $jabatan->jt_pejabat; ?>">
                                <input type="hidden" name="input_pengguna_bil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                                <input type="hidden" name="input_pengguna_nama" value="<?php echo $this->session->userdata('pengguna_nama'); ?>">
                                <input type="hidden" name="input_kpi_bil" value="<?php echo $kpi->kt_bil; ?>">
                                <input type="hidden" name="input_tarikh_masuk" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                </form>
                                <br><span>RM <?php $peruntukan = $jenis_program->jt_peruntukan * $kpi->kt_bilangan; echo number_format((float)$peruntukan, 2, '.', ','); ?></span>
                                <br><span class="small text-muted">Oleh: <?php echo $kpi->kt_pengguna_nama; ?> (<?php echo $kpi->kt_tarikh_masuk; ?></span>
                                <?php 
                                if($peruntukan > 0){
                                    $jumlah_peruntukan = $jumlah_peruntukan + $peruntukan;
                                } 
                                endforeach; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <p><strong>Jumlah Peruntukan KPI</strong><br>
                        RM <?php 
                        $jumlah_peruntukan_keseluruhan = $jumlah_peruntukan_keseluruhan + $jumlah_peruntukan;
                        echo number_format((float)$jumlah_peruntukan, '2', '.', ','); ?>
                    </p>
                </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="col-12">
        <div class="p-3 border rounded">
            <h3>JUMLAH KESELURUHAN PERUNTUKAN KPI</h3>
            <p>RM <?php echo number_format((float)$jumlah_peruntukan_keseluruhan, 2, '.', ','); ?></p>
        </div>
    </div>
</div>