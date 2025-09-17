<div class="card">
    <div class="card-body">
        <h1 class="card-title">Senarai Laporan Program : <?= $pengguna->nama_penuh ?></h1>
        <p>Bilangan Program : <?= count($senaraiProgram) ?></p>
        <div class="table-responsive">
            <table class="table table-bordered table-hovered">
                <thead>
                    <tr>
                        <th>Status Laporan</th>
                        <th>Nombor Siri</th>
                        <th>Negeri</th>
                        <th>Daerah</th>
                        <th>Parlimen</th>
                        <th>DUN</th>
                        <th>Nama Program</th>
                        <th>Tarikh dan Masa Program</th>
                        <th>Lokasi Program</th>
                        <th>Perasmi Program</th>
                        <th>Bilangan Khalayak</th>
                        <th>Senarai Naratif / Tajuk Hebahan / Ceramah Program</th>
                        <th>Senarai Pengisian Program</th>
                        <th>Senarai Komuniti</th>
                        <th>Senarai OBP</th>
                        <th>Senarai Kelab Malaysiaku</th>
                        <th>Senarai Kerjasama Agensi Lain</th>
                        <th>Senarai Edaran Penerbitan</th>
                        <th>Bilangan Gambar / Video</th>
                        <th>Operasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($senaraiProgram as $program): ?>
                    <tr>
                        <td><?= $program->programStatus ?></td>
                        <td><?= $program->programNomborSiri ?></td>
                        <td><?= $program->negeriNama ?></td>
                        <td><?= $program->daerahNama ?></td>
                        <td><?= $program->parlimenNama ?></td>
                        <td><?= $program->dunNama ?></td>
                        <td><?= $program->programNama ?></td>
                        <td><?= $program->programTarikhMasa ?></td>
                        <td><?= $program->programLokasi ?></td>
                        <td><?= $program->programPerasmi ?></td>
                        <td><?= $program->programKhalayak ?></td>
                        <td><?= $program->naratifSenarai ?></td>
                        <td><?= $program->pengisianSenarai ?></td>
                        <td><?= $program->komunitiSenarai ?></td>
                        <td><?= $program->obpSenarai ?></td>
                        <td><?= $program->kelabMalaysiakuSenarai ?></td>
                        <td><?= $program->agensiSenarai ?></td>
                        <td><?= $program->penerbitanSenarai ?></td>
                        <td><?= $program->gambarBilangan ?></td>
                        <td>
                            <a href="<?= site_url('program/bil/'.$program->programNomborSiri) ?>" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Maklumat Lanjut">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>