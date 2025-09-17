<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?> </li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/daerah', 'Daerah'); ?></li>
    <li class="breadcrumb-item active" aria-current="page">Penetapan Tugasan Daerah</li>
  </ol>
</nav>

<?php $this->load->view('negeri/konfigurasi/nav_daerah'); ?>

<div class="p-3 border rounded mb-3">
    <p><strong>Senarai Akaun PPD dan Daerah</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <tr>
                <th>#</th>
                <th>Daerah</th>
                <th>Akaun PPD</th>
                <th>Operasi</th>
            </tr>
            <?php
            $bilangan = 1;
            foreach($senarai_daerah as $daerah):
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= anchor('konfigurasi/daerah_bil/'.$daerah->bil, $daerah->nama) ?></td>
                <td>
                        <?php
                        $senarai_ppd = $data_daerah->senarai_tugas_ppd($daerah->bil); 
                        foreach($senarai_ppd as $ppd): 
                        ?>
                            <?= anchor('peranan/peranan_bil/'.$ppd->peranan_bil,$ppd->peranan_nama) ?>
                        <?php endforeach; ?>
                </td>
                <td>
                    <?php echo anchor('konfigurasi/daerah_set/'.$daerah->bil, 'Set Akaun PPD', "class='btn btn-sm btn-primary w-100'"); ?>
                </td>
            </tr>
            <?php
            endforeach; 
            ?>
        </table>
    </div>
</div>