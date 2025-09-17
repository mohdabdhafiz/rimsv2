<div id="list_parti"></div>


        <div class="p-3 border rounded mb-3">
            <?php echo anchor('data_virtualization/senarai_penuh/'.$pru->pilihanraya_bil, "SENARAI PENUH KEPUTUSAN SEMASA <i class='bx bxs-chevron-right'></i>", "class='btn btn-primary float-end d-flex align-items-center justify-content-center'"); ?>
            <p class="small text-muted"><i class='bx bx-broadcast ml-3'></i> KEPUTUSAN SEMASA</p>

            <h1><?= strtoupper($pru->pilihanraya_nama) ?></h1>
        </div>
            <div id="senarai_latest"></div>

<script>
    async function setSenaraiParti()
    {
        const data = await getSenaraiParti();
        document.getElementById("list_parti").innerHTML = data;
    }

    async function getSenaraiParti()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/data_virtualization/senarai_parti/<?= $pru->pilihanraya_bil ?>');
        const data = await response.text();
        return data;
    }

    async function setSenaraiLatest()
    {
        const data = await getSenaraiLatest();
        document.getElementById("senarai_latest").innerHTML = data;
    }

    async function getSenaraiLatest()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/data_virtualization/senarai_tidak_rasmi/<?= $pru->pilihanraya_bil ?>');
        const data = await response.text();
        return data;
    }

    setSenaraiParti();
    setSenaraiLatest();

    setInterval(setSenaraiParti, 5100);
    setInterval(setSenaraiLatest, 5200);
</script>