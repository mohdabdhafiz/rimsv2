<div id="nav_perumus"></div>

<div id="senarai_negeri"></div>

<div id="rumusan_penuh"></div>

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

    async function setSenaraiNegeri()
    {
        const data = await getSenaraiNegeri();
        document.getElementById("senarai_negeri").innerHTML = data;
    }

    async function getSenaraiNegeri()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/perumus/senarai_negeri');
        const data = await response.text();
        return data;
    }

    async function setRumusanPenuh()
    {
        const data = await getRumusanPenuh();
        document.getElementById("rumusan_penuh").innerHTML = data;
    }

    async function getRumusanPenuh()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/perumus/rumusan_kiraan_parti');
        const data = await response.text();
        return data;
    }

    setNav();
    setSenaraiNegeri();
    setRumusanPenuh();
    setInterval(setRumusanPenuh, 5000);
</script>