<p class="text-muted">KEPUTUSAN PENUH TIDAK RASMI</p>
<h1 class="display-1 mb-3 text-center"><?= strtoupper($pru->pilihanraya_nama) ?></h1>
<div id="senarai_penuh">
</div>

<?php if($pru->pilihanraya_jenis == 'PARLIMEN'){ ?>
<script>
    async function setSenaraiParlimen()
    {
        const data = await getSenaraiParlimen();
        document.getElementById("senarai_penuh").innerHTML = data;
    }

    async function getSenaraiParlimen()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/data_virtualization/senarai_penuh_parlimen/<?= $pru->pilihanraya_bil ?>');
        const data = await response.text();
        return data;
    }

    setSenaraiParlimen();
</script>
<?php } ?>

<?php if($pru->pilihanraya_jenis == 'DUN'){ ?>
<script>
    async function setSenaraiDun()
    {
        const data = await getSenaraiDun();
        document.getElementById("senarai_penuh").innerHTML = data;
    }

    async function getSenaraiDun()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/data_virtualization/senarai_penuh_dun/<?= $pru->pilihanraya_bil ?>');
        const data = await response.text();
        return data;
    }

    setSenaraiDun();
</script>
<?php } ?>