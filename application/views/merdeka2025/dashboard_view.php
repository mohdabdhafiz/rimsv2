<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5">
    <title>Papan Pemuka - Merdeka Fun Run</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .animated-card { opacity: 0; transform: scale(0.95); transition: opacity 0.4s ease-out, transform 0.4s ease-out; }
        .animated-card.is-visible { opacity: 1; transform: scale(1); }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Papan Pemuka Kutipan</h1>
            <p class="mt-2 text-md sm:text-lg text-gray-600">Statistik dikemas kini secara automatik setiap 5 saat.</p>
        </header>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            <div class="bg-white p-6 rounded-xl shadow-md text-center animated-card">
                <h2 class="text-gray-500 text-lg">Baju Dikutip</h2>
                <p class="text-4xl font-bold mt-2 text-blue-600"><?php echo $total_collected; ?> / <?php echo $total_registered; ?></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md text-center animated-card" style="transition-delay: 100ms;">
                <h2 class="text-gray-500 text-lg">Medal Diberikan</h2>
                <p class="text-4xl font-bold mt-2 text-purple-600"><?php echo $total_finishers; ?></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md animated-card" style="transition-delay: 200ms;">
                <h2 class="text-gray-500 text-lg text-center mb-3">Peratusan Pendaftaran</h2>
                <div class="w-full bg-gray-200 rounded-full h-8">
                    <div class="bg-indigo-600 h-8 rounded-full text-white text-md flex items-center justify-center font-bold transition-all duration-500" style="width: <?php echo $percentage; ?>%;">
                        <?php echo $percentage; ?>%
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-6xl mx-auto mt-8 bg-white p-6 rounded-xl shadow-md animated-card" style="transition-delay: 300ms;">
            <h2 class="text-xl font-bold text-center mb-4">Atur Cara Ringkas Acara</h2>
            <ul class="space-y-3 text-center md:text-left">
                <li class="p-2 bg-gray-50 rounded-lg"><strong>5:30 PAGI:</strong> Pendaftaran Peserta</li>
                <li class="p-2 bg-gray-50 rounded-lg"><strong>7:00 PAGI:</strong> Sesi Regangan</li>
                <li class="p-2 bg-gray-50 rounded-lg"><strong>7:10 PAGI:</strong> Flag Off</li>
                <li class="p-2 bg-gray-50 rounded-lg"><strong>8:30 PAGI:</strong> Pentarama & Cabutan Bertuah</li>
                <li class="p-2 bg-gray-50 rounded-lg"><strong>9:00 PAGI:</strong> Selesai</li>
            </ul>
        </div>
        <div class="text-center mt-8">
            <a href="<?php echo site_url('merdeka/index'); ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold">&larr; Kembali ke Halaman Pendaftaran Baju</a>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.animated-card');
        cards.forEach(card => { setTimeout(() => { card.classList.add('is-visible'); }, 100); });
    });
</script>
</body>
</html>
