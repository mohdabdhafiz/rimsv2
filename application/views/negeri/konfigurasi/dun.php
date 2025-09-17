<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS (JaPen Negeri)'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">DUN</li>
  </ol>
</nav>

<!-- <div class="mb-3">
    <?php $this->load->view('negeri/konfigurasi/nav'); ?>
</div> -->

<?php $this->load->view('negeri/konfigurasi/nav_dun'); ?>


<?php if(!empty($senarai_dun)): ?>
<div class="p-3 border rounded mb-3">
    <p><strong>Senarai DUN</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered">
            <tr>
                <th>#</th>
                <th>Nama DUN</th>
                <th>Operasi</th>
            </tr>
            <?php $bilangan = 1;
            foreach($senarai_dun as $dun): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td>
                    <?php echo anchor('konfigurasi/dun_bil/'.$dun->dun_bil, $dun->dun_nama); ?>
                </td>
                <td>
                    <div class="row g-3">
                        <div class="col-12 col-lg-12">
                            <?php echo anchor('konfigurasi/padam_dun/'.$dun->dun_bil, 'Padam', "class='btn btn-sm btn-danger w-100'"); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php endif; ?>