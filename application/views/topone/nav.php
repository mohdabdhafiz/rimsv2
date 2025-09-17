

<div id="nav_view"></div>

<script>
    async function setSenaraiPru()
    {
        const data = await getSenaraiPru();
        document.getElementById("nav_view").innerHTML = data;
    }

    async function getSenaraiPru()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/data_virtualization/topone_view');
        const data = await response.text();
        return data;
    }

    setSenaraiPru();
</script>