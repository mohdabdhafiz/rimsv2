<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Penamat & Kutipan Medal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .animated-item { opacity: 0; transform: translateY(20px); transition: opacity 0.5s ease-out, transform 0.5s ease-out; }
        .animated-item.is-visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="text-center mb-8 animated-item">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Kaunter Pendaftaran Penamat</h1>
            <p class="mt-2 text-md sm:text-lg text-gray-600">Gunakan halaman ini untuk merekod peserta yang tiba di garisan penamat.</p>
        </header>
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md animated-item" style="transition-delay: 100ms;">
            <h2 class="text-xl font-semibold mb-4 text-center">Cari Peserta</h2>
            <?php echo form_open('merdeka/carian_penamat'); ?>
                <div class="space-y-4">
                    <div>
                        <label for="search-term" class="block text-sm font-medium text-gray-700 mb-1">Cari mengikut No. KP/Pasport</label>
                        <input type="text" name="search_term" id="search-term" placeholder="Masukkan ID peserta untuk carian..." class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 transition-transform transform hover:scale-105">Cari Penamat</button>
                </div>
            <?php echo form_close(); ?>
        </div>
        <?php if (isset($result) && !empty($result)): ?>
            <div id="checkin-result" class="max-w-2xl mx-auto mt-6 animated-item is-visible">
                <?php
                    $colors = ['success' => 'bg-green-100 text-green-800 border-green-400', 'error' => 'bg-red-100 text-red-800 border-red-400', 'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-400'];
                    $color_class = isset($colors[$result['status']]) ? $colors[$result['status']] : 'bg-gray-100';
                ?>
                <div class="p-4 rounded-lg border <?php echo $color_class; ?>">
                    <p class="font-semibold"><?php echo html_escape($result['message']); ?></p>
                    <?php if (isset($result['participant']) && !empty($result['participant']['unique_id'])): ?>
                        <div class="mt-2 pt-2 border-t border-gray-300 text-sm">
                            <p><strong>No. KP/Pasport:</strong> <?php echo html_escape($result['participant']['unique_id']); ?></p>
                            <p><strong>Nama Penuh:</strong> <?php echo html_escape($result['participant']['full_name']); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($result['status']) && $result['status'] === 'success' && strpos($result['message'], 'LAYAK') !== false): ?>
                        <a href="<?php echo site_url('merdeka/tanda_tamat/' . urlencode($result['participant']['unique_id'])); ?>" class="block text-center w-full mt-4 bg-purple-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-purple-700 transition-transform transform hover:scale-105">Tanda Sudah Tamat & Beri Medal</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="text-center mt-8 animated-item" style="transition-delay: 200ms;">
            <a href="<?php echo site_url('merdeka/index'); ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold">&larr; Kembali ke Halaman Pendaftaran Baju</a>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.animated-item');
        items.forEach(item => { setTimeout(() => { item.classList.add('is-visible'); }, 100); });
    });
</script>
</body>
</html>
