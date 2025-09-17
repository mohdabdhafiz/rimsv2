<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS (JaPen Negeri)'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('sismap', 'RIMS@SISMAP'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Helaian Mata (Score Sheet)</li>
  </ol>
</nav>

<?php $this->load->view('scoresheet/negeri/nav'); ?>

<?php if(!empty($senarai_pilihanraya)): ?>
<div class="p-3 border rounded mb-3">
    <p><strong>Senarai Pilihan Raya</strong></p>
    <p class="small text-muted">Senarai Pilihan Raya yang telah selesai.</p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-striped">
            <tr>
                <th>#</th>
                <th>Singkatan</th>
                <th>Nama</th>
                <th>Tahun</th>
                <th>Jenis</th>
                <th>Operasi</th>
            </tr>
            <?php $bilangan = 1;
            foreach($senarai_pilihanraya as $pr): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= $pr->pilihanraya_singkatan ?></td>
                <td><?= $pr->pilihanraya_nama ?></td>
                <td><?= $pr->pilihanraya_tahun ?></td>
                <td><?= $pr->pilihanraya_jenis ?></td>
                <td>
                    <div class="row g-3">
                        <div class="col-12 col-lg-12">
                            <?php echo anchor('scoresheet/pilihanraya/'.$pr->pilihanraya_bil, 'Lihat', "class='btn btn-sm btn-outline-primary w-100'"); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php endif; ?>