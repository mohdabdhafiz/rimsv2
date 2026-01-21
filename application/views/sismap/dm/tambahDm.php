<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">



    <section class="section">

    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">RIMS@SISMAP</a></li>
                <li class="breadcrumb-item"><a href="<?= site_url('dm') ?>">DAERAH MENGUNDI</a></li>
                <li class="breadcrumb-item active">DAERAH MENGUNDI PARLIMEN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Daerah Mengundi</h5>

                    <?php if(validation_errors()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            <?php echo validation_errors(); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open('parlimen/proses_tambah_dm', ['class' => 'row g-3']); ?>
                        
                        <div class="col-12">
                            <label for="input_parlimen_bil" class="form-label">1. Pilih Parlimen</label>
                            <select name="input_parlimen_bil" id="input_parlimen_bil" class="form-select" autofocus>
                                <option value="0" selected>Sila Pilih...</option>
                                <?php foreach($senarai_parlimen as $parlimen): ?>
                                    <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->pt_nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="input_nama_dm" class="form-label">2. Nama Daerah Mengundi</label>
                            <input type="text" name="input_nama_dm" id="input_nama_dm" class="form-control" placeholder="Cth: 082/12/01 CHERATING">
                        </div>

                        <div class="col-12">
                            <label for="input_bilangan_pengundi" class="form-label">3. Bilangan Pengundi</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-people"></i></span>
                                <input type="number" name="input_bilangan_pengundi" id="input_bilangan_pengundi" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-save me-1"></i> Simpan Maklumat
                            </button>
                        </div>
                        <p class="text-muted small mb-0 text-end">BORANG-SISMAP-01: PENAMBAHAN MAKLUMAT DAERAH MENGUNDI PARLIMEN</p>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            
            <?php foreach($senarai_parlimen as $parlimen): ?>
                <?php 
                    $senarai_pdm = $data_pdm->parlimen($parlimen->pt_bil); 
                    // Only show card if data exists
                    if(count($senarai_pdm) > 0):
                ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $parlimen->pt_nama; ?> 
                            <span class="badge bg-secondary ms-2 text-white" style="font-size: 0.7em;"><?= count($senarai_pdm) ?> DM</span>
                        </h5>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" width="5%" class="text-center">#</th>
                                        <th scope="col" width="45%">Daerah Mengundi (DM)</th>
                                        <th scope="col" width="20%">Bil. Pengundi</th>
                                        <th scope="col" width="30%" class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1; 
                                    foreach($senarai_pdm as $pdm): ?>
                                    <tr>
                                        <?php echo form_open('parlimen/proses_kemaskini_pdm', ['style' => 'display: contents;']); ?>
                                            
                                            <td class="text-center"><?= $count++ ?></td>
                                            
                                            <td>
                                                <input type="text" name="input_nama_dm" class="form-control form-control-sm" value="<?= $pdm->ppt_nama ?>">
                                            </td>
                                            
                                            <td>
                                                <input type="number" name="input_bilangan_pengundi" class="form-control form-control-sm" value="<?= $pdm->ppt_bilangan_pengundi ?>">
                                            </td>
                                            
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <input type="hidden" name="input_dm_bil" value="<?= $pdm->ppt_bil ?>">
                                                    
                                                    <button type="submit" class="btn btn-sm btn-success" title="Kemaskini">
                                                        <i class="bi bi-check-lg"></i>
                                                    </button>
                                        </form> 
                                        <?php echo form_open('parlimen/proses_padam_pdm', ['onsubmit' => "return confirm('Adakah anda pasti?');", 'style' => 'display: inline-block;']); ?>
                                                    <input type="hidden" name="input_dm_bil" value="<?= $pdm->ppt_bil ?>">
                                                    
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Padam">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </form>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <p class="text-muted small mb-0 text-end">BORANG-SISMAP-02: BORANG MENGEMASKINI MAKLUMAT DAERAH MENGUNDI PARLIMEN</p>
                        </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>
</section>


</main>


<?php $this->load->view($footer); ?>