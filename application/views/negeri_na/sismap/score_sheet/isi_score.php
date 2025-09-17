<?php
$this->load->view('negeri_na/susunletak/atas');
$this->load->view('negeri_na/susunletak/navbar');
$this->load->view('negeri_na/susunletak/sidebar');
?>


<main id="main" class="main">


    <div class="pagetitle">
        <h1>RIMS@SISMAP</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">RIMS</a></li>
                <li class="breadcrumb-item active">RIMS@SISMAP</li>
                <li class="breadcrumb-item active">Tambah Helaian Mata</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="mb-5 mt-5">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <div class="mb-3 mt-3">
                        <?php  foreach($namaPusat as $np):?>
                                <form class="row g-10">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-3"><?= $np->nama_pusat ?></h5>
                                        <div class="mb-3">

                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <div class="d-flex justify-content-end mb-3">
                                            <button type="button" class="btn btn-outline-primary" onclick="addRows()">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-primary" onclick="deleteRows()">
                                                <i class="bi bi-dash"></i>
                                            </button>
                                        </div>
                                        <table class="table table-hover" id="jumlah1">
                                            <thead>
                                                <th>Pusat mengundi</th>
                                                <th>Nombor saluran</th>
                                                <th>Jumlah kertas undi yang patut berada di dalam peti undi</th>
                                                <th>Bilangan kertas undi yang ditolak</th>
                                                <th>Jumlah kertas undi yang dikeluarkan kepada pengundi tetapi tidak
                                                    dimasukkan ke dalam peti undi</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td id="col0">
                                                        <div class="mb-3">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                    id="inputNamaHelaian" name="inputNamaHelaian"
                                                                    placeholder="Nama Helaian Mata" disabled>
                                                                <label for="inputNama">Nama Pusat Mengundi</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td id="col1" style="width: 15%;">
                                                        <div class="mb-3">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control"
                                                                    id="inputNamaHelaian" name="inputNamaHelaian"
                                                                    placeholder="Nama Helaian Mata" required>
                                                                <label for="inputNama">No saluran</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td id="col2" style="width: 15%;">
                                                        <div class="mb-3">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control"
                                                                    id="inputNamaHelaian" name="inputNamaHelaian"
                                                                    placeholder="Nama Helaian Mata" required>
                                                                <label for="inputNama">Jumlah kertas yang patut
                                                                    berada di dalam peti undi</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td id="col3" style="width: 15%;">
                                                        <div class="mb-3">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control"
                                                                    id="inputNamaHelaian" name="inputNamaHelaian"
                                                                    placeholder="Nama Helaian Mata" required>
                                                                <label for="inputNama">Jumlah kertas yang patut
                                                                    berada di dalam peti undi</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td id="col4" style="width: 15%;">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control"
                                                                id="inputNamaHelaian" name="inputNamaHelaian"
                                                                placeholder="Nama Helaian Mata" required>
                                                            <label for="inputNama">Jumlah kertas yang patut
                                                                berada di dalam peti undi</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="table-responsive mt-5">
                                        <button type="button" class="btn btn-outline-primary float-end">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                        <table class="table table-hover">
                                            <thead>
                                                <th>Pusat mengundi</th>
                                                <th>Nombor saluran</th>
                                                <th>Calon A</th>
                                                <th>Calon B</th>
                                                <th>Calon C</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="mb-3">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control"
                                                                    id="inputNamaHelaian" name="inputNamaHelaian"
                                                                    placeholder="Nama Helaian Mata" disabled>
                                                                <label for="inputNama">Nama Pusat Mengundi</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 15%;">
                                                        <div class="mb-3">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control"
                                                                    id="inputNamaHelaian" name="inputNamaHelaian"
                                                                    placeholder="Nama Helaian Mata" required>
                                                                <label for="inputNama">No saluran</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 15%;">
                                                        <div class="mb-3">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control"
                                                                    id="inputNamaHelaian" name="inputNamaHelaian"
                                                                    placeholder="Nama Helaian Mata" required>
                                                                <label for="inputNama">Jumlah kertas yang patut
                                                                    berada di dalam peti undi</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 15%;">
                                                        <div class="mb-3">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control"
                                                                    id="inputNamaHelaian" name="inputNamaHelaian"
                                                                    placeholder="Nama Helaian Mata" required>
                                                                <label for="inputNama">Jumlah kertas yang patut
                                                                    berada di dalam peti undi</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="width: 15%;">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control"
                                                                id="inputNamaHelaian" name="inputNamaHelaian"
                                                                placeholder="Nama Helaian Mata" required>
                                                            <label for="inputNama">Jumlah kertas yang patut
                                                                berada di dalam peti undi</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <input type="hidden" name="inputPeranan"
                                                    value="<?= $this->session->userdata('peranan_bil')?>">
                                                <input type="hidden" name="inputPengguna"
                                                    value="<?= $this->session->userdata('pengguna_bil')?>">
                                                <button type="submit" class="btn btn-outline-success">Simpan
                                                    skor</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

</main>
</div>
</div>

<script>
function addRows(){ 
	var table = document.getElementById('jumlah1');
	var rowCount = table.rows.length;
	var cellCount = table.rows[0].cells.length; 
	var row = table.insertRow(rowCount);
	for(var i =0; i <= cellCount; i++){
		var cell = 'cell'+i;
		cell = row.insertCell(i);
		var copycel = document.getElementById('col'+i).innerHTML;
		cell.innerHTML=copycel;
	}
}
function deleteRows(){
	var table = document.getElementById('jumlah1');
	var rowCount = table.rows.length;
	if(rowCount > '2'){
		var row = table.deleteRow(rowCount-1);
		rowCount--;
	}
	else{
		alert('There should be atleast one row');
	}
}
</script>

<?php $this->load->view('negeri_na/susunletak/bawah'); ?>