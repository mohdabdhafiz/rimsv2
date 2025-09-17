<div class="container-fluid">
    <div class="p-3 border rounded mb-3">
        <h1>SENARAI GRADING NEGERI <?php echo strtoupper($negeri); ?></h1>
        <?php echo anchor(base_url(), 'Laman Utama', "class='btn btn-primary w-100 mt-3'"); ?>
    </div>

    <div class="row g-3">
        <?php foreach($senarai_parlimen as $parlimen): ?>
        <div class="col-12 col-lg-4">
            <div class="p-3 border rounded text-center">
                <h2>PARLIMEN A</h2>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</div>