
<div id="nav_undi"></div>

<div id="rumusan"></div>

<script>

    async function setNav()
    {
        const data = await getNav();
        document.getElementById("nav_undi").innerHTML = data;
    }

    async function getNav()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/undi/nav_data');
        const data = await response.text();
        return data;
    }

    async function setRumusan()
    {
        const data = await getRumusan();
        document.getElementById("rumusan").innerHTML = data;
    }

    async function getRumusan()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/undi/rumusan_undian');
        const data = await response.text();
        return data;
    }

    setNav();
    setRumusan();
</script>