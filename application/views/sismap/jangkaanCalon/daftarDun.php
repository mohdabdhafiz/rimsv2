<?php 
$this->load->view($header);
$this->load->view($sidebar);
$this->load->view($navbar);
?>

<main id="main" class="main">

<div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('winnable_candidate') ?>">JANGKAAN CALON</a></li>
                <li class="breadcrumb-item active">TAMBAH JANGKAAN CALON DUN</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
    
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Tambah Jangkaan Calon DUN</h1>

            <!-- Error Messages -->
            <?= validation_errors() ?>

            <?= form_open_multipart('winnable_candidate/daftar_dun', ['class' => 'needs-validation', 'novalidate' => 'novalidate']) ?>

            <!-- CSRF Token -->
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

            <!-- DUN Selection -->
            <div class="p-3 border rounded mb-3">
                <label for="inputDun" class="form-label">1. DUN: <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    id="dunSearch" 
                    class="form-control mb-3" 
                    placeholder="Cari DUN..."
                    aria-label="Carian DUN">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dunTable">
                        <thead>
                            <tr>
                                <th>PILIH</th>
                                <th>NEGERI</th>
                                <th>DUN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($senaraiDun as $dun): ?>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input" 
                                            type="radio" 
                                            name="inputDun" 
                                            id="inputDun<?= $dun->dunBil ?>" 
                                            value="<?= $dun->dunBil ?>" 
                                            <?= set_value('inputDun') == $dun->dunBil ? "checked" : "" ?> 
                                            required 
                                            aria-label="Select DUN <?= $dun->dunNama ?>">
                                    </div>
                                </td>
                                <td><?= $dun->negeriNama ?></td>
                                <td><?= $dun->dunNama ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- File Upload with Preview -->
            <div class="p-3 border rounded mb-3">
                <label for="inputGambar" class="form-label">2. Gambar: <span class="text-danger">*</span></label>
                <input 
                    type="file" 
                    name="inputGambar" 
                    id="inputGambar" 
                    class="form-control" 
                    required 
                    onchange="previewImage(event)" 
                    aria-label="Upload candidate image">
                <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid mt-3 d-none" />
            </div>

            <!-- Full Name -->
            <div class="p-3 border rounded mb-3">
                <label for="inputNama" class="form-label">3. Nama Penuh: <span class="text-danger">*</span></label>
                <input 
                    type="text" 
                    name="inputNama" 
                    id="inputNama" 
                    class="form-control" 
                    value="<?= set_value('inputNama') ?>" 
                    required 
                    aria-label="Enter full name">
            </div>

            <div class="p-3 border rounded mb-3">
                <label for="inputParti" class="form-label">4. Parti: <span class="text-danger">*</span></label>
                <select name="inputParti" id="inputParti" class="form-control" required>
                    <option value="" <?php if(set_value('inputParti') == ""){ echo "selected"; } ?>>Sila Pilih..</option>
                    <?php foreach($senaraiParti as $parti): ?>
                        <option value="<?= $parti->partiBil ?>" <?php if(set_value('inputParti') == $parti->partiBil){ echo "selected"; } ?> style="<?= $parti->partiWarna ?>">[<?= $parti->partiSingkatan ?>] <?= $parti->partiNama ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="p-3 border rounded mb-3">
                <label for="inputJawatan" class="form-label">5. Jawatan Dalam Parti:</label>
                <input type="text" name="inputJawatan" id="inputJawatan"  value="<?= set_value('inputJawatan') ?>" class="form-control">
            </div>

            <div class="p-3 border rounded mb-3">
                <label for="inputKategoriUmur" class="form-label">5. Kategori Umur:</label>
                <select name="inputKategoriUmur" id="inputKategoriUmur" class="form-control">
                    <option value="">Sila Pilih..</option>
                    <option value="18 - 24" <?php if(set_value('inputKategoriUmur') == "18 - 24"){ echo "selected"; } ?>>18 - 24</option>
                    <option value="25 - 40" <?php if(set_value('inputKategoriUmur') == "25 - 40"){ echo "selected"; } ?>>25 - 40</option>
                    <option value="41 - 60" <?php if(set_value('inputKategoriUmur') == "41 - 60"){ echo "selected"; } ?>>41 - 60</option>
                    <option value="61 - 70" <?php if(set_value('inputKategoriUmur') == "61 - 70"){ echo "selected"; } ?>>61 - 70</option>
                    <option value="71 - 80" <?php if(set_value('inputKategoriUmur') == "71 - 80"){ echo "selected"; } ?>>71 - 80</option>
                    <option value="81 ke atas" <?php if(set_value('inputKategoriUmur') == "81 ke atas"){ echo "selected"; } ?>>81 ke atas</option>
                </select>
            </div>

            <div class="p-3 border rounded mb-3">
                <label for="inputJantina" class="form-label">6. Pilih Jantina :</label>
                <select name="inputJantina" id="inputJantina" class="form-control">
                    <option value="" <?php if(set_value('inputJantina') == ""){ echo "selected"; } ?>>Sila Pilih..</option>
                    <option value="Lelaki" <?php if(set_value('inputJantina') == "Lelaki"){ echo "selected"; } ?>>Lelaki</option>
                    <option value="Perempuan" <?php if(set_value('inputJantina') == "Perempuan"){ echo "selected"; } ?>>Perempuan</option>
                </select>
            </div>

            <div class="mb-3 p-3 border rounded">
                <label for="inputKaum" class="form-label">7. Pilih Kaum :</label>
                <select name="inputKaum" id="inputKaum" class="form-control">
                    <option value="" <?php if(set_value('inputKaum') == ""){ echo "selected"; } ?>>Sila Pilih</option>
                    <option value="Melayu" <?php if(set_value('inputKaum') == "Melayu"){ echo "selected"; } ?>>Melayu</option>
                    <option value="Cina" <?php if(set_value('inputKaum') == "Cina"){ echo "selected"; } ?>>Cina</option>
                    <option value="India" <?php if(set_value('inputKaum') == "India"){ echo "selected"; } ?>>India</option>
                    <option value="Bumiputera Islam Sabah (Lain-Lain Kaum)" <?php if(set_value('inputKaum') == "Bumiputera Islam Sabah (Lain-Lain Kaum)"){ echo "selected"; } ?>>Bumiputera Islam Sabah (Lain-Lain Kaum)</option>
                    <option value="Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)" <?php if(set_value('inputKaum') == "Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)"){ echo "selected"; } ?>>Bumiputera Bukan Islam Sabah (Kadazan, Dusun, Murut)</option>
                    <option value="Iban" <?php if(set_value('inputKaum') == "Iban"){ echo "selected"; } ?>>Iban</option>
                    <option value="Bidayuh" <?php if(set_value('inputKaum') == "Bidayuh"){ echo "selected"; } ?>>Bidayuh</option>
                    <option value="Melanau" <?php if(set_value('inputKaum') == "Melanau"){ echo "selected"; } ?>>Melanau</option>
                    <option value="Orang Ulu" <?php if(set_value('inputKaum') == "Orang Ulu"){ echo "selected"; } ?>>Orang Ulu</option>
                    <option value="Orang Asli" <?php if(set_value('inputKaum') == "Orang Asli"){ echo "selected"; } ?>>Orang Asli</option>
                    <option value="Punjabi" <?php if(set_value('inputKaum') == "Punjabi"){ echo "selected"; } ?>>Punjabi / Sikh</option>
                    <option value="Lain-Lain Kaum" <?php if(set_value('inputKaum') == "Lain-Lain Kaum"){ echo "selected"; } ?>>Lain-Lain Kaum</option>
                </select>
            </div>

            <div class="mb-3 p-3 border rounded">
                <label for="inputStatus" class="form-label">8. Adakah Calon Merupakan Penyandang DUN?</label>
                <select name="inputStatus" id="inputStatus" class="form-control" aria-label="Status Penyandang">
                    <option value="" <?php if(set_value('inputStatus') == ""){ echo "selected"; } ?>>Sila Pilih</option>
                    <option value="Penyandang" <?php if(set_value('inputStatus') == "Penyandang"){ echo "selected"; } ?>>Ya</option>
                    <option value="Bukan Penyandang" <?php if(set_value('inputStatus') == "Bukan Penyandang"){ echo "selected"; } ?>>Tidak</option>
                </select>
            </div>

            <input type="hidden" name="inputPengguna" value="<?= $pengguna->bil ?>">
            <input type="hidden" name="inputWaktu" value="<?= date("Y-m-d H:i:s") ?>">

            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-secondary shadow-sm">Reset</button>
                <button type="submit" class="btn btn-primary shadow-sm">Tambah</button>
            </div>


            <p class="mt-3">NOTA: Perkara yang bertanda <span class="text-danger">*</span> adalah WAJIB untuk diisi.</p>

            </form>
        </div>
    </div>





    </section>


</main>

<script>
    // Preview Image
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // DUN Table Search Filter
    document.getElementById('dunSearch').addEventListener('keyup', function () {
        const searchText = this.value.toLowerCase();
        const rows = document.querySelectorAll('#dunTable tbody tr');
        rows.forEach(row => {
            const negeri = row.children[1].innerText.toLowerCase();
            const dun = row.children[2].innerText.toLowerCase();
            if (negeri.includes(searchText) || dun.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>


<?php $this->load->view($footer); ?>