<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hantar Sijil Penyertaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Halaman Pentadbir Sijil</h1>
        </header>
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md text-center">
            <?php if ($this->session->userdata('sijil_access_granted')): ?>
                <!-- BAHAGIAN PENTADBIR JIKA PIN BETUL -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-2">Hantar Sijil Pukal</h2>
                    <p class="mb-4 text-sm">Hantar e-mel sijil kepada semua peserta baharu dari Google Sheet yang belum menerimanya.</p>
                    <a href="<?php echo site_url('merdeka/proses_sijil'); ?>" class="w-full inline-block bg-green-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-green-700">
                        Mula Proses & Hantar Sijil
                    </a>
                    <!-- TAMBAH PAUTAN INI -->
                    <a href="<?php echo site_url('merdeka/senarai_sijil'); ?>" class="mt-2 w-full inline-block bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded-lg hover:bg-gray-300">
                        Lihat Senarai Penerima Sijil
                    </a>
                </div>

                <hr class="my-6 border-t-2 border-gray-200 border-dashed">
                <div>
                    <h2 class="text-xl font-semibold mb-2">Tambah Peserta Secara Manual</h2>
                    <p class="mb-4 text-sm">Gunakan borang ini jika peserta tiada dalam Google Sheet. Sistem akan menyemak duplikasi sebelum menyimpan.</p>
                    <?php echo form_open('merdeka/tambah_manual'); ?>
                        <div class="space-y-4 text-left">
                            <div>
                                <label for="unique_id" class="block text-sm font-medium text-gray-700 mb-1">No. KP/Pasport</label>
                                <input type="text" name="unique_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                            </div>
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Penuh</label>
                                <input type="text" name="full_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Emel</label>
                                <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                            </div>
                            <div>
                                <label for="shirt_size" class="block text-sm font-medium text-gray-700 mb-1">Saiz Baju</label>
                                <select name="shirt_size" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full bg-yellow-500 text-yellow-900 font-bold py-3 px-4 rounded-lg hover:bg-yellow-600">Tambah Peserta</button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            <?php else: ?>
                <h2 class="text-xl font-semibold mb-4">Sila Masukkan PIN</h2>
                <p class="mb-4">Halaman ini dilindungi. Sila masukkan PIN untuk meneruskan.</p>
                <?php echo form_open('merdeka/sijil'); ?>
                    <div class="space-y-4">
                        <div>
                            <label for="pin" class="sr-only">PIN</label>
                            <input type="password" name="pin" id="pin" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-center" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700">Sahkan</button>
                    </div>
                <?php echo form_close(); ?>
            <?php endif; ?>
        </div>
        <?php if ($this->session->flashdata('result')): $result = $this->session->flashdata('result'); ?>
            <div class="max-w-2xl mx-auto mt-6 p-4 rounded-lg border <?php echo $result['status'] == 'success' ? 'bg-green-100 text-green-800 border-green-400' : 'bg-red-100 text-red-800 border-red-400'; ?>">
                <p class="font-semibold"><?php echo html_escape($result['message']); ?></p>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="max-w-2xl mx-auto mt-6 p-4 rounded-lg border bg-red-100 text-red-800 border-red-400">
                <p class="font-semibold"><?php echo html_escape($this->session->flashdata('error')); ?></p>
            </div>
        <?php endif; ?>
        <div class="text-center mt-8">
            <a href="<?php echo site_url('merdeka/index'); ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold">&larr; Kembali ke Halaman Pendaftaran</a>
        </div>
    </div>
</body>
</html>
