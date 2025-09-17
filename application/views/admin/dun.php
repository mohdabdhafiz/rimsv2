<?php foreach($senarai_dun as $dun): ?>
<div class="row g-3">
    <div>

<div class="col-12">
    <div class="p-3 text-center">
        <h1>DUN <?php echo strtoupper($dun->dun_nama); ?></h1>
        <h2 class="text-muted"><?php foreach($harian_dun as $harian){
                                echo $harian->harian_grading;
                            } ?></h2>
    </div>
</div>

<div class="col-12 col-lg-6">
                        <div class="p-3">
                            <h3>Rumusan Mengikut DUN</h3>
                            <div class="p-3 border rounded">
                                <?php echo form_open('dun/rumusan'); ?>
                                <select name="dun_bil" class="w-100 mb-2 form-control">
                                    <?php foreach($senarai_dun_2 as $dun): ?>
                                    <option value="<?php echo $dun->dun_bil; ?>"><?php echo $dun->dun_nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="pilihanraya_bil" value="<?php foreach($senarai_pilihanraya as $pru) {echo $pru->pilihanraya_bil;} ?>">
                                <button type="submit" class="btn btn-sm btn-primary">Papar</button>
                                </form>
                            </div>
                        </div>
                    </div>

<div class="col-12">
    <div class="p-3">
        <table class="table table-bordered" id="table_ini">
            <tr class="bg-light">
                <th class="text-center">CALON</th>
                <th class="text-center">PARTI</th>
                <th class="text-center">JUMLAH UNDI</th>
            </tr>
            <?php 
            $satu_undi = 0;
            $dua_undi = 0;
            $count = 1;
            foreach($senarai_calon as $calon): 
                
            ?>
            <tr>
                <td><div class="row justify-content-between align-items-center align-middle">
                    <div class="col-auto"><?php echo strtoupper($calon->ahli_nama); ?></div>
                    <div class="col-auto"><img src="<?php echo base_url('assets/img/').$ahli->foto($calon->ahli_bil); ?>" class="img-fluid" style="object-fit: cover;width: 100px;height: 100px"/></div>
                </div></td>
                <td class="text-center align-items-center align-middle"><img src="<?php echo base_url('assets/img/').$parti->logo($calon->pencalonan_parti); ?>" class="img-fluid" style="object-fit: contain;width: 100px;height: 100px"/></td>
                <td class="text-center align-middle">
                    <div>
                        <?php 
                            $undi = 0;
                            foreach($jumlah_undi as $jumlah){
                                $undi = $jumlah->pengundi_jumlah;
                            } 
                            $u = ($calon->status_grading_peratus/100)*($undi*$peratus_keluar_mengundi);
                            echo floor($u);
                            if($count == 1){ $satu_undi = floor($u); }
                            if($count == 2){ $dua_undi = floor($u); }
                            $count++;
                        ?>
                        <br>
                        <span class="small text-muted">(<?php echo $calon->status_grading_peratus; ?>%)</span>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan='2' class="align-middle">MAJORITI</td>
                <td class="text-center align-middle"><?php echo ($satu_undi - $dua_undi); ?></td>
            </tr>
            <tr>
                <td colspan='2' class="align-middle">ATAS PAGAR / UNDI ROSAK</td>
                <td class="text-center align-middle"><?php foreach($harian_dun as $harian){ echo $harian->harian_atas_pagar; } ?></td>
            </tr>
            <tr>
                <td colspan='2' class="align-middle">PERATUS MENGUNDI</td>
                <td class="text-center align-middle"><?php echo $peratus_keluar_mengundi*100; ?>%</td>
            </tr>
        </table>
        <div class="col-12">
            <div class="p-3 text-center">
            <h2>JUMLAH PENGUNDI : <?php echo $undi; ?></h2>
            </div>
            
        </div>
    </div>
</div>

</div>
</div>
<?php endforeach; ?>