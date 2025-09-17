<div class="container-fluid">
    <div class="p-3 border rounded shadow pb-0 mb-3">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?php echo anchor(base_url(), $pilihanraya_singkatan); ?> </li>
        <li class="breadcrumb-item"><?php echo anchor('pilihanraya/pilih/'.$pilihanrayaBil, 'Senarai Negeri-Negeri'); ?> </li>
        <li class="breadcrumb-item"><?php echo anchor('pilihanraya/pilih_negeri/'.$negeri_bil, $negeri_nama); ?></li>
        <li class="breadcrumb-item active" aria-current="page">Senarai Parlimen dan Senarai DUN</li>
    </ol>
    </nav>
</div>
<div class="p-3 border rounded shadow mb-3">
<p class="small text-muted mb-0">Carian Mengikut Parlimen/DUN:</p>
<?php echo form_open('dun/cari'); ?>
    <div class="row g-1 mb-3">
        <div class="col-4 col-lg-2">
            <button type="submit" class="btn btn-primary form-control">Cari</button>
        </div>
        <div class="col-8 col-lg-10">
            <input type="text" name="dun_nama" id="dun_nama" class="form-control">
        </div>  
    </div>
</form> 
</div>
<div class="p-3 border rounded shadow mb-3">
    <h2><?php echo $negeri_nama; ?></h2>
</div>
<div class="p-3 border rounded shadow mb-3">
    <h3>Parlimen</h3>
    <div class="row g-3">
                <?php foreach($senaraiParlimen as $parlimen): 
                    echo "<div class='col-sm-12 col-md-6 col-lg d-flex align-items-stretch'><div class='p-3 border rounded bg-light text-center d-flex flex-column w-100'>";
                    echo anchor('parlimen/papar_parlimen/'.$parlimen->pt_bil, $parlimen->pt_nama , 'class="text-decoration-none text-dark my-auto"');
                    echo "</div></div>";
                    $parlimenAda = true;
                endforeach;
                if(empty($senaraiParlimen))
                {
                    echo "<div class='col-12'><div class='p-3 border rounded bg-warning text-center'>";
                    echo 'Tiada dalam senarai. ';
                    echo "</div></div>"; 
                } ?>
    </div>
</div>
<div class="p-3 border rounded shadow mb-3">
    <h3>DUN</h3>
    <div class="row g-3">
                <?php foreach($senarai_dun as $dun): 
                    echo "<div class='col-sm-12 col-md-6 col-lg d-flex align-items-stretch'><div class='p-3 border rounded bg-light text-center d-flex flex-column w-100'>";
                    echo anchor('dun/papar_dun/'.$dun->dun_bil, $dun->dun_nama , 'class="text-decoration-none text-dark my-auto"');
                    echo "</div></div>";
                    $ada = true;
                endforeach;
                if(empty($senarai_dun))
                {
                    echo "<div class='col-12'><div class='p-3 border rounded bg-warning text-center'>";
                    echo 'Tiada dalam senarai. ';
                    echo "</div></div>"; 
                } ?>
    </div>
</div>

</div>
