<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?= anchor('daerah', 'Daerah') ?></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $negeri->nt_nama ?></li>
  </ol>
</nav>

<div class="p-3 border rounded mb-3">
    <p><strong><?= $negeri->nt_nama ?></strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <tr>
                <th>Bilangan Daerah</th>
                <td><?= count($senaraiDaerah) ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="p-3 border rounded mb-3">
    <p><strong>Tambah Daerah</strong></p>
    <?= validation_errors() ?>
    <?= form_open('daerah/tambah_daerah') ?>
    <div class="mb-3">
        <label for="input_nama" class="form-label">1) Nama Daerah:</label>
        <input type="text" name="input_nama" id="input_nama" class="form-control form-control-sm" value="<?php echo set_value('input_nama'); ?>">
    </div>
    <input type="hidden" name="input_negeri_bil" value="<?= $negeri->nt_bil ?>">
    <button type="submit" class="btn btn-sm btn-primary w-100">Tambah</button>
    </form>
</div>

<div class="p-3 border rounded mb-3">
    <p><strong>Senarai Daerah Bagi <?= $negeri->nt_nama ?></strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <tr>
                <th>#</th>
                <th>Nama Daerah</th>
                <th>Operasi</th>
            </tr>
            <?php
            $bilangan = 1;
            $namaDaerah = array();
            foreach($senaraiDaerah as $daerah){
                $namaDaerah[] = $daerah->nama;
            }
            array_multisort($namaDaerah, SORT_ASC, $senaraiDaerah);
            foreach($senaraiDaerah as $daerah): 
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= $daerah->nama ?></td>
                <td>
                    <div class="row g-3">
                        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                            <?= anchor('daerah/kemaskini/'.$daerah->bil, 'Kemaskini', "class='btn btn-sm btn-primary w-100'") ?>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                            <?= anchor('daerah/padam/'.$daerah->bil, 'Padam', "class='btn btn-sm btn-danger w-100'") ?>
                        </div>
                    </div>
                </td>
            </tr>
            <?php 
            endforeach;
            ?>
        </table>
    </div>
</div>