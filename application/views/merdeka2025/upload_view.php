<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muat Naik Senarai Peserta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Muat Naik Fail Peserta</h1>
            <p class="mt-2 text-md sm:text-lg text-gray-600">Import data peserta dari fail Excel (.xlsx) atau CSV.</p>
        </header>

        <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md">
            <div class="mb-4 p-4 bg-blue-100 text-blue-800 rounded-lg text-sm">
                <h3 class="font-bold mb-2">Arahan Penting:</h3>
                <ul class="list-disc list-inside">
                    <li>Pastikan fail anda dalam format <strong>.xlsx, .xls, atau .csv</strong>.</li>
                    <li>Baris pertama fail akan dianggap sebagai <strong>header</strong> dan akan diabaikan.</li>
                    <li>Susunan lajur mestilah: <strong>A) No. KP/Pasport, B) Nama Penuh, C) Emel, D) Saiz Baju</strong>.</li>
                    <li>Sistem akan menyemak duplikasi berdasarkan No. KP/Pasport dan hanya akan mengimport peserta baharu.</li>
                </ul>
            </div>

            <?php echo form_open_multipart('merdeka/proses_muat_naik'); ?>
                <div class="space-y-4">
                    <div>
                        <label for="participant_file" class="block text-sm font-medium text-gray-700 mb-1">Pilih Fail untuk Dimuat Naik</label>
                        <input type="file" name="participant_file" id="participant_file" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700">
                        Muat Naik & Proses Fail
                    </button>
                </div>
            <?php echo form_close(); ?>
        </div>

        <div class="text-center mt-8">
            <a href="<?php echo site_url('merdeka/sijil'); ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                &larr; Kembali ke Halaman Pentadbir Sijil
            </a>
        </div>
    </div>
</body>
</html>