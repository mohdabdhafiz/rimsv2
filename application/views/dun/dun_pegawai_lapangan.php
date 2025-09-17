<?php foreach($dun as $d): ?>

<div class="row g-3">
    <div class="col">
        <div class="p-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEREST'); ?> </li>
                    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'DUN'); ?> </li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo strtoupper($d->dun_nama); ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col">
        <div class="p-3">

        <h1>DUN <?php echo strtoupper($d->dun_nama); ?></h1>
            <p><?php echo $d->dun_negeri; ?></p>
        </div>
    </div>
</div>

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


<div class="row g-3">

<div class="col-12">
            <div class="p-3">
                <h1>STATUS DUN</h1>
                <div class="p-3 border rounded">

                    <div class="row g-3">
                        <div class="col col-lg-4">
                            <div class="p-3">
                                <div class="border rounded text-center bg-info text-white">
                                    <p class="display-1"><?php echo $penjuru; ?></p>
                                    <p class="small">Penjuru</p>
                                </div>
                            </div>
                        </div>
                        <?php foreach($pilihan_parti as $parti): ?>
                        <div class="col col-lg-4">
                            <div class="p-3">
                                <div class="border rounded text-center text-white bg-danger">
                                    <p class="display-1"><?php echo $parti->parti_singkatan; ?></p>
                                    <p class="small">Keputusan Tidak Rasmi</p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="col col-lg-4">
                            <div class="p-3">
                                <div class="border rounded text-center bg-success text-white">
                                    <p class="display-1"><?php foreach($harian as $ha){ echo strtoupper($ha->harian_grading); } ?></p>
                                    <p class="small">Status</p>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-6">
                            <div class="p-3">
                                <div class="border rounded text-center bg-info text-white">
                                    <p class="display-1"><?php foreach($pengundi as $pen){ echo $pen->pengundi_jumlah; } ?></p>
                                    <p class="small">Pengundi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-6">
                            <div class="p-3">
                                <div class="border rounded text-center bg-info text-white">
                                    <p class="display-1"><?php foreach($harian as $ha){ echo $ha->harian_atas_pagar; } ?>%</p>
                                    <p class="small">Pengundi Atas Pagar / Undi Rosak</p>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-12">
                            <div class="p-3">
                                <h1>Status Mengundi</h1>
                                <div class="row g-3">
                                    <?php foreach($pengundi as $peng): ?>
                                    <div class="col">
                                    Bilangan Pengundi Berdaftar / Keseluruhan: 
                                    <?php echo form_open('pengundi/jumlah'); ?>
                                    <input type="hidden" name="dun_bil" value="<?php echo $d->dun_bil; ?>">
                                    <input type="hidden" name="pengundi_bil" value="<?php echo $peng->pengundi_bil; ?>">
                                    <input type="text" name="pengundi_jumlah" value="<?php echo $peng->pengundi_jumlah; ?>" class="w-100 text-center form-control mb-1" style="height:100px; font-size:50pt">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Simpan</button>
                                    </form>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php foreach($harian as $h): ?>
                                    <div class="col">
                                    Pengundi Atas Pagar / Undi Rosak: 
                                    
                                    <?php echo form_open('harian/atas_pagar'); ?>
                                    <input type="text" name="harian_atas_pagar" value="<?php echo $h->harian_atas_pagar; ?>%" class="w-100 text-center form-control mb-1" style="height:100px; font-size:50pt">
                                    <input type="hidden" name="dun_bil" value="<?php echo $d->dun_bil; ?>">
                                    <input type="hidden" name="harian_bil" value="<?php echo $h->harian_bil; ?>">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Simpan</button>
                                    </form>
                                    
                                    </div>
                                    <div class="col">
                                    Status Grading: 
                                    <?php echo form_open('harian/grading'); ?>
                                    <input type="text" name="harian_grading" value="<?php echo $h->harian_grading; ?>" class="w-100 text-center form-control mb-1" style="height:100px; font-size:50pt">
                                    <input type="hidden" name="dun_bil" value="<?php echo $d->dun_bil; ?>">
                                    <input type="hidden" name="harian_bil" value="<?php echo $h->harian_bil; ?>">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Simpan</button>
                                    </form>
                                    </div>
                                    <div class="col">
                                    Peratusan Keluar Mengundi: 
                                    <?php echo form_open('harian/keluar_mengundi'); ?>
                                    <input type="text" name="harian_keluar_mengundi" value="<?php echo $h->harian_keluar_mengundi; ?>" class="w-100 text-center form-control mb-1" style="height:100px; font-size:50pt">
                                    <input type="hidden" name="dun_bil" value="<?php echo $d->dun_bil; ?>">
                                    <input type="hidden" name="harian_bil" value="<?php echo $h->harian_bil; ?>">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">Simpan</button>
                                    </form>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    <div class="col-12">
        <div class="p-3">


        <h1>CALON</h1>
            <div class="p-3 border rounded">



                <div class="row g-3">

                <?php if(!$kira_betul) { ?>
                <div class="col-12">
                    <div class="p-3 border rounded bg-warning">
                        Kiraan tidak tepat. Sila berhubung dengan pihak urus setia.
                    </div>
                </div>
                <?php } ?>

                

                    <div class="col mb-3">
                        <div class="row g-3">
                            <div class="col-auto">
                                <?php echo form_open('pencalonan/pilih_parti'); ?>
                                <input type="hidden" name="dun_bil" value="<?php echo $d->dun_bil; ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Daftar Calon</button>
                                </form>
                            </div>
                            <div class="col-auto border">
                                <?php echo form_open('grading/set_tarikh'); ?>
                                <select name="tarikh">
                                    <?php 
                                    $bilangan_hari = 14;
                                    for($i=0;$i<$bilangan_hari;$i++){ ?>
                                    <option>Tarikh</option>
                                    <?php } ?>
                                </select>
                                <button type="submit">Pilih</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                    
                </div>

                <div class="row g-3">

                
                
                <?php foreach($calon_daftar as $c): ?>
                    <div class="col-sm-12 col-lg-4">
                        
                            <div class="p-3 border rounded">
                                <div class="row g-1 align-items-center">
                                    <div class="col-12 text-end">
                                        <div class="row g-1 justify-content-end">
                                            <div class="col-auto">
                                                <?php echo anchor('ahli/kemaskini/'.$c->ahli_bil, 'Kemaskini', "class='btn btn-sm btn-primary'"); ?>

                                            </div>
                                            <div class="col-auto">
                                            <?php echo form_open('pencalonan/padam'); ?>
                                            <input type="hidden" name="pencalonan_bil" value="<?php echo $c->pencalonan_bil; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm w-10">X</button>
                                            </form>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="col-5 text-center">
                                    <img src="<?php echo base_url('assets/img/').$ahli->foto($c->ahli_bil); ?>" class="img-fluid rounded" style="object-fit: cover;width: 100px;height: 100px"/>
                                    <div ><?php echo $c->ahli_jantina; ?></div>
                                    </div>
                                    <div class="col-7">
                                        
                                        <p><strong><?php echo anchor('ahli/id/'.$c->ahli_bil, $c->ahli_nama); ?></strong> (<?php echo $c->ahli_umur; ?>)
                                        <br><?php echo anchor('parti/id/'.$c->parti_bil, $c->parti_nama." (".$c->parti_singkatan.")"); ?></p>
                                        
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="p-3 border rounded">
                                            <?php foreach($status_grading as $status): 
                                                if($status->pencalonan_bil == $c->pencalonan_bil){?>
                                            <?php echo form_open('grading/kemaskini'); ?>      
                                            Sokongan Hari ini: <br>
                                            <input type="text" name="status_grading_peratus" value="<?php echo $status->status_grading_peratus; ?>%" class="w-100 text-center display-1" style="border:none">
                                            <input type="hidden" name="dun_bil" value="<?php echo $d->dun_bil; ?>">
                                            <input type="hidden" name="status_grading_bil" value="<?php echo $status->status_grading_bil; ?>">
                                            <button type="submit" class="w-100 btn btn-primary btn-sm">Simpan</button>
                                            </form> 
                                            <?php } endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                <?php endforeach; ?>

                </div>


            </div>
        </div>


        

    </div>
<?php endforeach; ?>

