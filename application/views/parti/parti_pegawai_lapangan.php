


                <?php  foreach($dun as $d): 
                    $stored = array(
                        'dun_bil' => $d->dun_bil,
                        'dun_nama' => $d->dun_nama
                    );
                    $this->session->set_userdata($stored);
                    ?>
                <div class="row g-3">
                    <div class="col">
                        <div class="p-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'INTEREST'); ?> </li>
                                    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'DUN'); ?> </li>
                                    <li class="breadcrumb-item"><?php echo anchor('dun/papar_dun/'.$d->dun_bil, strtoupper($d->dun_nama)); ?></li>
                                    <li class="breadcrumb-item active" aria-current="page">PILIH PARTI</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col">
                        <div class="p-3">
                           <h1>Pendaftaran Calon DUN <?php echo strtoupper($d->dun_nama); ?></h1> 
                           <p>Pilih Parti</p>
                               <div class="row g-3 mb-3">
                                   <?php foreach($senarai_parti as $p): ?>
                                   <div class="col-sm-12 col-lg-4">
                                               
                                               
                                                <?php echo form_open('ahli/daftar_calon/'.$d->dun_bil); ?>
                                                    <input type="hidden" name="dun_bil" value="<?php echo $d->dun_bil; ?>">
                                                    <input type="hidden" name="parti_bil" value="<?php echo $p->parti_bil; ?>">
                                                    <button type="submit" class="btn btn-outline-primary w-100 p-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-3">
                                                                <img src="<?php echo base_url('assets/img/').$parti->logo($p->parti_bil); ?>" class="img-fluid rounded" style="object-fit: contain;width: 100px;height: 100px"/>    
                                                            </div>
                                                            <div class="col-9 text-start">
                                                                <?php echo $p->parti_nama; ?>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </button>
                                                </form>  
                                               
                                           
                                   </div>
                                   <?php endforeach; ?>
                               </div>
                           <p class = "align-items-center">Jika Parti tiada dalam senarai, daftarkan parti di sini <?php echo anchor('parti/daftar', 'Tambah Parti', "class='btn btn-primary btn-sm'"); ?></p>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>



                