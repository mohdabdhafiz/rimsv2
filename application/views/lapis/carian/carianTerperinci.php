
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Carian Terperinci</h1>
            <?= form_open('lapis/carianTerperinci') ?>
            <div class="row g-3">
                <div class="col-12 col-lg-4 d-flex align-items-stretch">
                    <div class="form-floating w-100 d-flex flex-column">
                        <input type="date" name="inputTarikhMula" id="inputTarikhMula" required class="form-control" value=<?= set_value("inputTarikhMula") ?>>
                        <label for="inputTarikhMula" class="form-label">Tarikh Mula Laporan:</label>
                        <?= form_error('inputTarikhMula', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-12 col-lg-4 d-flex align-items-stretch">
                    <div class="form-floating w-100 d-flex flex-column">
                        <input type="date" name="inputTarikhTamat" id="inputTarikhTamat" required class="form-control" value=<?= set_value("inputTarikhTamat") ?>>
                        <label for="inputTarikhTamat" class="form-label">Tarikh Tamat Laporan:</label>
                        <?= form_error('inputTarikhTamat', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-12 col-lg-4 d-flex align-items-stretch">
                    <div class="form-floating w-100 d-flex flex-column">
                        <select name="inputPelapor" id="inputPelapor" class="form-control">
                            <option value="">SEMUA</option>
                            <?php foreach($senaraiPelapor as $pelapor): ?>
                                <option value="<?= $pelapor->penggunaBil ?>" <?= set_select('inputPelapor', $pelapor->penggunaBil); ?>><?= $pelapor->penggunaNama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputPelapor" class="form-label">Pelapor:</label>
                    </div>
                </div>    
                <div class="col-12 col-lg-4 d-flex align-items-stretch">
                    <div class="form-floating w-100 d-flex flex-column">
                        <select name="inputNegeri" id="inputNegeri" class="form-control">
                            <option value="">SEMUA</option>
                            <?php foreach($senaraiNegeri as $negeri): ?>
                                <option value="<?= $negeri->negeriBil ?>" <?= set_select('inputNegeri', $negeri->negeriBil); ?>><?= $negeri->negeriNama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputNegeri" class="form-label">Negeri:</label>
                    </div>
                </div> 
                <div class="col-12 col-lg-4 d-flex align-items-stretch">
                    <div class="form-floating w-100 d-flex flex-column">
                        <select name="inputDaerah" id="inputDaerah" class="form-control">
                            <option value="">SEMUA</option>
                            <?php foreach($senaraiDaerah as $daerah): ?>
                                <option value="<?= $daerah->daerahBil ?>" <?= set_select('inputDaerah', $daerah->daerahBil); ?>><?= $daerah->daerahNama ?> [<?= $daerah->negeriNama ?>]</option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputDaerah" class="form-label">Daerah:</label>
                    </div>
                </div>  
                <div class="col-12 col-lg-4 d-flex align-items-stretch">
                    <div class="form-floating w-100 d-flex flex-column">
                        <select name="inputParlimen" id="inputParlimen" class="form-control">
                            <option value="">SEMUA</option>
                            <?php foreach($senaraiParlimen as $parlimen): ?>
                                <option value="<?= $parlimen->parlimenBil ?>" <?= set_select('inputParlimen', $parlimen->parlimenBil); ?>><?= $parlimen->parlimenNama ?> [<?= $parlimen->negeriNama ?>]</option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputParlimen" class="form-label">Parlimen:</label>
                    </div>
                </div>      
                <div class="col-12 col-lg-4 d-flex align-items-stretch">
                    <div class="form-floating w-100 d-flex flex-column">
                        <select name="inputDun" id="inputDun" class="form-control">
                            <option value="">SEMUA</option>
                            <?php foreach($senaraiDun as $dun): ?>
                                <option value="<?= $dun->dunBil ?>" <?= set_select('inputDun', $dun->dunBil); ?>><?= $dun->dunNama ?> [<?= $dun->negeriNama ?>]</option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputDun" class="form-label">DUN:</label>
                    </div>
                </div>          
                <div class="col-12 col-lg-4 d-flex align-items-stretch">
                    <div class="form-floating w-100 d-flex flex-column">
                        <select name="inputKawasan" id="inputKawasan" class="form-control">
                            <option value="">SEMUA</option>
                            <?php foreach($senaraiKawasan as $kawasan): ?>
                                <option value="<?= $kawasan ?>" <?= set_select('inputKawasan', $kawasan); ?>><?= strtoupper($kawasan) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputKawasan" class="form-label">Kawasan:</label>
                    </div>
                </div>        
                <div class="col-12 col-lg-4 d-flex align-items-stretch">
                    <div class="form-floating w-100 d-flex flex-column">
                        <select name="inputKluster" id="inputKluster" class="form-control">
                            <option value="">SEMUA</option>
                            <?php foreach($senaraiKluster as $kluster): ?>
                                <option value="<?= $kluster->kitBil ?>" <?= set_select('inputKluster', $kluster->kitBil); ?>><?= $kluster->kitNama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputKluster" class="form-label">Kluster Isu:</label>
                    </div>
                </div>          
                <div class="col-12 col-lg-4 d-flex align-items-stretch">
                    <div class="w-100 d-flex flex-column">
                        <div class="row g-3">
                            <div class="col-6">
                        <button type="submit" class="btn btn-success w-100">Cari</button>

                            </div>
                            <div class="col-6">
                        <button type="reset" class="btn btn-secondary w-100">Set Semula</button>

                            </div>
                        </div>
                    </div>
                </div>     
            </div>
            <?= form_close() ?>
        </div>
    </div>