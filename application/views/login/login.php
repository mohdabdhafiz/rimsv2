<?php
$this->load->view('login/susunletak/atas');
?>

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="<?= base_url() ?>" class="logo d-flex align-items-center w-auto">
                                <span class="d-block">RIMS</span>
                            </a>
                        </div><div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <p class="text-center small">Reporting and Issues Management System</p>
                                </div>
                                
                                <div id="message-area"></div>

                                <?php echo form_open('pengguna/login', ['id' => 'loginForm']); ?>

                                <div class="form-floating mb-2">
                                    <input autofocus type="text" class="form-control" id="floatingInputKP" placeholder="ID Pengguna" name="pengguna_ic" required>
                                    <label for="floatingInputKP">ID</label>
                                </div>
                                
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="floatingPasswordNT" placeholder="Kata Laluan" name="no_tel" required>
                                        <label for="floatingPasswordNT">Password</label>
                                    </div>
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                </div>

                                <button class="w-100 btn btn-primary mt-3" type="submit" id="login_button">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    <span id="button-text">Log Masuk</span>
                                </button>
                                
                                <?php echo form_close(); ?> </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>
</main><script>
$(document).ready(function() {
    
    // --- Password Visibility Toggle ---
    $('#togglePassword').on('click', function() {
        const passwordField = $('#floatingPasswordNT');
        const passwordFieldType = passwordField.attr('type');
        const icon = $(this).find('i');

        if (passwordFieldType === 'password') {
            passwordField.attr('type', 'text');
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        } else {
            passwordField.attr('type', 'password');
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        }
    });

    // --- AJAX Form Submission ---
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default page reload

        const loginButton = $('#login_button');
        const spinner = loginButton.find('.spinner-border');
        const buttonText = loginButton.find('#button-text');
        const messageArea = $('#message-area');

        // Show loading state
        loginButton.prop('disabled', true);
        spinner.removeClass('d-none');
        buttonText.text('Sila Tunggu...');
        messageArea.html(''); // Clear previous messages

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // On success, show a success message and redirect
                    messageArea.html('<div class="alert alert-success">Login berjaya! Mengalihkan...</div>');
                    window.location.href = response.redirect_url;
                } else {
                    // On failure, show the error message
                    messageArea.html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function() {
                // Handle server or network errors
                messageArea.html('<div class="alert alert-danger">Ralat pelayan! Sila cuba lagi.</div>');
            },
            complete: function() {
                // Always restore the button to its original state
                loginButton.prop('disabled', false);
                spinner.addClass('d-none');
                buttonText.text('Log Masuk');
            }
        });
    });
});
</script>


<?php
$this->load->view('login/susunletak/bawah');
?>