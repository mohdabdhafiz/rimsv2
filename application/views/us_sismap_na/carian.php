<div class="card">
        <div class="card-body">
            <h5 class="card-title">
            <i class="bi bi-search"></i>    
            Carian</h5>
            <?= form_open('program/keputusanCarian') ?>
            <div class="row g-3">
                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <select name="inputJenis" id="inputJenis" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiJenis as $jenis): ?>
                                <option value="<?= $jenis->jt_bil ?>"><?= $jenis->jt_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputJenis" class="form-label">1. Nama Program</label>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <select name="inputNegeri" id="inputNegeri" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiNegeri as $negeri): ?>
                                <option value="<?= $negeri->nt_bil ?>"><?= $negeri->nt_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputNegeri" class="form-label">2. Negeri</label>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <select name="inputDaerah" id="inputDaerah" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiDaerah as $daerah): ?>
                                <option value="<?= $daerah->bil ?>"><?= $daerah->nt_nama ?> - <?= $daerah->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputDaerah" class="form-label">3. Daerah</label>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <select name="inputParlimen" id="inputParlimen" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiParlimen as $parlimen): ?>
                                <option value="<?= $parlimen->pt_bil ?>"><?= $parlimen->nt_nama ?> - <?= $parlimen->pt_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputParlimen" class="form-label">4. Parlimen</label>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <select name="inputDun" id="inputDun" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiDun as $dun): ?>
                                <option value="<?= $dun->dun_bil ?>"><?= $dun->nt_nama ?> - <?= $dun->dun_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputDun" class="form-label">5. DUN</label>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <select name="inputStatus" id="inputStatus" class="form-control">
                            <option value="">Sila Pilih..</option>
                            <?php foreach($senaraiStatus as $status): ?>
                                <option value="<?= $status->program_status ?>"><?= $status->program_status ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="inputStatus" class="form-label">6. Status Laporan</label>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <input type="date" name="inputTarikhMula" id="inputTarikhMula" placeholder="7. Tarikh Mula" class="form-control">
                        <label for="inputTarikhMula" class="form-label">7. Tarikh Mula</label>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="form-floating">
                        <input type="date" name="inputTarikhTamat" id="inputTarikhTamat" placeholder="8. Tarikh Tamat" class="form-control">
                        <label for="inputTarikhTamat" class="form-label">8. Tarikh Tamat</label>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-6 col-sm-12">
                    <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="bi bi-search"></i>
                        Cari
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>