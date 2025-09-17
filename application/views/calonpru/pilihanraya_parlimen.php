<div class="container-fluid mb-3">
    <div class="p-3 border rounded mb-3">
        <h1>PENCALONAN <?= strtoupper($pru->pilihanraya_nama) ?> MENGIKUT PARLIMEN</h1>
        <div class="row g-3 mt-3">
            <div class="col-12 col-lg-12">
                <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100'"); ?>
            </div>
        </div>
    </div>
    <?php if(!empty($senarai_tugas_parlimen)) { 
        foreach($senarai_tugas_parlimen as $tugas):
            $ada = $data_pilihanraya->semak_parlimen($pru->pilihanraya_bil, $tugas->tpt_parlimen_bil);
            if(!empty($ada)){
        $parlimen = $data_parlimen->parlimen_bil($tugas->tpt_parlimen_bil); ?>
    <div class="p-3 border rounded mb-3">
        <div class="mb-3">
                <?php echo anchor('pencalonan/ikut_parlimen/'.$parlimen->pt_bil, 'Tambah Calon', "class='btn btn-primary float-end'"); ?>
    
    <h2><?= strtoupper($parlimen->pt_nama) ?></h2>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="bg-secondary text-white">
                        <th>BIL</th>
                        <th colspan=3>NAMA CALON</th>
                        <th colspan=2>OPERASI</th>
                    </tr>
                </thead>
                <?php 
                $senarai_calon = $data_calon->senaraiCalon($parlimen->pt_bil, $pru->pilihanraya_bil);
                $tmp_calon = $data_calon->senarai_calon_tanpa_grading($parlimen->pt_bil, $pru->pilihanraya_bil);
                if(count($senarai_calon) == count($tmp_calon)){
                    $senarai_calon = $data_calon->senaraiCalon($parlimen->pt_bil, $pru->pilihanraya_bil);
                }
                else{
                    $senarai_calon = $data_calon->senarai_calon_tanpa_grading($parlimen->pt_bil, $pru->pilihanraya_bil);
                }
                $count = 1;
                foreach($senarai_calon as $calon): 
                $ahli = $data_ahli->ahli($calon->pencalonan_parlimen_ahliBil); 
                $parti = $data_parti->parti($calon->pencalonan_parlimen_partiBil); 
                $foto_ahli = $data_foto->foto($ahli->ahli_foto); 
                $foto_parti = $data_foto->foto($parti->parti_logo);
                ?>
                <tbody>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td>
                        <img src="<?php echo base_url('assets/img/').$foto_ahli->foto_nama; ?>" style="object-fit: cover;width: 100px;height: 100px; border-radius: 100%;"/>
                        </td>
                        <td>
                            Nama: <?= $ahli->ahli_nama ?><br /> 
                            Umur: <?= $ahli->ahli_umur ?><br />
                            Kaum: <?= $ahli->ahli_kaum ?><br />
                            Jantina: <?= $ahli->ahli_jantina ?><br />
                            Pendidikan: <?= $ahli->ahli_pendidikan ?><br />
                            Parti: <?= $parti->parti_nama ?> (<?= $parti->parti_singkatan ?>)
                        </td>
                        <td>
                        <img src="<?php echo base_url('assets/img/').$foto_parti->foto_nama; ?>" style="object-fit: contain;width: 100px;height: 100px; "/>
                        </td>
                        <td>
                            <?php echo anchor('ahli/id/'.$calon->pencalonan_parlimen_ahliBil, 'Kemaskini', "class='btn btn-warning w-100'"); ?>
                </form>
                </td><td>
                <?php if($konfigurasiPadam == 'BUKA'): ?>
                <?php echo form_open('pencalonan/padam_calon_parlimen'); ?>
                <input type="hidden" name="inputCalonParlimenBil" value="<?= $calon->pencalonan_parlimen_bil ?>">
                <input type="hidden" name="input_pilihanraya_bil" value="<?= $pru->pilihanraya_bil ?>">
                            <button type="submit" class="btn btn-danger w-100">Padam</button>    
                </form>
                <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php
            }
        endforeach;
    } ?>
</div>