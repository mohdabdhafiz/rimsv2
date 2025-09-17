<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Sijil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">Status Penghantaran Sijil</h1>
            <p class="mt-2 text-md sm:text-lg text-gray-600">Rekod semua sijil yang telah dihantar dan yang masih menunggu.</p>
        </header>

        <!-- Mesej Maklum Balas -->
        <?php if ($this->session->flashdata('result')): $result = $this->session->flashdata('result'); ?>
            <div class="max-w-5xl mx-auto mb-4 p-4 rounded-lg border <?php echo $result['status'] == 'success' ? 'bg-green-100 text-green-800 border-green-400' : 'bg-red-100 text-red-800 border-red-400'; ?>">
                <p class="font-semibold"><?php echo html_escape($result['message']); ?></p>
            </div>
        <?php endif; ?>

        <div class="max-w-5xl mx-auto space-y-8">
            <!-- JADUAL 1: PENERIMA SIJIL -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-bold mb-4 text-green-700">Senarai Penerima Sijil</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Siri</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Penuh</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. KP/Pasport</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarikh Hantar</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($recipients)): ?>
                                <?php foreach ($recipients as $recipient): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo 'MFR2025-' . str_pad($recipient['id'], 5, '0', STR_PAD_LEFT); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo html_escape($recipient['full_name']); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo html_escape($recipient['unique_id']); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo date('d F Y, g:i a', strtotime($recipient['certificate_sent_at'])); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="<?php echo site_url('merdeka/hantar_semula_sijil/' . urlencode($recipient['unique_id'])); ?>" class="text-blue-600 hover:text-blue-900">Hantar Semula</a>
                                            <a href="<?php echo site_url('merdeka/muat_turun_sijil/' . urlencode($recipient['unique_id'])); ?>" class="text-green-600 hover:text-green-900">Muat Turun</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tiada sijil yang telah dihantar lagi.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- JADUAL 2: BELUM TERIMA SIJIL -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-bold mb-4 text-yellow-700">Senarai Menunggu Penghantaran Sijil</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Penuh</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. KP/Pasport</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Emel</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (!empty($non_recipients)): ?>
                                <?php foreach ($non_recipients as $non_recipient): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo html_escape($non_recipient['full_name']); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo html_escape($non_recipient['unique_id']); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo html_escape($non_recipient['email']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">Semua peserta yang layak telah menerima sijil mereka.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="<?php echo site_url('merdeka/sijil'); ?>" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                &larr; Kembali ke Halaman Pentadbir Sijil
            </a>
        </div>
    </div>
</body>
</html>
