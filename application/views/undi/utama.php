<div class="p-3 border rounded mb-3">
    <h1>HARI PEMBUANGAN UNDI</h1>
    <div class="row g-3 mt-3">
        <div class="col-12 col-lg-6">
            <?php echo anchor('undi', 'LAMAN UTAMA HARI PEMBUANGAN UNDI', "class='btn btn-primary w-100'"); ?>
        </div>
        <div class="col-12 col-lg-6">
            <?php echo anchor('undi/operasi', 'OPERASI HARI PEMBUANGAN UNDI', "class='btn btn-primary w-100'"); ?>
        </div>
    </div>
</div>

<div class="p-3 border rounded mb-3">
    <div class="row g-3">
        <div class="col-12 col-lg-6">
            <h2>SENARAI PARLIMEN</h2>
            <div id="senarai_parlimen"></div>
        </div>
        <div class="col-12 col-lg-6">
            <h2>SENARAI DUN</h2>
            <div id="senarai_dun"></div>
        </div>
    </div>
</div>

<script>
    
    async function setSenaraiParlimen()
    {
        const data = await getSenaraiParlimen();
        document.getElementById("senarai_parlimen").innerHTML = data;
    }

    async function getSenaraiParlimen()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/undi/senarai_parlimen');
        const data = await response.text();
        return data;
    }

    async function setSenaraiDun()
    {
        const data = await getSenaraiDun();
        document.getElementById("senarai_dun").innerHTML = data;
    }

    async function getSenaraiDun()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/undi/senarai_dun');
        const data = await response.text();
        return data;
    }

    setSenaraiParlimen();
    setSenaraiDun();

</script>               