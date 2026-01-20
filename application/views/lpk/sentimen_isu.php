
    <div class="pagetitle">
        <h1>Urus Tadbir Sentimen Isu</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= site_url('sentimen') ?>"><i class="bi bi-house"></i> Laporan Persepsi Terhadap Kerajaan</a></li>
                <li class="breadcrumb-item active">Halaman Utama</li>
            </ol>
        </nav>
    </div><section class="section dashboard">
        <div class="row">

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Isu <span>| Aktif</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-journal-text"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= htmlspecialchars($statistik->jumlah_isu_aktif); ?></h6>
                                <span class="text-muted small">Isu sedang dipantau</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card info-card revenue-card">
                     <div class="card-body">
                        <h5 class="card-title">Sentimen Dominan <span>| Keseluruhan</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-hand-thumbs-up-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= htmlspecialchars($statistik->dominan_keseluruhan); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                 <div class="card info-card customers-card">
                     <div class="card-body">
                        <h5 class="card-title">Isu Paling Negatif <span>| Minggu Ini</span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-graph-down-arrow"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= htmlspecialchars($statistik->isu_paling_negatif); ?></h6>
                                <span class="text-danger small fw-bold"><?= number_format($statistik->jumlah_paling_negatif); ?> Laporan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" data-aos="fade-up" data-aos-delay="400">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="true">
                                    <i class="bi bi-pie-chart-fill me-1"></i> Dashboard Visual
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-list" type="button" role="tab" aria-controls="list" aria-selected="false">
                                    <i class="bi bi-list-ul me-1"></i> Senarai & Pengurusan Isu
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-form" type="button" role="tab" aria-controls="form" aria-selected="false">
                                    <i class="bi bi-plus-circle me-1"></i> Borang Tambah Isu
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content pt-3">
                            
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5 class="card-title" style="padding-left: 15px; padding-top: 15px;">Taburan Sentimen Keseluruhan</h5>
                                        <div id="sentimentDonutChart" style="min-height: 400px;"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5 class="card-title" style="padding-left: 15px; padding-top: 15px;">Sentimen Mengikut 5 Isu Utama</h5>
                                        <div id="topIssuesBarChart" style="min-height: 400px;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab-list" role="tabpanel" aria-labelledby="list-tab">
    <h5 class="card-title">Urus Tadbir Isu Sentimen</h5>
    <p>Urus tadbir semua isu sentimen yang sedang dipantau. Gunakan ruangan carian untuk menapis rekod.</p>

    <div class="table-responsive">
        <table class="table table-hover datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Isu</th>
                    <th scope="col">Tarikh Dibina</th>
                    <th scope="col" class="text-center">Jumlah Laporan</th>
                    <th scope="col" class="text-center">Sentimen Dominan</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 1; 
                foreach($senarai_isu as $isu): 
                ?>
                <tr>
                    <th scope="row"><?= $count++; ?></th>
                    <td>
                        <strong><?= htmlspecialchars($isu->sit_isu); ?></strong>
                    </td>
                    <td><?= date('d M Y', strtotime($isu->sit_tarikh_dibina)); ?></td>
                    <td class="text-center"><?= number_format($isu->jumlah_laporan); ?></td>
                    <td class="text-center">
                        <?php 
                        if($isu->sentimen_dominan == 'POSITIF') $badge_color = 'bg-success';
                        elseif($isu->sentimen_dominan == 'NEGATIF') $badge_color = 'bg-danger';
                        else $badge_color = 'bg-warning';
                        ?>
                        <span class="badge <?= $badge_color; ?>"><?= htmlspecialchars($isu->sentimen_dominan); ?></span>
                    </td>
                    <td class="text-center">
                        <?php if($isu->sit_aktif == 'YA'): ?>
                            <span class="badge bg-primary">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="<?= site_url('sentimen/lihat/' . $isu->sit_bil) ?>" class="btn btn-info btn-sm" title="Lihat"><i class="bi bi-eye"></i></a>
                        <a href="<?= site_url('sentimen/kemaskini_isu/' . $isu->sit_bil) ?>" class="btn btn-primary btn-sm" title="Kemaskini"><i class="bi bi-pencil"></i></a>
                        <a href="<?= site_url('sentimen/padam_isu/' . $isu->sit_bil) ?>" class="btn btn-danger btn-sm" title="Padam" onclick="return confirm('Anda pasti untuk memadam isu ini?')"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

                            <div class="tab-pane fade" id="tab-form" role="tabpanel" aria-labelledby="form-tab">
    <h5 class="card-title">Daftar Isu Baru untuk Pemantauan</h5>
    <p>Lengkapkan maklumat di bawah untuk mendaftarkan isu baharu. Medan bertanda <span class="text-danger">*</span> adalah wajib diisi.</p>

    <form method="POST" action="<?= site_url('sentimen/simpan_isu_baharu') ?>">

        <div class="row mb-3">
            <label for="sit_isu" class="col-sm-3 col-form-label">Nama Isu <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="sit_isu" name="sit_isu" placeholder="Cth: Inisiatif Kewangan Kerajaan Terkini" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="sit_keterangan" class="col-sm-3 col-form-label">Huraian</label>
            <div class="col-sm-9">
                <textarea class="form-control" style="height: 120px" id="sit_keterangan" name="sit_keterangan" placeholder="Berikan penerangan ringkas mengenai skop isu ini untuk rujukan."></textarea>
            </div>
        </div>
        
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Status Pemantauan</label>
            <div class="col-sm-9 pt-2">
                 <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="sit_aktif" name="sit_aktif" value="YA" checked>
                    <label class="form-check-label" for="sit_aktif">Aktifkan isu ini untuk pemantauan sentimen.</label>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i> Simpan Isu</button>
            <button type="reset" class="btn btn-secondary">Set Semula Borang</button>
        </div>

    </form>
    </div>
                        </div>
                    
                    </div>
                </div>
            </div>
    </section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Donut Chart
        var sentimentDonutChart = new ApexCharts(document.querySelector("#sentimentDonutChart"), {
            series: <?= json_encode($carta_donut['data']); ?>,
            chart: {
                height: 400,
                type: 'donut',
            },
            labels: <?= json_encode($carta_donut['labels']); ?>,
            colors: ['#28a745', '#ffc107', '#dc3545'],
            legend: { position: 'bottom' }
        });
        sentimentDonutChart.render();

        // Bar Chart
        var topIssuesBarChart = new ApexCharts(document.querySelector("#topIssuesBarChart"), {
          series: [{
            name: 'Positif',
            data: <?= json_encode($carta_bar['positif']); ?>
          }, {
            name: 'Neutral',
            data: <?= json_encode($carta_bar['neutral']); ?>
          }, {
            name: 'Negatif',
            data: <?= json_encode($carta_bar['negatif']); ?>
          }],
          chart: {
            type: 'bar',
            height: 400,
            stacked: true,
          },
          plotOptions: { bar: { horizontal: true, } },
          stroke: { width: 1, colors: ['#fff'] },
          xaxis: {
            categories: <?= json_encode($carta_bar['labels']); ?>,
          },
          tooltip: {
            y: { formatter: function(val) { return val + " Laporan" } }
          },
          colors: ['#28a745', '#ffc107', '#dc3545'],
          fill: { opacity: 1 },
          legend: { position: 'top', horizontalAlign: 'left', offsetX: 40 }
        });
        topIssuesBarChart.render();
    });
</script>