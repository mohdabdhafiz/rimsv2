<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
        <h1 class="display-1">ETNOGRAFI JaPen</h1>
    </div>
    <div class="p-3 border rounded mb-3">
        <h2 class="display-2">PARLIMEN</h2>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tr class="bg-primary text-white">
                    <th class="text-center" valign="middle">BIL</th>
                    <th valign="middle">PARLIMEN</th>
                    <th class="text-center" valign="middle" style="width:20%">GRADING</th>
                    <th class="text-center" valign="middle">OPERASI</th>
                </tr>
                <?php $count = 1; 
                foreach($senarai_parlimen as $parlimen): 
                $grading_harian = $data_harian->semasa_parlimen($parlimen->pt_bil); 
                $grade = "";
                if(!empty($grading_harian->harian_parlimen_grading)){
                    $grade = $grading_harian->harian_parlimen_grading;
                }
                ?>
                <tr <?php if(!empty($grading_harian->harian_parlimen_color)){ ?> style="<?php echo $grading_harian->harian_parlimen_color; ?>" <?php }else{ ?> style="background:red; color:white;" <?php } ?>>
                    <?php echo form_open('harian/tambah_grading_harian'); ?>
                    <td class="text-center" valign="middle"><?php echo $count++; ?></td>
                    <td valign="middle"><?php echo $parlimen->pt_nama; ?></td>
                    <td class="text-center" valign="middle">
                        <select name="input_grading" id="input_grading" class="form-control w-100">
                            <option value="0">Sila Pilih..</option>
                            <option value="PUTIH" <?php if($grade == "PUTIH"){ echo "selected"; } ?>>PUTIH</option>
                            <option value="KELABU PUTIH" <?php if($grade == "KELABU PUTIH"){ echo "selected"; } ?>>KELABU PUTIH</option>
                            <option value="KELABU HITAM" <?php if($grade == "KELABU HITAM"){ echo "selected"; } ?>>KELABU HITAM</option>
                            <option value="HITAM" <?php if($grade == "HITAM"){ echo "selected"; } ?>>HITAM</option>
                        </select>
                    </td>
                    <td class="text-center" valign="middle">
                        <input type="hidden" name="input_harian_bil" value="<?php $g_bil = ""; 
                        if(!empty($grading_harian->harian_parlimen_bil)){ $g_bil = $grading_harian->harian_parlimen_bil; } echo $g_bil;?>">
                        <input type="hidden" name="input_parlimen_bil" value="<?php echo $parlimen->pt_bil; ?>">
                        <input type="hidden" name="input_harian_tarikh" value="<?php echo date("Y-m-d"); ?>">
                        <button type="submit" class="btn btn-primary w-100">SIMPAN</button></td>
                    </form>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>