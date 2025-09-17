<div class="container-fluid">
<?php 
foreach($pilihanraya as $pru)
{
    $tarikh_penamaan_calon = $pru->pilihanraya_penamaan_calon;
}
?>
<?php foreach($dun as $d): ?>
    
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS'); ?> </li>
                        <li class="breadcrumb-item"><?php echo anchor(base_url(), 'DUN'); ?> </li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo strtoupper($d->dun_nama); ?></li>
                    </ol>
                </nav>
<h3>DUN <?php echo strtoupper($d->dun_nama); ?></h3>
<p class="text-muted"><?php echo strtoupper($d->dun_negeri); ?></p>
<?php if(!empty($senarai_calon)) { ?>
<div class="row g-3 mb-3">
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
        <?php foreach($stat as $h2):
        $color = "background:red; color:white";
        if(!empty($h2->harian_color)){
            $color = $h2->harian_color;
        } ?>
            <div class="p-3 border rounded w-100 d-flex flex-column align-item-start" style="<?php echo $color; ?>">
                <h2 class = "display-4"><?php echo $h2->harian_grading; ?></h2>
                <small class=" mt-auto text-end">Status Semasa</small> 
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-stretch">
        <div class="p-3 border rounded w-100 d-flex flex-column align-item-start">
            <h2 class = "display-1"><?php echo count($senarai_calon); ?></h2>
            <small class = "mt-auto text-end">orang pencalonan</small>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-4 col-lg-6 d-flex align-items-stretch">
        <div class="p-3 border rounded w-100 d-flex flex-column justify-content-center">
            <p class="text-muted">Bilangan Pengundi:</p>
            <?php $j = 40000; 
            foreach($undi as $u){ 
                $j=$u->pengundi_jumlah; 
                $pengundi_bil = $u->pengundi_bil; 
            } ?>
            <?php echo form_open('pengundi/jumlah') ?>
            <div class="mb-3">
                <input type="text" name="pengundi_jumlah" value="<?php echo $j; ?> orang pengundi" class="form-control">
            </div>
                    
               
                    <input type="hidden" name="pengundi_bil" value="<?php echo $pengundi_bil; ?>">
                    <input type="hidden" name="dun_bil" value="<?php echo $d->dun_bil; ?>">
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?php } ?>
    
    <div class="row g-3">
        <div class="col-12">
            
                <div class="row justify-content-between mt-3">
                    <div class="col-auto">
                        <h2>PENCALONAN</h2>
                    </div>
                    <div class="col-auto">
                        <?php echo form_open('pencalonan/pilih_parti'); ?>
                            <input type="hidden" name="dun_bil" value="<?php echo $d->dun_bil; ?>">
                            <button type="submit" class="btn btn-primary w-100">Daftar Calon Baharu</button>
                        </form>
                    </div>
                </div>

                <?php if(!empty($pencalonan_dun)){ ?>
                    <div class="row g-3 mb-3">
                        <?php 
                            $satu_undi = 0;
                            $susunan = array();
                            $dua_undi = 0;
                            
                            foreach($pencalonan_dun as $calon): 
                        ?>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3 d-flex align-items-stretch">
                            <div class="p-3 border rounded d-flex flex-column align-items-center w-100">
                                <img src="<?php echo base_url('assets/img/').$ahli->foto($calon->ahli_bil); ?>" class="img-fluid mb-3" style="object-fit: cover;width: 200px;height: 200px; border-radius:100%;"/>
                                <p><?php echo anchor('ahli/id/'.$calon->ahli_bil, strtoupper($calon->ahli_nama)); ?></p>
                                <img src="<?php echo base_url('assets/img/').$parti->logo($calon->pencalonan_parti); ?>" class="img-fluid mb-3" style="object-fit: contain;width: 100px;height: 100px"/>
                                <div class="row g-3">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <?php echo anchor('pencalonan/kemaskini_calon/'.$calon->pencalonan_bil,'Kemaskini Maklumat Calon', "class='btn btn-primary w-100'" ); ?>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6"></div>
                                </div>
                                <?php echo form_open('pencalonan/padam'); ?>
                                    <input type="hidden" name="inputCalonBil" value="<?php echo $calon->pencalonan_bil; ?>">
                                    <input type="hidden" name="inputCalonAhliBil" value="<?php echo $calon->pencalonan_ahli; ?>">
                                    <button type="submit" class="btn btn-danger w-100">Padam Maklumat Calon</button>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>

                <?php if(!empty($pencalonan_dun)){ ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr class="bg-light">
                                <th class="text-center">CALON</th>
                                <th class="text-center">PARTI</th>
                                <th>OPERASI</th>
                            </tr>
                            <?php 
                            $satu_undi = 0;
                            $susunan = array();
                            $dua_undi = 0;
                            
                            foreach($pencalonan_dun as $calon): 
                                
                            ?>
                            <tr>
                                <td><div class="row justify-content-between align-items-center align-middle">
                                    <div class="col-auto">
                                        <?php echo anchor('ahli/id/'.$calon->ahli_bil, strtoupper($calon->ahli_nama)); ?>
                                    </div>
                                    <div class="col-auto"><img src="<?php echo base_url('assets/img/').$ahli->foto($calon->ahli_bil); ?>" class="img-fluid" style="object-fit: cover;width: 100px;height: 100px"/></div>
                                </div></td>
                                <td class="text-center align-items-center align-middle"><img src="<?php echo base_url('assets/img/').$parti->logo($calon->pencalonan_parti); ?>" class="img-fluid" style="object-fit: contain;width: 100px;height: 100px"/></td>
                                <td>
                                    <?php echo form_open('pencalonan/padam'); ?>
                                    <input type="hidden" name="inputCalonBil" value="<?php echo $calon->pencalonan_bil; ?>">
                                    <input type="hidden" name="inputCalonAhliBil" value="<?php echo $calon->pencalonan_ahli; ?>">
                                    <button type="submit" class="btn btn-danger">Padam Maklumat Calon</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table> 
                    </div>
                <?php } ?>

                <div class="">
            </div>
        </div>
    </div>


<?php if(!empty($senarai_calon)){ ?>                            
    <div class="row g-3">
        <div class="col">
            <div class="p-3">
                <h2>Status SISMAP</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="text-center">Tarikh</th>
                            <th class="text-center" colspan='2'>Jangkaan Keluar Mengundi</th>
                            <?php foreach($senarai_calon as $parti): ?>
                                <th class="text-center" colspan='2' style="<?php echo $parti->parti_warna; ?>">
                                    Sokong <?php echo $parti->parti_singkatan; if($parti->parti_singkatan == "BEBAS"){?>
                                    <br> <small class='text-muted'>(<?php echo $parti->ahli_nama; ?>)</small>
                                    <?php } ?>
                                </th>
                            <?php endforeach; ?>
                            <th class="text-center" colspan='2'>Atas Pagar / Undi Rosak</th>
                            <th class="text-center">Majoriti</th>
                            <th class="text-center">Peratus Majoriti</th>
                            <th class="text-center">100%</th>
                            <th class="text-center">STATUS</th>
                            <th colspan=2>Operasi</th>
                        </tr>
                        <?php $seratus = 0; foreach($senarai_tarikh as $tarikh): if($tarikh->status_grading_tarikh <= date('Y-m-d') && $tarikh->status_grading_tarikh != $tarikh_penamaan_calon){?>
                            <tr>
                                <?php echo form_open('dun/status_harian'); ?>
                                <td class="text-center">
                                    <?php $tarikh_paparan = date_create($tarikh->status_grading_tarikh);
                                    $tarikh_paparan = date_format($tarikh_paparan, 'd.m.Y'); 
                                    echo $tarikh_paparan; ?>
                                </td>
                                <?php $count=0; $keluar = 0; foreach($harian as $hari): if($tarikh->status_grading_tarikh == $hari->harian_tarikh){ ?>
                                <td class="text-center">
                                    <input type="text" name="harian_keluar_mengundi" value="<?php echo sprintf('%0.2f', $hari->harian_keluar_mengundi); ?>%">
                                    <input type="hidden" name="harian_bil" value="<?php echo $hari->harian_bil; ?>">
                                    <?php $keluar = $hari->harian_keluar_mengundi/100; if($keluar == 0){ $keluar = 65; } $pengundi = $j*$keluar; ?>
                                </td>
                                <td><?php echo floor($pengundi); ?></td>
                                <?php } $count++; endforeach; if($count==0){ ?>
                                <td>BELUM DITETAPKAN</td>
                                <?php } ?>
                                <?php   $satu = 0; $dua = 0; $penjuru = 0; $c = 1; $pengundi_kedua = 0; $pengundi_bn = 0;
                                    $tempMax = 0;
                                    foreach($senarai_calon as $p): 
                                    
                                    foreach($senarai_grading as $grading): 
                                        if(($p->pencalonan_bil == $grading->status_grading_pencalonan) && $tarikh->status_grading_tarikh == $grading->status_grading_tarikh){
                                            if($p->parti_singkatan != 'BN'){
                                                if($tempMax <= $grading->status_grading_peratus){
                                                    $tempMax = $grading->status_grading_peratus;
                                                }
                                            }
                                            
                                            if($p->parti_singkatan == 'BN'){
                                                $pengundi_bn = floor($grading->status_grading_peratus/100*$pengundi);
                                            }
                                            
                                    ?>
                                    <td class="text-center" style="<?php echo $p->parti_warna; ?>">
                                        <input type="text" name="status_grading_peratus[<?php echo $penjuru; ?>]" value="<?php  $seratus += $grading->status_grading_peratus; echo sprintf('%0.2f', $grading->status_grading_peratus); ?>%">
        
                                        <input type="hidden" name="status_grading_bil[<?php echo $penjuru; ?>]" value="<?php echo $grading->status_grading_bil; ?>">
                                        <input type="hidden" name="penjuru" value="<?php echo $penjuru;?>">
                                    </td>
                                    <td class="text-center"  style="<?php echo $p->parti_warna; ?>"><?php echo floor($grading->status_grading_peratus/100*$pengundi); ?></td>
                                <?php $penjuru++; }
                                    $pengundi_kedua = floor($tempMax/100*$pengundi);
                                    endforeach; 
                                endforeach;  ?>
                                <?php foreach($harian as $h3): if($tarikh->status_grading_tarikh == $h3->harian_tarikh){ $seratus += $h3->harian_atas_pagar; ?>
                                <td class="text-center">
                                    <input type="text" name="harian_atas_pagar" value="<?php echo sprintf('%0.2f', $h3->harian_atas_pagar); ?>%">
                                    
                                </td>
                                <td><?php echo floor($h3->harian_atas_pagar/100*$pengundi); ?></td>
                                <?php } endforeach; ?>
                                <td class="text-center"><?php $majoriti = $pengundi_bn - $pengundi_kedua; echo $majoriti; ?></td>
                                <td class="text-center"><?php echo sprintf('%0.2f', ($majoriti/$pengundi)*100); ?>%</td>
                                <td class="text-center"><?php echo $seratus; ?>%</td>
                                <?php foreach($harian as $h4): if($tarikh->status_grading_tarikh == $h4->harian_tarikh){ ?>
                                <td class="text-center" style="<?php echo $h4->harian_color; ?>"><?php echo $h4->harian_grading; ?>
                                    <input type="hidden" name="tarikh" value="<?php echo $tarikh->status_grading_tarikh; ?>">
                                </td>
                                <?php } endforeach; ?>
                                <td>
                                    <input type="hidden" name="dun_bil" value="<?php echo $d->dun_bil; ?>">
                                    <button type="submit" class="btn btn-secondary">Simpan</button>
                                    <?php echo form_open('grading/padam'); ?>
                                </td>
                                </form>
                                <td>
                                    <?php echo form_open('grading/padam'); ?>
                                    <input type="hidden" name="inputTarikh" value="<?php echo $tarikh_paparan; ?>">
                                    <input type="hidden" name="inputDunBil" value="<?php echo $d->dun_bil; ?>">
                                    <input type="hidden" name="inputPilihanrayaBil" value="<?php echo $pilihanraya_bil; ?>">
                                    <button type="submit" class = "btn btn-danger">Padam Maklumat Grading</button>
                                    </form>
                                </td>
                            </tr>
                        <?php $seratus = 0; } endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="row g-3">
    <div class="col">
        <div class="p-3">
            <em>Nota Peringatan Mesra:</em>
            <div class="p-3 border rounded">
                Diingatkan bahawa pilihanraya yang dipilih bagi semua operasi dalam sistem INTEREST ini adalah <strong><?php 
                foreach($pilihanraya as $p){
                    echo $p->pilihanraya_nama;
                }
                ?></strong>. Sila hubungi pihak urus setia untuk maklumat lanjut.
            </div>
        </div>
    </div>
</div>

<?php endforeach; ?>
</div>