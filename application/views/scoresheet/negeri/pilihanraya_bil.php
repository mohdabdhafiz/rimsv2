<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('scoresheet', 'Helaian Mata (Score Sheet)'); ?></li>
    <li class="breadcrumb-item active" aria-current="page"><?= $pr->pilihanraya_singkatan ?></li>
  </ol>
</nav>

<?php $this->load->view('scoresheet/negeri/nav'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Maklumat <?= $pr->pilihanraya_nama ?> (<?= $pr->pilihanraya_singkatan ?>)</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <tr>
                <th>Nama Pilihan Raya</th>
                <td><?= $pr->pilihanraya_nama ?></td>
            </tr>
            <tr>
                <th>Nama Singkatan Pilihan Raya</th>
                <td><?= $pr->pilihanraya_singkatan ?></td>
            </tr>
            <tr>
                <th>Tahun</th>
                <td><?= $pr->pilihanraya_tahun ?></td>
            </tr>
            <tr>
                <th>Jenis Pilihan Raya</th>
                <td><?= $pr->pilihanraya_jenis ?></td>
            </tr>
        </table>
    </div>
</div>

<?php 
if($pr->pilihanraya_jenis == 'PARLIMEN'): 
    $senarai_parlimen = $data_pilihanraya->senarai_parlimen_pilihanraya($pr->pilihanraya_bil);
?>
<?php if(!empty($senarai_parlimen)): ?>
<div class="p-3 border rounded mb-3">
    <p><strong>Senarai Parlimen</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-striped">
            <tr>
                <th>#</th>
                <th>Parlimen</th>
                <th>Negeri</th>
                <th>Keputusan Score Sheet</th>
                <th>Bilangan Undi</th>
            </tr>
            <?php 
            $bilangan = 1;
            foreach($senarai_parlimen as $parlimen): ?>
                <tr>
                    <td><?= $bilangan++ ?></td>
                    <td><?= anchor('scoresheet/parlimen/?pr='.$pr->pilihanraya_bil."&p=".$parlimen->pt_bil, $parlimen->pt_nama) ?></td>
                    <td>
                        <?php 
                        $negeri = $data_negeri->negeri_nama($parlimen->pt_negeri); 
                        if(!empty($negeri)){
                            echo anchor('scoresheet/negeri/'.$negeri->nt_bil, $negeri->nt_nama);
                        }
                        ?>
                    </td>
                    <td>PH</td>
                    <td>1000</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php endif; ?>
<?php endif; ?>

<?php 
if($pr->pilihanraya_jenis == 'DUN'): 
    $senarai_parlimen = $data_pilihanraya->senarai_dun_pilihanraya($pr->pilihanraya_bil);
?>
<div class="p-3 border rounded mb-3">
    <p><strong>Senarai DUN</strong></p>
</div>
<?php endif; ?>