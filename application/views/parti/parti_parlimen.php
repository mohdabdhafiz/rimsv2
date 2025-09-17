<?php  foreach($senaraiParlimen as $parlimen): ?>
<div class="container-fluid">
    <div class="p-3 border rounded shadow bg-light pb-0 mb-3">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><?php echo anchor('pilihanraya/pilih_negeri/'.$negeri_bil, $negeri_nama); ?></li>
                                    <li class="breadcrumb-item"><?php echo anchor('parlimen/papar_parlimen/'.$parlimen->pt_bil, $parlimen->pt_nama); ?></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pendaftaran Calon Parlimen</li>
                                </ol>
                            </nav>
                        </div>

                <div class="row g-3 mb-3">
                    <div class="col">
                        <div class="p-3 border rounded shadow">
                           <h1>Pendaftaran Calon Parlimen <?php echo strtoupper($parlimen->pt_nama); ?></h1> 
                           <p>Pilih Parti</p>
                               <div class="row g-3 mb-3">
                                   <?php $senaraiParti = $parti->papar_semua(); 
                                   foreach($senaraiParti as $p): ?>
                                   <div class="col-sm-12 col-lg-4">
                                               
                                               
                                                <?php echo form_open('ahli/daftar_parlimen'); ?>
                                                    <input type="hidden" name="inputParlimenBil" value="<?php echo $parlimen->pt_bil; ?>">
                                                    <input type="hidden" name="inputPartiBil" value="<?php echo $p->parti_bil; ?>">
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
                        </div>
                    </div>
                </div>
                <div class="p-3 border rounded shadow mb-3">
                    <p class = "align-items-center">Jika Parti tiada dalam senarai, daftarkan parti di sini </p>
                    <?php echo anchor('parti/daftar', 'Tambah Parti', "class='btn btn-primary w-100'"); ?>
                </div>
            </div>
<?php endforeach; ?>



                