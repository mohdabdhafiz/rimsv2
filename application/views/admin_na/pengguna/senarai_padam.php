

<div class="row g-3 mb-3">
    <div class="col-12 col-lg-3">
        <div id="nav_ppd"></div>
    </div>

    <div class="col-12 col-lg-9">
        <div class="pt-3 px-3">
            <h1>Senarai Pegawai</h1>
        </div>
        <div class="row g-3 my-3">
            <?php foreach($senarai_anggota as $anggota): ?>
            <div class="col-12 col-sm-6 col-lg-4 d-flex align-items-stretch">
                <div class="p-3 text-center border rounded w-100 d-flex flex-column">
                    <h2><?= $anggota->nama_penuh ?></h2>
                    <div class="mt-auto">
                    <p>
                        <?= $anggota->pekerjaan ?><br />
                        <?= $anggota->pengguna_tempat_tugas ?>
                    </p>
                    <p><?= $anggota->no_tel ?> <br /> <?= $anggota->emel ?></p>
                    <p class="small text-muted">ID: <?= $anggota->bil ?><br />
                    Status: <?= $anggota->pengguna_status ?></p>
                    <?php echo anchor('pengguna/padam_maklumat/'.$anggota->bil, 'Padam', "class='btn btn-danger w-100'"); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>


</div>

<script>

    async function setNav()
    {
        const data = await getNav();
        document.getElementById("nav_ppd").innerHTML = data;
    }

    async function getNav()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/ppd/nav');
        const data = await response.text();
        return data;
    }
    
    setNav();

</script>