<?php
$namaPilihanraya = $this->session->userdata('pilihanraya_nama');
if(empty($namaPilihanraya)){
    $namaPilihanraya = "Tidak Berkenaan";
}
$namaNegeri = $this->session->userdata('negeri_nama');
if(empty($namaNegeri)){
    $namaNegeri = "Tidak Berkenaan";
}
$namaParlimen = $this->session->userdata('parlimen_nama');
if(empty($namaParlimen)){
    $namaParlimen = "Tidak Berkenaan";
}
$namaParti = $this->session->userdata('parti_nama');
if(empty($namaParti)){
    $namaParti = "Tidak Berkenaan";
}
?>
<div class="container-fluid">
    <div class="p-3 border rounded shadow mb-3 pb-0">
        <h3>Status Draf Pendaftaran Calon</h3>
        <p><strong>Pilihan Raya</strong><br>
            <?php echo $namaPilihanraya; ?>
        </p>
        <p><strong>Negeri</strong><br>
            <?php echo $namaNegeri; ?>
        </p>
        <p><strong>Parlimen</strong><br>
            <?php echo $namaParlimen; ?>
        </p>
        <p><strong>Parti</strong><br>
            <?php echo $namaParti; ?>
        </p>
    </div>
</div>