<?php $this->load->view('login/susunletak/atas'); ?>

<div id="particles-js"></div>

<style>
    /* CSS BAHARU UNTUK MEMBUANG SCROLLBAR */
    body {
        overflow: hidden;
    }
    /* CSS untuk latar belakang animasi dan kesan frosted glass */
    #particles-js {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: #003366; /* Warna Latar Madani Blue */
        background-image: url('');
        background-size: cover;
        background-position: 50% 50%;
        background-repeat: no-repeat;
        z-index: -1;
    }
    .register .card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .card-title, .text-center.small, .form-label {
        color: #fff;
    }
</style>

<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="<?= base_url() ?>" class="logo d-flex align-items-center w-auto">
                                <img src="<?= base_url('assets/img/logo_japen_putih.png') ?>" alt="Logo Jabatan Penerangan" style="max-height: 60px;">
                            </a>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4" id="greeting">Log Masuk Akaun Anda</h5>
                                    <p class="text-center small">Selamat Datang ke Sistem RIMS</p>
                                </div>
                                <div id="message-area" class="mb-3"></div>
                                <?= form_open('pengguna/login', ['id' => 'loginForm', 'class' => 'row g-3']); ?>
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">ID Pengguna</label>
                                        <input type="text" name="pengguna_ic" class="form-control" id="yourUsername" required autofocus>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Kata Laluan</label>
                                        <div class="input-group">
                                            <input type="password" name="no_tel" class="form-control" id="yourPassword" required>
                                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;"><i class="bi bi-eye-slash"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-danger w-100" type="submit" id="login_button">
                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            <span id="button-text">Log Masuk</span>
                                        </button>
                                    </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const greetingElement = document.getElementById('greeting');
    const currentHour = new Date().getHours();
    if (currentHour < 12) {
        greetingElement.textContent = 'Selamat Pagi';
    } else if (currentHour < 18) {
        greetingElement.textContent = 'Selamat Petang';
    } else {
        greetingElement.textContent = 'Selamat Malam';
    }
});

</script>

<?php $this->load->view('login/susunletak/bawah'); ?>