
    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS@SISMAP'); ?></li>
                <li class="breadcrumb-item">DAERAH MENGUNDI</li>
                <li class="breadcrumb-item active">DAERAH MENGUNDI DUN</li>
            </ol>
        </nav>
    </div><section class="section">
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

                        <?php echo form_open('dun/proses_tambah_dm', ['class' => 'row g-3']); ?>
                        
                        <div class="col-12">
                            <label for="input_dun_bil" class="form-label fw-bold">1. Pilih DUN</label>
                            <select name="input_dun_bil" id="input_dun_bil" class="form-select" autofocus>
                                <option value="0">Sila Pilih...</option>
                                <?php foreach($senarai_dun as $dun): ?>
                                    <option value="<?= $dun->dun_bil ?>"><?= $dun->dun_nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="input_nama_dm" class="form-label fw-bold">2. Nama Daerah Mengundi</label>
                            <input type="text" name="input_nama_dm" id="input_nama_dm" class="form-control" placeholder="Cth: 082/12/01 CHERATING">
                        </div>

                        <div class="col-12">
                            <label for="input_bilangan_pengundi" class="form-label fw-bold">3. Bilangan Pengundi</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                                <input type="number" name="input_bilangan_pengundi" id="input_bilangan_pengundi" class="form-control">
                            </div>
                        </div>

                        <div class="text-center mt-4 mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-save me-1"></i> Simpan Maklumat
                            </button>
                        </div>
                        <?php echo form_close(); ?>
                        <p class="small text-muted text-end mb-0">BORANG-SISMAP-03 : BORANG PENAMBAHAN MAKLUMAT DAERAH MENGUNDI DUN</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                
                <?php foreach($senarai_dun as $dun): ?>
                    <?php 
                        $senarai_pdm = $data_pdm->dun($dun->dun_bil); 
                        // Only show card if data exists to keep UI clean
                        if(count($senarai_pdm) > 0):
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= $dun->dun_nama; ?> 
                                <span class="badge bg-secondary text-white ms-2" style="font-size:0.6em"><?= count($senarai_pdm) ?> DM</span>
                            </h5>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="text-center" width="5%">#</th>
                                            <th scope="col" width="45%">Daerah Mengundi (DM)</th>
                                            <th scope="col" width="20%">Bil. Pengundi</th>
                                            <th scope="col" class="text-center" width="30%">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1; 
                                        foreach($senarai_pdm as $pdm): ?>
                                        <tr>
                                            <?php echo form_open('dun/proses_kemaskini_pdm', ['style' => 'display:contents']); ?>
                                                <td class="text-center"><?= $count++ ?></td>
                                                <td>
                                                    <input type="text" name="input_nama_dm" class="form-control form-control-sm" value="<?= $pdm->pdt_nama ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="input_bilangan_pengundi" class="form-control form-control-sm" value="<?= $pdm->pdt_bilangan_pengundi ?>">
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <input type="hidden" name="input_dm_bil" value="<?= $pdm->pdt_bil ?>">
                                                        <button type="submit" class="btn btn-sm btn-success" title="Simpan Kemaskini">
                                                            <i class="bi bi-check-lg"></i>
                                                        </button>
                                            <?php echo form_close(); ?>
                                            <?php echo form_open('dun/proses_padam_pdm', ['style' => 'display:inline-block', 'onsubmit' => "return confirm('Adakah anda pasti mahu memadam data ini?');"]); ?>
                                                        <input type="hidden" name="input_dm_bil" value="<?= $pdm->pdt_bil ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Padam">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                            <?php echo form_close(); ?>
                                            </div>
                                                </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <p class="small text-muted text-end">BORANG-SISMAP-04 : BORANG MENGEMASKINI MAKLUMAT DAERAH MENGUNDI DUN</p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
