<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?> </li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/parlimen', 'Parlimen'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Penetapan Tugasan Parlimen</li>
  </ol>
</nav>

<?php $this->load->view('negeri/konfigurasi/nav_parlimen'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Senarai Akaun PPD dan Parlimen</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <tr>
                <th>#</th>
                <th>Parlimen</th>
                <th>Akaun PPD</th>
                <th>Operasi</th>
            </tr>
            <?php
            $bilangan = 1;
            foreach($senarai_parlimen as $parlimen):
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= anchor('konfigurasi/parlimen_bil/'.$parlimen->pt_bil, $parlimen->pt_nama) ?></td>
                <td>
                        <?php
                        $senarai_ppd = $data_parlimen->senarai_tugas_ppd($parlimen->pt_bil); 
                        foreach($senarai_ppd as $ppd): 
                        ?>
                            <?= anchor('peranan/peranan_bil/'.$ppd->peranan_bil,$ppd->peranan_nama) ?>
                        <?php endforeach; ?>
                </td>
                <td>
                    <?php echo anchor('konfigurasi/parlimen_set/'.$parlimen->pt_bil, 'Set Akaun PPD', "class='btn btn-sm btn-primary w-100'"); ?>
                </td>
            </tr>
            <?php
            endforeach; 
            ?>
        </table>
    </div>
</div>