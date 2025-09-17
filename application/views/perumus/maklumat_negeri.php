<div id="nav_perumus"></div>

<div class="row g-3 mb-3">
    <div class="col-12 col-lg-6">
        <div id="senarai_parlimen"></div>
    </div>
    <div class="col-12 col-lg-6">
        <div id="senarai_dun"></div>
    </div>
</div>

<script>
    async function setNav()
    {
        const data = await getNav();
        document.getElementById("nav_perumus").innerHTML = data;
    }

    async function getNav()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/perumus/nav_perumus');
        const data = await response.text();
        return data;
    }

    async function setSenaraiParlimen()
    {
        const data = await getSenaraiParlimen();
        document.getElementById("senarai_parlimen").innerHTML = data;
    }

    async function getSenaraiParlimen()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/perumus/senarai_parlimen/<?= $negeri->nt_bil ?>');
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
        const response = await fetch('<?php echo base_url(); ?>index.php/perumus/senarai_dun/<?= $negeri->nt_bil ?>');
        const data = await response.text();
        return data;
    }

    setNav();
    setSenaraiParlimen();
    setSenaraiDun();
</script>