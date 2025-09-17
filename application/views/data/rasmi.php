<h1>RASMI</h1>
<div id="senarai_rasmi"></div>

<script>
    async function setRasmi()
    {
        const data = await getRasmi();
        document.getElementById("senarai_rasmi").innerHTML = data;
    }

    async function getRasmi()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/laporan/komp_rasmi');
        const data = await response.text();
        return data;
    }

    setRasmi();
</script>