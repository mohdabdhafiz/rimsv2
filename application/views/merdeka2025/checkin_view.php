<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Baju - Merdeka Fun Run</title>
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
            <h1 class="text-4xl sm:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-red-600">MERDEKA 6.8 KM FUN RUN & WALK</h1>
            <p class="mt-2 text-lg sm:text-xl font-semibold text-gray-700">27 JULAI 2025 | AHAD | 7.00 PAGI | DATARAN TANJUNG EMAS, MUAR, JOHOR</p>
        </header>

        <div class="max-w-2xl mx-auto mb-8 bg-white p-4 rounded-xl shadow-md text-center animated-item" style="transition-delay: 100ms;">
             <h2 class="text-lg font-semibold mb-2">Kiraan Detik ke Acara</h2>
             <div id="countdown" class="text-2xl font-bold text-indigo-600"></div>
        </div>

        <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md animated-item" style="transition-delay: 200ms;">
            <h2 class="text-xl font-semibold mb-4 text-center">Cari Peserta</h2>
            <?php echo form_open('merdeka/search'); ?>
                <div class="space-y-4">
                    <div>
                        <label for="search-term" class="block text-sm font-medium text-gray-700 mb-1">Cari mengikut No. KP/Pasport</label>
                        <input type="text" name="search_term" id="search-term" placeholder="Masukkan ID peserta untuk carian..." class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-green-700 transition-transform transform hover:scale-105">Cari</button>
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
                            <p><strong>Emel:</strong> <?php echo html_escape($result['participant']['email']); ?></p>
                            <p><strong>Saiz Baju:</strong> <?php echo html_escape($result['participant']['shirt_size']); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($result['status']) && $result['status'] === 'success' && strpos($result['message'], 'LAYAK') !== false): ?>
                        <a href="<?php echo site_url('merdeka/mark_collected/' . urlencode($result['participant']['unique_id'])); ?>" class="block text-center w-full mt-4 bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition-transform transform hover:scale-105">Tanda Sudah Ambil</a>
                    <?php endif; ?>
                    <?php if (isset($result['status']) && $result['status'] === 'error'): ?>
                        <div class="mt-4 pt-4 border-t border-red-300">
                            <h3 class="font-bold text-red-900">Apa perlu buat?</h3>
                            <p class="text-sm text-red-800 mt-1">Sila maklumkan peserta untuk mengimbas QR Code pendaftaran yang disediakan di kaunter pendaftaran.</p>
                            <div class="mt-3 text-sm text-red-800">
                                <p>Untuk bantuan lanjut, hubungi penyelaras:</p>
                                <ul class="list-disc list-inside ml-2">
                                    <li>Puan Zulaikha: 019-2028501</li>
                                    <li>Puan Faridah: 011-20167800</li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="text-center mt-8 animated-item" style="transition-delay: 300ms;">
            <a href="<?php echo site_url('merdeka/dashboard'); ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold">Lihat Papan Pemuka &rarr;</a>
            <span class="mx-2 text-gray-400">|</span>
            <a href="<?php echo site_url('merdeka/penamat'); ?>" class="text-purple-600 hover:text-purple-800 font-semibold">Pergi ke Kaunter Penamat &rarr;</a>
            <span class="mx-2 text-gray-400">|</span>
            <a href="<?php echo site_url('merdeka/sijil'); ?>" class="text-green-600 hover:text-green-800 font-semibold">Halaman Sijil &rarr;</a>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.animated-item');
        items.forEach(item => { setTimeout(() => { item.classList.add('is-visible'); }, 100); });
        const countDownDate = new Date("Jul 27, 2025 07:00:00").getTime();
        const x = setInterval(function() {
            const now = new Date().getTime();
            const distance = countDownDate - now;
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("countdown").innerHTML = days + "h " + hours + "j " + minutes + "m " + seconds + "s ";
            if (distance < 0) { clearInterval(x); document.getElementById("countdown").innerHTML = "ACARA SEDANG BERLANGSUNG"; }
        }, 1000);
    });
</script>
</body>
</html>
