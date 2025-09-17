<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  
  <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
  
  <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>

  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  
  <script>
      particlesJS.load('particles-js', '<?= base_url("assets/vendor/particles/particles.json") ?>', function() {
          console.log('callback - particles.js config loaded');
      });
  </script>

  <script src="<?= base_url('assets/js/main.js') ?>"></script>

  <script>
  $(document).ready(function() {

      // --- Password Visibility Toggle ---
      $('#togglePassword').on('click', function() {
          const passwordField = $('#yourPassword');
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
          e.preventDefault();
          const loginButton = $('#login_button');
          const spinner = loginButton.find('.spinner-border');
          const buttonText = loginButton.find('#button-text');
          const messageArea = $('#message-area');
          loginButton.prop('disabled', true);
          spinner.removeClass('d-none');
          buttonText.text('Sila Tunggu...');
          messageArea.html('');

          $.ajax({
              type: "POST",
              url: $(this).attr('action'),
              data: $(this).serialize(),
              dataType: "json",
              success: function(response) {
                  if (response.success) {
                      messageArea.html('<div class="alert alert-success">Login berjaya! Mengalihkan...</div>');
                      window.location.href = response.redirect_url;
                  } else {
                      messageArea.html('<div class="alert alert-danger">' + response.message + '</div>');
                      loginButton.prop('disabled', false);
                      spinner.addClass('d-none');
                      buttonText.text('Log Masuk');
                  }
              },
              error: function() {
                  messageArea.html('<div class="alert alert-danger">Ralat pelayan! Sila cuba lagi.</div>');
                  loginButton.prop('disabled', false);
                  spinner.addClass('d-none');
                  buttonText.text('Log Masuk');
              }
          });
      });
  });
  </script>

</body>
</html>