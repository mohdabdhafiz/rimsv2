<?php foreach($parlimen as $p):
        $stored = array(
            'parlimen_nama' => $p->pt_nama,
            'parlimen_bil' => $p->pt_bil
        );
        $this->session->set_userdata($stored);
?>
    <div class="container-fluid">
        <div class="p-3 border rounded mb-3">
            <h1 class="display-1">PARLIMEN <?php echo strtoupper($p->pt_nama); ?></h1>
            <p class="small text-muted"><?php echo $p->pt_negeri; ?></p>
            <div class="row g-3 mt-3">
                <div class="col-12">
                    <?php echo anchor('winnable_candidate/daftar', 'Tambah Pencalonan Jangkaan Calon PRU15', "class='btn btn-primary w-100'"); ?>
                </div>
            </div>
        </div>
            <div class="row g-3 mb-3">
                <div class="col-12 col-lg-3 d-flex align-self-stretch">
                    <div class="p-3 border rounded w-100 d-flex flex-column align-item-start" <?php 
                    if(!empty($data_grading->semasa_parlimen($p->pt_bil)->harian_parlimen_color)){ 
                        $status = $data_grading->semasa_parlimen($p->pt_bil)->harian_parlimen_grading;
                        ?> 
                        style="<?php echo $data_grading->semasa_parlimen($p->pt_bil)->harian_parlimen_color; ?>" 
                    <?php }else{ 
                        $status = "NA"; ?> 
                        style="background:red; color:white;" 
                    <?php } ?>>
                        <h2 class = "display-1"><?php echo $status; ?></h2>
                        <small class=" mt-auto text-end mb-2">Status Semasa</small>
                        <?php echo anchor('grading/grading_parlimen/'.$p->pt_bil, 'Ubah Grading', "class='btn btn-warning w-100'"); ?>
                    </div>
                </div>
                <div class="col-12 col-lg-3 d-flex align-self-stretch">
                    <div class="p-3 border rounded bg-light w-100 d-flex flex-column align-item-start">
                        <h2 class = "display-1"><?php echo $bilangan_calon = count($data_wc->calon_parlimen($p->pt_bil)); ?></h2>
                        <small class = "mt-auto mb-2 text-end">Pencalonan</small>
                        <?php echo anchor('winnable_candidate/daftar', 'Tambah Pencalonan', "class='btn btn-primary w-100'"); ?>
                    </div>
                </div>
                <div class="col-12 col-lg-3 d-flex align-self-stretch">
                    <div class="p-3 border rounded bg-secondary text-white w-100 d-flex flex-column align-item-start">
                        <h2 class = "display-1"><?php echo count($maklumatCalon->senaraiCalon($p->pt_bil, $pilihanrayaBil)); ?></h2>
                        <small class = "mt-auto text-end">orang pencalonan</small>
                    </div>
                </div>
                <div class="col-12 col-lg-3 d-flex align-self-stretch">
                    <div class="p-3 border rounded bg-warning w-100">
                        <div class="row g-3">
                            <?php
                            //$senaraiPengundiParlimen = $pengundiParlimen->jumlahPengundi($p->pt_bil, $pilihanrayaBil);
                            $senaraiPengundiParlimen = $pengundiParlimen->jumlah_pengundi($p->pt_bil);
                            if(!$senaraiPengundiParlimen){
                                
                            ?>
                            <div class="col">
                                <?php echo form_open('parlimen/keluar_mengundi'); ?>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <h2>Jumlah Bilangan Pengundi Semasa</h2>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" name="inputJumlahPengundi" id="inputJumlahPengundi" value="0" class = "text-center form-control form-control-lg">
                                    </div>
                                    <div class="col">
                                        <input type="hidden" name="inputParlimenBil" value="<?php echo $p->pt_bil; ?>">
                                        <input type="hidden" name="inputParlimenNama" value="<?php echo $p->pt_nama; ?>">
                                        <input type="hidden" name="inputParlimenNegeri" value="<?php echo $p->pt_negeri; ?>">
                                        <input type="hidden" name="inputPenggunaBil" value="<?php echo $this->session->userdata('pengguna_bil'); ?>">
                                        <input type="hidden" name="inputPenggunaNama" value="<?php echo $this->session->userdata('pengguna_nama'); ?>">
                                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <?php } else {
                                foreach($senaraiPengundiParlimen as $pengundi):
                                ?>
                                <div class="col">
                                <?php echo form_open('parlimen/kemaskini_pengundi'); ?>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <h2>Jumlah Bilangan Pengundi Semasa</h2>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" name="inputJumlahPengundi" id="inputJumlahPengundi" value="<?php echo $pengundi->ppt_jumlah_pengundi; ?>" class = "text-center form-control form-control-lg">
                                    </div>
                                    <div class="col">
                                        <input type="hidden" name="inputJumlahPengundiBil" value="<?php echo $pengundi->ppt_bil; ?>">
                                        <input type="hidden" name="inputParlimenBil" value="<?php echo $p->pt_bil; ?>">
                                        <button type="submit" class="btn btn-primary w-100">Kemaskini</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                                <?php endforeach; 
                            } ?>
                        </div>
                    </div>
                </div>
                
        </div>

        <div class="p-3 border rounded mb-3">
            <h3 class="display-3 mb-3">JANGKAAN CALON PRU15</h3>
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <?php foreach($data_wc->calon_parlimen($p->pt_bil) as $jangkaan): 
                                    $parti = $dataParti->parti($jangkaan->wct_parti_bil);
                                        ?>
                                <td class="text-center" valign="top">
                                    <div class="p-5" style="<?php echo $parti->parti_warna; ?>">
                                        <?php $nama_foto = $data_foto->foto($jangkaan->wct_foto_bil); ?>
                                        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" class="border mx-auto mb-3" style="object-fit: cover;width: 200px;height: 200px; border-radius: 100%;"/>
                                        <p><strong><?php echo strtoupper($jangkaan->wct_nama_penuh); ?></strong></p>
                                        <?php 
                                        $nama_foto = $data_foto->foto($parti->parti_logo); ?>
                                        <img src="<?php echo base_url('assets/img/').$nama_foto->foto_nama; ?>" class="mx-auto mt-auto" style="object-fit: contain;width: 100px;height: 100px;"/>
                                        <p><?php echo $parti->parti_singkatan; ?></p>
                                    </div>
                                </td>
                                <?php endforeach; ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <?php echo anchor('winnable_candidate/kemaskini_parlimen/'.$p->pt_bil, 'Kemaskini Maklumat Pencalonan', "class='btn btn-primary w-100'"); ?>
                </div>
            </div>
        </div>
        <?php 
        $senarai_pru = $data_pru->parlimen_pr_aktif($p->pt_bil);
        foreach($senarai_pru as $pru): 
            $pr = $data_pru->pilihanraya($pru->ppt_pilihanraya_bil); ?>
        <div class="p-3 border rounded mb-3">
            <div class="d-flex justify-content-between align-item-start">
                <h1>Pencalonan <?php echo $pr->pilihanraya_nama; ?></h1>
                <?php echo anchor('pencalonan/daftar_parlimen/'.$p->pt_bil, 'Daftar Calon', "class = 'btn btn-primary d-flex align-self-start'"); ?>
            </div>
            <?php 
            $senaraiCalon = $maklumatCalon->senarai_calon_tanpa_grading($p->pt_bil, $pr->pilihanraya_bil);
            if($senaraiCalon != FALSE){ ?>
            <div class="row g-3 mt-3">
                <?php foreach($senaraiCalon as $calon): 
                    foreach($dataParti->papar($calon->pencalonan_parlimen_partiBil) as $parti){
                        $namaParti = $parti->parti_nama;
                        $warnaParti = $parti->parti_warna;
                    }?>
                <div class="col col-lg-3">
                    <div class="p-3 border rounded text-center" style="<?php echo $warnaParti; ?>">
                    <div class="row g-1">
                        <div class="col-12 col-lg-12">
                    <img src="<?php echo base_url('assets/img/').$dataAhli->foto($calon->pencalonan_parlimen_ahliBil); ?>" class="img-fluid" style="object-fit: cover;width: 200px;height: 200px; border-radius:20px"/>

                        </div>
                        <div class="col-12 col-lg-12">
                    <img src="<?php echo base_url('assets/img/').$dataParti->logo($calon->pencalonan_parlimen_partiBil); ?>" class="img-fluid" style="object-fit: contain;width: 100px;height: 100px"/>

                        </div>
                    </div>
                        <p><?php echo $calon->pencalonan_parlimen_ahliNama; ?></p>
                        <p><?php 
                        echo $namaParti; ?></p>
                        <div class="row g-3 mt-3">
                            <div class="col-12 col-lg-12">
                            <?php echo anchor('ahli/id/'.$calon->pencalonan_parlimen_ahliBil, 'Maklumat Lanjut Calon', "class = 'btn btn-info w-100'"); ?>
                            </div>
                            <div class="col-12 col-lg-12">
                            <?php echo form_open('parlimen/padam_calon'); ?>
                        <input type="hidden" name="inputCalonParlimenBil" value="<?php echo $calon->pencalonan_parlimen_bil; ?>">
                        <input type="hidden" name="inputCalonAhliBil" value="<?php echo $calon->pencalonan_parlimen_ahliBil; ?>">
                        <input type="hidden" name="inputParlimenBil" value="<?php echo $calon->pencalonan_parlimen_parlimenBil; ?>">
                        <button type="submit" class = "btn btn-danger w-100" disabled >Padam Maklumat Calon</button>
                        </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php } ?>
        </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>