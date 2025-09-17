
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>Nama Program</th>
                    <th>Tarikh</th>
                    <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($senaraiProgram)): ?>
                    <?php foreach ($senaraiProgram as $program): ?>
                        <tr>
                        <td><?= html_escape($program->program_nama) ?></td>
                        <td><?= date('d/m/Y', strtotime($program->program_tarikh)) ?></td>
                        <td><?= html_escape($program->program_lokasi) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr><td colspan="3">Tiada program dijumpai.</td></tr>
                    <?php endif; ?>
                </tbody>
                </table>

                <!-- Pagination -->
                <?= $pagination ?>


       
