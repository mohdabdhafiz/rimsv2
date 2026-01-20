<!-- /application/views/pegawai/senarai.php -->
<!-- Rekabentuk Senarai Jadual mengikut tema NiceAdmin -->
<section class="section">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= site_url('sismap') ?>">RIMS@SISMAP</a></li>
            <li class="breadcrumb-item" aria-current="page">Pegawai</li>
            <li class="breadcrumb-item active" aria-current="page">Senarai Petugas PRU</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
        <div class="card-title d-flex justify-content-between align-items-center mb-4">
            <h1>Senarai Petugas Pilihan Raya</h1>
            <a href="<?= site_url('pegawai/tambah') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Pegawai
            </a>
        </div>
        <?php if (!empty($senarai)): ?>
            <div class="table-responsive">
            <table id="pegawaiTable" class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jawatan</th>
                        <th>Bahagian</th>
                        <th>Pilihan Raya</th>
                        <th>Tarikh Dicipta</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($senarai as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($row->pg_nama) ?></td>
                            <td><?= htmlspecialchars($row->pg_jawatan) ?></td>
                            <td><?= htmlspecialchars($row->pg_bahagian) ?></td>
                            <td>
                                <a href="<?= site_url('pegawai/pru_view/' . $row->pru_bil) ?>">
                                    <?= htmlspecialchars($row->pru_singkatan) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($row->pg_dicipta_pada) ?></td>
                            <td>
                                <a href="<?= site_url('pegawai/view/' . $row->pengguna_bil) ?>" class="btn btn-sm btn-outline-primary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?= site_url('pegawai/delete/' . $row->pg_bil) ?>" class="btn btn-sm btn-outline-danger" title="Padam" onclick="return confirm('Padam pegawai ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="pagination" class="mt-3"></div>
            <script>
                // Simple JS pagination for the table with "Show All" option
                let rowsPerPage = 10;
                const table = document.getElementById('pegawaiTable');
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const pagination = document.getElementById('pagination');
                let currentPage = 1;
                let totalPages = Math.ceil(rows.length / rowsPerPage);

                function showPage(page) {
                    currentPage = page;
                    if (page === 'all') {
                        rows.forEach(row => row.style.display = '');
                    } else {
                        rows.forEach((row, i) => {
                            row.style.display = (i >= (page - 1) * rowsPerPage && i < page * rowsPerPage) ? '' : 'none';
                        });
                    }
                    renderPagination();
                }

                function renderPagination() {
                    pagination.innerHTML = '';
                    if (totalPages <= 1) return;
                    for (let i = 1; i <= totalPages; i++) {
                        const btn = document.createElement('button');
                        btn.textContent = i;
                        btn.className = 'btn btn-sm ' + (i === currentPage ? 'btn-primary' : 'btn-outline-primary');
                        btn.style.marginRight = '4px';
                        btn.onclick = () => showPage(i);
                        pagination.appendChild(btn);
                    }
                    // Show All button
                    const showAllBtn = document.createElement('button');
                    showAllBtn.textContent = 'Semua';
                    showAllBtn.className = 'btn btn-sm ' + (currentPage === 'all' ? 'btn-primary' : 'btn-outline-secondary');
                    showAllBtn.style.marginLeft = '8px';
                    showAllBtn.onclick = () => showPage('all');
                    pagination.appendChild(showAllBtn);
                }

                showPage(1);
            </script>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center mt-5">
            <i class="bi bi-info-circle"></i> Tiada data pegawai.
            </div>
        <?php endif; ?>
        </div>
        </div>
    </section>
    <style>
    .profile-img {
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: 2px solid #f6f9ff;
    }
    </style>
