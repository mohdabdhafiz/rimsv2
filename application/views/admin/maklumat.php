<?php foreach($pilihanraya as $pr): ?>

<div class="row g-3">
    <div class="col-12">
        <div class="p-3">
            <h1><?php echo $pr->pilihanraya_nama; ?></h1>
        </div>
    </div>
</div>

<div class="row g-3">

<div class="col-12">
        <div class="p-3">
            <h2>Senarai Parlimen dan Calon</h2>
            <div class="p-3 border rounded">
                <table class="table">
                    <tr>
                        <th>BIL</th>
                        <th>DUN</th>
                        <th>CALON</th>
                    </tr>
                    <?php $count=1; foreach($senarai_pencalonan_parlimen as $dun): 
                        $parlimen = $data_parlimen->parlimen_bil($dun->pencalonan_parlimen_parlimenBil); ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $parlimen->pt_nama; $kosong = TRUE; ?><br>
                                <?php foreach($senarai_calon as $c): if($c->pencalonan_parlimen_jangkaan_japen == 'MENANG' && $c->pencalonan_parlimen_parlimenBil == $dun->pencalonan_parlimen_parlimenBil){?>
                                    <div class="m-1 p-3 border rounded">Pilihan JaPen : <?php echo anchor('ahli/id/'.$c->ahli_bil, $c->ahli_nama); ?> dari <?php echo $c->parti_singkatan; ?></div>
                                    <?php $kosong = FALSE; } endforeach; ?>
                                    <?php foreach($senarai_calon as $c): if($c->pencalonan_keputusan_tidak_rasmi == 'MENANG' && $c->dun_bil == $dun->dun_bil){?>
                                    <div class="m-1 p-3 border rounded">Keputusan Tidak Rasmi : <?php echo anchor('ahli/id/'.$c->ahli_bil, $c->ahli_nama); ?> dari <?php echo $c->parti_singkatan; ?></div>
                                    <?php $kosong = FALSE; } endforeach; ?>
                                    <?php foreach($senarai_calon as $c): if($c->pencalonan_keputusan_sebenar == 'MENANG' && $c->dun_bil == $dun->dun_bil){?>
                                    <div class="m-1 p-3 border rounded">Keputusan Sebenar : <?php echo anchor('ahli/id/'.$c->ahli_bil, $c->ahli_nama); ?> dari <?php echo $c->parti_singkatan; ?></div>
                                    <?php $kosong = FALSE; } endforeach; ?>
                                    <?php if($kosong){ ?>
                                        <div class="m-1 p-3 border rounded bg-warning text-center">PILIHAN BELUM DITETAPKAN</div>
                                    <?php } ?>
                                    <?php echo anchor('dun/papar_dun/'.$dun->dun_bil, 'Kemaskini Maklumat DUN', "class='btn btn-primary btn-sm m-1'"); ?>
                            </td>
                            <td>
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                <?php foreach($senarai_calon as $calon): if($calon->dun_bil == $dun->dun_bil){?>
                                <tr>
                                    <td class="text-center"><img src="<?php echo base_url('assets/img/').$parti->logo($calon->pencalonan_parti); ?>" class="img-fluid rounded" style="object-fit: cover;width: 50px;height: 50px"/>
</td>
                                    <td><?php echo anchor('ahli/id/'.$calon->ahli_bil, $calon->ahli_nama); ?><br /><?php echo $calon->parti_nama; ?>
                                    <br />
                                    <?php if(date("Y-m-d") < $pr->pilihanraya_lock_status){echo form_open('pencalonan/padam'); ?>
                                    <input type="hidden" name="pencalonan_bil" value="<?php echo $calon->pencalonan_bil; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Padam Pencalonan</button>
                                    </form>
                                    <?php } ?>
                                    </td>
                                    <?php if(date("Y-m-d") < $pr->pilihanraya_lock_status){ ?>
                                    <td class="text-center">
                                        <?php echo form_open('pilihanraya/pilih_japen'); ?>
                                        <input type="hidden" name="pencalonan_bil" value="<?php echo $calon->pencalonan_bil; ?>">
                                        <input type="hidden" name="pilihanraya_bil" value="<?php echo $calon->pencalonan_pilihanraya; ?>">
                                        <input type="hidden" name="dun_bil" value="<?php echo $calon->pencalonan_dun; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">Pilihan JaPen</button>
                                        </form> 
                                    </td>
                                    <?php } ?>
                                    <td class="text-center">
                                        <?php echo form_open('pilihanraya/tidak_rasmi'); ?>
                                            <input type="hidden" name="pencalonan_bil" value="<?php echo $calon->pencalonan_bil; ?>">
                                            <input type="hidden" name="pilihanraya_bil" value="<?php echo $calon->pencalonan_pilihanraya; ?>">
                                            <input type="hidden" name="dun_bil" value="<?php echo $calon->pencalonan_dun; ?>">
                                            <button type="submit" class="btn btn-warning btn-sm">Keputusan Tidak Rasmi</button>
                                        </form>
                                    </td>
                                    <td class="text-center"><?php echo form_open('pilihanraya/keputusan'); ?>
                                        <input type="hidden" name="pencalonan_bil" value="<?php echo $calon->pencalonan_bil; ?>">
                                        <input type="hidden" name="pilihanraya_bil" value="<?php echo $calon->pencalonan_pilihanraya; ?>">
                                        <input type="hidden" name="dun_bil" value="<?php echo $calon->pencalonan_dun; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">Menang Rasmi</button>
                                </form> </td>
                                </tr>
                                <?php } endforeach; ?>
                            </table></div></td>
                        </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="p-3">
            <h2>Senarai DUN dan Calon</h2>
            <div class="p-3 border rounded">
                <table class="table">
                    <tr>
                        <th>BIL</th>
                        <th>DUN</th>
                        <th>CALON</th>
                    </tr>
                    <?php $count=1; foreach($senarai_dun as $dun): ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo $dun->dun_nama; $kosong = TRUE; ?><br>
                                <?php foreach($senarai_calon as $c): if($c->pencalonan_jangkaan_japen == 'MENANG' && $c->dun_bil == $dun->dun_bil){?>
                                    <div class="m-1 p-3 border rounded">Pilihan JaPen : <?php echo anchor('ahli/id/'.$c->ahli_bil, $c->ahli_nama); ?> dari <?php echo $c->parti_singkatan; ?></div>
                                    <?php $kosong = FALSE; } endforeach; ?>
                                    <?php foreach($senarai_calon as $c): if($c->pencalonan_keputusan_tidak_rasmi == 'MENANG' && $c->dun_bil == $dun->dun_bil){?>
                                    <div class="m-1 p-3 border rounded">Keputusan Tidak Rasmi : <?php echo anchor('ahli/id/'.$c->ahli_bil, $c->ahli_nama); ?> dari <?php echo $c->parti_singkatan; ?></div>
                                    <?php $kosong = FALSE; } endforeach; ?>
                                    <?php foreach($senarai_calon as $c): if($c->pencalonan_keputusan_sebenar == 'MENANG' && $c->dun_bil == $dun->dun_bil){?>
                                    <div class="m-1 p-3 border rounded">Keputusan Sebenar : <?php echo anchor('ahli/id/'.$c->ahli_bil, $c->ahli_nama); ?> dari <?php echo $c->parti_singkatan; ?></div>
                                    <?php $kosong = FALSE; } endforeach; ?>
                                    <?php if($kosong){ ?>
                                        <div class="m-1 p-3 border rounded bg-warning text-center">PILIHAN BELUM DITETAPKAN</div>
                                    <?php } ?>
                                    <?php echo anchor('dun/papar_dun/'.$dun->dun_bil, 'Kemaskini Maklumat DUN', "class='btn btn-primary btn-sm m-1'"); ?>
                            </td>
                            <td>
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                <?php foreach($senarai_calon as $calon): if($calon->dun_bil == $dun->dun_bil){?>
                                <tr>
                                    <td class="text-center"><img src="<?php echo base_url('assets/img/').$parti->logo($calon->pencalonan_parti); ?>" class="img-fluid rounded" style="object-fit: cover;width: 50px;height: 50px"/>
</td>
                                    <td><?php echo anchor('ahli/id/'.$calon->ahli_bil, $calon->ahli_nama); ?><br /><?php echo $calon->parti_nama; ?>
                                    <br />
                                    <?php if(date("Y-m-d") < $pr->pilihanraya_lock_status){echo form_open('pencalonan/padam'); ?>
                                    <input type="hidden" name="pencalonan_bil" value="<?php echo $calon->pencalonan_bil; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Padam Pencalonan</button>
                                    </form>
                                    <?php } ?>
                                    </td>
                                    <?php if(date("Y-m-d") < $pr->pilihanraya_lock_status){ ?>
                                    <td class="text-center">
                                        <?php echo form_open('pilihanraya/pilih_japen'); ?>
                                        <input type="hidden" name="pencalonan_bil" value="<?php echo $calon->pencalonan_bil; ?>">
                                        <input type="hidden" name="pilihanraya_bil" value="<?php echo $calon->pencalonan_pilihanraya; ?>">
                                        <input type="hidden" name="dun_bil" value="<?php echo $calon->pencalonan_dun; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">Pilihan JaPen</button>
                                        </form> 
                                    </td>
                                    <?php } ?>
                                    <td class="text-center">
                                        <?php echo form_open('pilihanraya/tidak_rasmi'); ?>
                                            <input type="hidden" name="pencalonan_bil" value="<?php echo $calon->pencalonan_bil; ?>">
                                            <input type="hidden" name="pilihanraya_bil" value="<?php echo $calon->pencalonan_pilihanraya; ?>">
                                            <input type="hidden" name="dun_bil" value="<?php echo $calon->pencalonan_dun; ?>">
                                            <button type="submit" class="btn btn-warning btn-sm">Keputusan Tidak Rasmi</button>
                                        </form>
                                    </td>
                                    <td class="text-center"><?php echo form_open('pilihanraya/keputusan'); ?>
                                        <input type="hidden" name="pencalonan_bil" value="<?php echo $calon->pencalonan_bil; ?>">
                                        <input type="hidden" name="pilihanraya_bil" value="<?php echo $calon->pencalonan_pilihanraya; ?>">
                                        <input type="hidden" name="dun_bil" value="<?php echo $calon->pencalonan_dun; ?>">
                                        <button type="submit" class="btn btn-primary btn-sm">Menang Rasmi</button>
                                </form> </td>
                                </tr>
                                <?php } endforeach; ?>
                            </table></div></td>
                        </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

</div>

<?php endforeach; ?>