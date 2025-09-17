<?php 
$this->load->view('ppd_mege/susunletak/atas');
$this->load->view('ppd_mege/susunletak/sidebar');
$this->load->view('ppd_mege/susunletak/navbar');
?>

<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">RIMS@PENGGUNA</h1>
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bilangan Pengguna Mengikut Jawatan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="penggunaJawatan" class="table">
                            <thead>
                                <tr>
                                    <th>Nama Perjawatan</th>
                                    <th>Bilangan Pengguna (Orang)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $jumlahAnggota = 0;
                                foreach($senaraiPerjawatan as $jawatan): ?>
                                <tr>
                                    <td><?= $jawatan->pekerjaan ?></td>
                                    <td>
                                        <?php 
                                            echo $jawatan->jumlah; 
                                            $jumlahAnggota = $jumlahAnggota + $jawatan->jumlah;
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Jumlah</th>
                                    <th><?= $jumlahAnggota ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        

        


    </div>

</div>

<?php $this->load->view('ppd_mege/susunletak/bawah'); ?>

<script>
    $(document).ready( function () {
        $('#penggunaJawatan').DataTable();
    } );
</script>


