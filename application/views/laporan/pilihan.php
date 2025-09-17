<div class="row g-1 mb-3">

    <div class="col-3">
        <?php echo form_open('laporan/rumusan'); ?>
        <div class="row">
            <div class="col col-lg-6">
        <select name="tarikh_laporan" class="form-control w-100">
        
            <?php foreach($pilihanraya as $pru){
                $hari_penamaan_calon = $pru->pilihanraya_penamaan_calon;
                                            $tarikh_mula = strtotime($pru->pilihanraya_penamaan_calon);
                                            $tarikh_tamat = strtotime($pru->pilihanraya_lock_status);
                                        }
                                        for($i = $tarikh_mula; $i <= $tarikh_tamat; $i = $i + 86400){
                                            $hari = date('Y-m-d', $i);
                                            echo "<option value=".$hari.">".$hari."</option>";
                                            
                                        } ?>
        </select>
        </div>
        <div class="col col-lg-3">
        <button type="submit" class="btn btn-secondary w-100">Pilih</button>
        </div>
        </div>
        </form>
    </div>

</div>

        <h3>LAPORAN HARI INI - <?php echo date("d.m.Y"); ?></h3>
        <h4>Program:</h4>
        <?php
        $senaraiProgram = $dataProgram->ikutTarikh(date("Y-m-d H:i:s")); 
        if(!empty($senaraiProgram)){ ?>
        <div class="row g-3">
            <?php foreach($senaraiProgram as $program): 
                $gambar = $dataGambar->satuGambar($program->pt_bil); 
                if(count($senaraiProgram) > 1){?>
            <div class="col col-lg-3 col-md-12 col-sm-12 d-flex align-self-stretch">
                <?php } else { ?>
            <div class="col col-lg-12 col-md-12 col-sm-12 d-flex align-self-stretch">
                    <?php } ?>
                <div class="p-3 border rounded d-flex flex-column text-left justify-content-start w-100">
                    <?php if(!empty($gambar)){ ?>
                <img src="<?php echo base_url(); ?>assets/<?php echo $gambar->gt_nama; ?>" alt="<?php echo $program->pt_nama; ?>" class="rounded w-100 mb-3">
                <?php }else{ ?>
                    <p>Tiada Gambar</p>
                    <?php } ?>
                    <div class="mt-auto">
                <h4><?php echo $program->pt_nama; ?></h4>
                <p><?php echo date_format(date_create($program->pt_tarikhMasa), "d.m.Y H:i:s"); ?><br>
                <?php echo $program->pt_tempat; ?><br>
                <?php echo $program->pt_anjuran; ?><br>
                <?php echo $program->pt_jenisNama; ?></p>
                <?php echo anchor('program/bil/'.$program->pt_bil, "Maklumat Lanjut", "class='btn btn-primary w-100'"); ?>
                </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php } else { ?>
        <div class="p-3 border rounded alert alert-warning mt-3">
            Tiada Program dicatatkan pada tarikh ini.
        </div>
        <?php } ?>
