<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS (JaPen Negeri)'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Parlimen</li>
  </ol>
</nav>

<!-- <div class="mb-3">
    <?php $this->load->view('negeri/konfigurasi/nav'); ?>
</div> -->

<?php $this->load->view('negeri/konfigurasi/nav_parlimen'); ?>


<?php if(!empty($senarai_parlimen)): ?>
<div class="p-3 border rounded mb-3">
    <p><strong>Senarai Parlimen</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered">
            <tr>
                <th>#</th>
                <th>Nama Parlimen</th>
                <th>Operasi</th>
            </tr>
            <?php $bilangan = 1;
            $nama_parlimen = array();
            foreach($senarai_parlimen as $parlimen){
                $nama_parlimen[] = $parlimen->pt_nama;
            }
            array_multisort($nama_parlimen, SORT_ASC, $senarai_parlimen);
            foreach($senarai_parlimen as $parlimen): ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td>
                    <?php echo anchor('konfigurasi/parlimen_bil/'.$parlimen->pt_bil, $parlimen->pt_nama); ?>
                </td>
                <td>
                    <div class="row g-3">
                        <div class="col-12 col-lg-12">
                            <?php echo anchor('konfigurasi/padam_parlimen/'.$parlimen->pt_bil, 'Padam', "class='btn btn-sm btn-danger w-100'"); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php endif; ?>