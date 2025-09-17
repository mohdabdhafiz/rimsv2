<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><?= anchor(base_url(), 'RIMS') ?></li>
    <li class="breadcrumb-item active" aria-current="page">Daerah</li>
  </ol>
</nav>

<div class="p-3 border rounded mb-3">
    <p><strong>Bilangan Daerah, Parlimen dan DUN Mengikut Negeri</strong></p>
    <div class="table-responsive">
        <table class="table table-sm table-striped table-hover">
            <tr>
                <th>#</th>
                <th>Nama Negeri</th>
                <th>Bilangan Daerah</th>
                <th>Bilangan Parlimen</th>
                <th>Bilangan DUN</th>
            </tr>
            <?php
            $bilangan = 1;
            $jumlahDaerah = 0;
            $jumlahParlimen = 0;
            $jumlahDun = 0;
            $namaNegeri = array();
            foreach($senaraiNegeri as $negeri){
                $namaNegeri[] = $negeri->nt_nama;
            }
            array_multisort($namaNegeri, SORT_ASC, $senaraiNegeri);
            foreach($senaraiNegeri as $negeri):
            ?>
            <tr>
                <td><?= $bilangan++ ?></td>
                <td><?= anchor('daerah/negeri/'.$negeri->nt_bil, $negeri->nt_nama) ?></td>
                <td>
                    <?php 
                    $senaraiDaerah = $dataDaerah->daerah_negeri($negeri->nt_bil);
                    $bilanganDaerah = count($senaraiDaerah);
                    echo $bilanganDaerah;
                    $jumlahDaerah = $jumlahDaerah + $bilanganDaerah;
                    ?>
                </td>
                <td>
                    <?php
                    $senaraiParlimen = $dataParlimen->parlimen_negeri($negeri->nt_bil);
                    $bilanganParlimen = count($senaraiParlimen);
                    echo $bilanganParlimen;
                    $jumlahParlimen = $jumlahParlimen + $bilanganParlimen;
                    ?>
                </td>
                <td>
                    <?php
                    $senaraiDun = $dataDun->dun_negeri($negeri->nt_bil);
                    $bilanganDun = count($senaraiDun);
                    echo $bilanganDun;
                    $jumlahDun = $jumlahDun + $bilanganDun;
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th></th>
                <th></th>
                <th><?= $jumlahDaerah ?></th>
                <th><?= $jumlahParlimen ?></th>
                <th><?= $jumlahDun ?></th>
            </tr>
        </table>
    </div>
</div>