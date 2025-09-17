<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?> </li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/dun', 'DUN'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Penetapan Tugasan DUN</li>
  </ol>
</nav>

<?php $this->load->view('negeri/konfigurasi/nav_dun'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Senarai Akaun PPD dan DUN</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <tr>
                <th>#</th>
                <th>DUN</th>
                <th>Akaun PPD</th>
                <th>Operasi</th>
            </tr>
            <?php
            $bilangan = 1;
            foreach($senarai_dun as $dun):
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= anchor('konfigurasi/dun_bil/'.$dun->dun_bil, $dun->dun_nama) ?></td>
                <td>
                        <?php
                        $senarai_ppd = $data_dun->senarai_tugas_ppd($dun->dun_bil); 
                        foreach($senarai_ppd as $ppd): 
                        ?>
                            <?= anchor('peranan/peranan_bil/'.$ppd->peranan_bil,$ppd->peranan_nama) ?>
                        <?php endforeach; ?>
                </td>
                <td>
                    <?php echo anchor('konfigurasi/dun_set/'.$dun->dun_bil, 'Set Akaun PPD', "class='btn btn-sm btn-primary w-100'"); ?>
                </td>
            </tr>
            <?php
            endforeach; 
            ?>
        </table>
    </div>
</div>