<h3>SENARAI DATA CALON</h3>
<p>Senarai Calon Parlimen</p>
<div class="row g-3 mb-3">
        <?php foreach($senaraiCalonParlimen as $calonParlimen): 
            $ahli = $dataAhli->ahli($calonParlimen->pencalonan_parlimen_ahliBil);
            $foto = $dataFoto->foto($ahli->ahli_foto); 
            $parti = $dataParti->ahliParti($calonParlimen->pencalonan_parlimen_partiBil);
            $fotoParti = $dataFoto->foto($parti->parti_logo);
            $pilihanraya = $dataPilihanraya->pilihanraya($calonParlimen->pencalonan_parlimen_pilihanrayaBil);
        ?>
    <div class="col col-lg-3 col-md-4 col-sm-12">
        <div class="p-3 border rounded shadow text-center">
            <p><img src="<?php echo base_url('assets/img/').$foto->foto_nama; ?>" alt="Gambar <?php echo $calonParlimen->pencalonan_parlimen_ahliNama; ?>" class=" mb-3" style="border-radius:50%; max-width:300px; height:200px; object-fit:cover;"></p>
            <p><img src="<?php echo base_url('assets/img/').$fotoParti->foto_nama; ?>" alt="Gambar Parti <?php echo $parti->parti_nama; ?>" class="mb-3" style="border-radius:5%; max-width:200px; height:100px; object-fit:cover;"></p>
            <p><strong><?php echo strtoupper($calonParlimen->pencalonan_parlimen_ahliNama); ?> (<?php echo $ahli->ahli_umur; ?>) <br>
                <?php echo $parti->parti_nama; ?> (<?php echo $parti->parti_singkatan; ?>)
            </strong></p>
            <p>
                <?php echo $ahli->ahli_pendidikan; ?> <br>
                <?php echo $ahli->ahli_jantina; ?>
            </p>
            <p>
                <?php echo $pilihanraya->pilihanraya_nama; ?> - 
                <?php echo $calonParlimen->pencalonan_parlimen_parlimenNama; ?> 
            </p>
            <div class="row g-3">
                <div class="col">
                    <?php echo anchor('ahli/id/'.$calonParlimen->pencalonan_parlimen_ahliBil, 'Maklumat Lanjut', "class='btn btn-primary w-100'"); ?>
                </div>
            </div>
        </div>
    </div>
        <?php endforeach; ?>
</div>
<p>Senarai Calon DUN</p>
<div class="row g-3 mb-3">
        <?php foreach($senaraiCalonDun as $calonDUN): 
            $fotoParti = $dataFoto->foto($calonDUN->parti_logo);
        ?>
    <div class="col col-lg-3 col-md-4 col-sm-12 text-center">
        <div class="p-3 border rounded shadow">
        <p><img src="<?php echo base_url('assets/img/').$calonDUN->foto_nama; ?>" alt="Gambar <?php echo $calonDUN->ahli_nama; ?>" class=" mb-3" style="border-radius:50%; max-width:300px; height:200px; object-fit:cover;"></p>
        <p><img src="<?php echo base_url('assets/img/').$fotoParti->foto_nama; ?>" alt="Gambar Parti <?php echo $calonDUN->parti_nama; ?>" class="mb-3" style="border-radius:5%; max-width:200px; height:100px; object-fit:cover;"></p>
            <p><strong><?php echo strtoupper($calonDUN->ahli_nama); ?> (<?php echo $calonDUN->ahli_umur; ?>) <br> 
            <?php echo $calonDUN->parti_nama; ?> (<?php echo $calonDUN->parti_singkatan; ?>)
        
            </strong></p>
            <p>
                <?php echo $calonDUN->ahli_pendidikan; ?> <br>
                <?php echo $calonDUN->ahli_jantina; ?>
            </p>
            <p>
                <?php echo $calonDUN->pilihanraya_nama; ?> - 
                <?php echo $calonDUN->dun_nama; ?> 
            </p>
            <div class="row g-3">
                <div class="col">
                    <?php echo anchor('ahli/id/'.$calonDUN->ahli_bil, 'Maklumat Lanjut', "class='btn btn-primary w-100'"); ?>
                </div>
            </div>
        </div>
    </div>
        <?php endforeach; ?>
</div>