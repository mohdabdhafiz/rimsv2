  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>JABATAN PENERANGAN MALAYSIA @ <?= date("Y") ?></span></strong>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo base_url(); ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?php echo base_url(); ?>/assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/vendor/quill/quill.min.js"></script>
  
  <!-- Skrip jQuery dan DataTables dari CDN -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  
  <script src="<?php echo base_url(); ?>/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url(); ?>/assets/js/main.js"></script>

  <script>
    $(document).ready(function() {
        // Mengaktifkan DataTables pada jadual laporan
        $('#laporanTable').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/ms.json" // Terjemahan ke Bahasa Melayu
            }
        });
    });
  </script>

</body>

</html>
