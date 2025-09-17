

<div id="dashboardKeluarMengundi"></div>

<script>
    async function setDashboardKeluarMengundi()
    {
        const data = await getDashboardKeluarMengundi();
        document.getElementById("dashboardKeluarMengundi").innerHTML = data;
    }

    async function getDashboardKeluarMengundi()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/undi/dashboard/<?= $pru->pilihanraya_bil ?>');
        const data = await response.text();
        return data;
    }

    setDashboardKeluarMengundi();

    setInterval(setDashboardKeluarMengundi, 5100);
</script>