<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS (JaPen Negeri)'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Daerah</li>
  </ol>
</nav>

<!-- <div class="mb-3">
    <?php $this->load->view('negeri/konfigurasi/nav'); ?>
</div> -->

<?php $this->load->view('negeri/konfigurasi/nav_daerah'); ?>


<?php if(!empty($senarai_daerah)): ?>
<div class="p-3 border rounded mb-3">
    <p><strong>Senarai Daerah</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered">
            <tr>
                <th>#</th>
                <th>Nama Daerah</th>
                <th>Operasi</th>
            </tr>
            <?php $bilangan = 1;
            foreach($senarai_daerah as $daerah): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td>
                    <?php echo anchor('konfigurasi/daerah_bil/'.$daerah->bil, $daerah->nama); ?>
                </td>
                <td>
                    <div class="row g-3">
                        <div class="col-12 col-lg-12">
                            <?php echo anchor('konfigurasi/padam_daerah/'.$daerah->bil, 'Padam', "class='btn btn-sm btn-danger w-100'"); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php endif; ?>