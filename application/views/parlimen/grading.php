<div class="mb-3">
    <div class="p-3 border rounded mb-3">
        <h1 class="display-1">
            PARLIMEN <?php echo strtoupper($parlimen->pt_nama); ?>
        </h1>
        <p class="small text-muted"><?php echo $parlimen->pt_negeri; ?></p>
        <div class="row g-3 mt-3">
            <div class="col-12">
                <?php echo anchor('parlimen/papar_parlimen/'.$parlimen->pt_bil, 'Parlimen '.$parlimen->pt_nama, "class='btn btn-primary w-100'"); ?>
            </div>
        </div>
    </div>
    <div class="p-3 border rounded">
        <h2 class="display-2 mb-3">GRADING PARLIMEN <?php echo strtoupper($parlimen->pt_nama); ?></h2>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tr class="bg-secondary text-white">
                    <th class="text-center" valign="middle">BIL</th>
                    <th class="text-center" valign="middle">TARIKH GRADING</th>
                    <th class="text-center" valign="middle">GRADING</th>
                    <th class="text-center" valign="middle">DIKEMASKINI OLEH</th>
                    <th class="text-center" valign="middle">WAKTU KEMASKINI</th>
                    <th class="text-center" valign="middle">OPERASI</th>
                </tr>
                <?php $count = 1; 
                foreach($senarai_grading as $grading): ?>
                    <tr>
                        <td class="text-center" valign="middle"><?php echo $count++; ?></td>
                        <td class="text-center" valign="middle"><?php echo date_format(date_create($grading->harian_parlimen_tarikh), "d.m.Y"); ?></td>
                        <td class="text-center" valign="middle"><?php echo $grading->harian_parlimen_grading; ?></td>
                        <td class="text-center" valign="middle"><?php
                        $nama_pengguna = "TIADA";
                        if(!empty($grading->harian_parlimen_pengguna)){
                            $nama_pengguna = $data_pengguna->pengguna($grading->harian_parlimen_pengguna_bil)->nama_penuh;
                        }
                        echo $nama_pengguna; ?></td>
                        <td class="text-center" valign="middle"><?php echo $grading->harian_parlimen_pengguna_waktu; ?></td>
                        <td class="text-center" valign="middle"><?php echo form_open('grading/padam_bil'); ?>
                                <input type="hidden" name="input_parlimen_bil" value="<?php echo $grading->harian_parlimen_parlimen; ?>">
                                <input type="hidden" name="input_grading_bil" value="<?php echo $grading->harian_parlimen_bil; ?>">
                                <button type="submit" class="btn btn-danger w-100">Padam</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>