<div id="nav_data"></div>

<div id="senarai_jangkaan"></div>

<script>
    async function setNav()
    {
        const data = await getNav();
        document.getElementById("nav_data").innerHTML = data;
    }

    async function getNav()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/laporan/nav');
        const data = await response.text();
        return data;
    }

    async function setJangkaan()
    {
        const data = await getJangkaan();
        document.getElementById("senarai_jangkaan").innerHTML = data;
    }

    async function getJangkaan()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/laporan/senarai_jangkaan');
        const data = await response.text();
        return data;
    }

    setNav();
    setJangkaan();
</script>