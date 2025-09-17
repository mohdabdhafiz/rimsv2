<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi', 'Konfigurasi RIMS'); ?></li>
    <li class="breadcrumb-item"><?php echo anchor('konfigurasi/daerah', 'Daerah'); ?></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $daerah->nama; ?></li>
  </ol>
</nav>

<?php 
$this->load->view('negeri/konfigurasi/nav_daerah');
?>

<div class="p-3 border rounded mb-3">
    <div class="float-end">
    <?php echo anchor('konfigurasi/padam_daerah/'.$daerah->bil, 'Padam', "class='btn btn-sm btn-danger w-100'"); ?>
    </div>
    <p><strong>Maklumat Daerah</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover">
            <tr>
                <th>Nama Daerah</th>
                <td><?= $daerah->nama ?></td>
            </tr>
            <tr>
                <th>Negeri</th>
                <td>
                    <?php 
                    $negeri = $data_negeri->negeri($daerah->negeri_bil); 
                    echo $negeri->nt_nama;
                    ?>
                </td>
            </tr>
            <tr>
                <th>Akaun PPD</th>
                <td>
                    <?php 
                    $ppd = $data_daerah->senarai_tugas_ppd_bil($daerah->bil);
                    if(!empty($ppd)){
                        echo anchor('peranan/peranan_bil/'.$ppd->peranan_bil, $ppd->peranan_nama);
                    }else{
                    ?>
                    <?= anchor('konfigurasi/daerah_set/'.$daerah->bil, 'Penetapan Penugasan Daerah', "class='btn btn-primary btn-sm w-100'") ?>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </div>
    
</div>