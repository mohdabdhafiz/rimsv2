<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<div class="mb-3">

			<?php echo anchor('program/tambah', 'Tambah Program', "class = 'btn btn-primary'"); ?>
			<?php echo anchor('program', 'Senarai Program', "class = 'btn btn-info text-white'"); ?>
			<?php echo anchor('program/recap', 'Recap Program', "class = 'btn btn-outline-success'"); ?>
			<?php echo anchor('jenis', 'Jenis Program', "class = 'btn btn-outline-success'"); ?>
		</div>

		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="userguide3/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
