<div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><?php echo anchor(base_url(), 'RIMS'); ?> </li>
                <li class="breadcrumb-item active" aria-current="page">Senarai Pilihan Raya</li>
            </ol>
        </nav>
    <div>
        <h1>Pilihan Raya</h1>
        <div class="row g-3">
            <?php foreach($senarai_pilihanraya as $pilihanraya): 
                if($pilihanraya->pilihanraya_status != "SELESAI"){ ?>
                <div class="col-12 col-sm-12 col-lg-6 d-flex align-items-stretch">
                    <div class="p-3 border rounded d-flex align-items-start flex-column w-100">
                        
                        <table class="table table-hover">
                            <tr>
                                <td colspan=2><h2><?php echo anchor('pilihanraya/pilih/'.$pilihanraya->pilihanraya_bil, $pilihanraya->pilihanraya_singkatan, "class = 'text-decoration-none'"); ?></h2></td>
                            </tr>
                            <tr>
                                <th>Pilihan Raya</th>
                                <td><?php echo $pilihanraya->pilihanraya_nama; ?></td>
                            </tr>
                            <tr>
                                <th>Tahun</th>
                                <td><?php echo $pilihanraya->pilihanraya_tahun; ?></td>
                            </tr>
                            <tr>
                                <th>Tarikh Penamaan Calon</th>
                                <td><?php $t = "Tidak Berkenaan"; $t = date_format(date_create($pilihanraya->pilihanraya_penamaan_calon), 'd.m.Y'); echo $t;?></td>
                            </tr>
                            <tr>
                                <th>Tarikh <em>Lock Status</em></th>
                                <td><?php $t1 = "Tidak Berkenaan"; $t1 = date_format(date_create($pilihanraya->pilihanraya_lock_status), 'd.m.Y'); echo $t1; ?></td>
                            </tr>
                        </table>
                        <?php echo anchor('pilihanraya/pilih/'.$pilihanraya->pilihanraya_bil, 'Senarai Negeri-Negeri', "class = 'btn btn-primary w-100 mt-auto'"); ?>
                    </div>
                </div>
            <?php } 
            endforeach; ?>
        </div>
    </div>
</div>