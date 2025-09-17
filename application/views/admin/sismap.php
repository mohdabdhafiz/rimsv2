<?php foreach($pilihanraya as $pru): ?>

<div class="row g-3">

    <div class="col-12">
        <div class="p-3 text-center">
            <h1>SISMAP GRADING <?php echo strtoupper($pru->pilihanraya_nama); ?></h1>
        </div>
    </div>

    <div class="col-12">
        <div class="p-3">
            <h2>GRADING</h2>
            <div class="p-3 border rounded">
                <div class="row g-3">

                    <div class="col col-lg-6">
                        <div class="p-3">
                            <h3>Rumusan Mengikut DUN</h3>
                            <div class="p-3 border rounded">
                                <?php echo form_open('dun/rumusan'); ?>
                                <select name="dun_bil" class="w-100 mb-2 form-control">
                                    <?php foreach($senarai_dun as $dun): ?>
                                    <option value="<?php echo $dun->dun_bil; ?>"><?php echo $dun->dun_nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="pilihanraya_bil" value="<?php echo $pru->pilihanraya_bil; ?>">
                                <button type="submit" class="btn btn-sm btn-primary">Papar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col col-lg-6">
                        <div class="p-3">
                            <h3>Rumusan Mengikut Parti</h3>
                            <div class="p-3 border rounded">
                                <?php echo form_open('parti/rumusan'); ?>
                                <select name="parti_bil" class="w-100 mb-2 form-control">
                                    <?php foreach($senarai_parti as $parti): ?>
                                    <option value="<?php echo $parti->parti_bil; ?>"><?php echo $parti->parti_nama; ?> (<?php echo strtoupper($parti->parti_singkatan);?>) </option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="pilihanraya_bil" value="<?php echo $pru->pilihanraya_bil; ?>">
                                <button type="submit" class="btn btn-sm btn-primary">Papar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>







</div>

<?php endforeach; ?>