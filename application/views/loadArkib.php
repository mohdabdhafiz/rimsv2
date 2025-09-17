<div id="loadHere"></div>

<script>
    const loadHere = document.getElementById('loadHere');
    async function getPage()
    {
        const response = await fetch('<?php echo base_url(); ?>index.php/lapis/arkibYear/2023');
        const data = await response.text();
        loadHere.innerHTML = data;
    }
    getPage();
</script>