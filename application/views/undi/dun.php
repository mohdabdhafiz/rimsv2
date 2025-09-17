<div class="p-3 border rounded mb-3">
    <div id="proses_undi"></div>
</div>

<script>
    async function setTambahUndi()
    {
        const data = await getTambahUndi();
        document.getElementById("proses_undi").innerHTML = data;
    }

    async function getTambahUndi()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/undi/dun_undi/<?= $dun->dun_bil ?>');
        const data = await response.text();
        return data;
    }

    setTambahUndi();
</script>