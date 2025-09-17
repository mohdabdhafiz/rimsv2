
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>INTEREST@2022</title>

    

    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.1/examples/sign-in/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">

<?php echo form_open('pengguna/login'); ?>
    <h1 class="h3 mb-3 fw-normal">INTEREST</h1>

    <?php echo validation_errors(); ?>

    <div class="form-floating mb-2">
      <input type="text" class="form-control" id="floatingInput" placeholder="88**********" name="pengguna_ic">
      <label for="floatingInput">Kad Pengenalan</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="012*******" name="no_tel">
      <label for="floatingPassword">Nombor Telefon</label>
    </div>

    
    <button class="w-100 btn btn-lg btn-primary mt-3 mb-3" type="submit">Log Masuk</button>
    
  </form>

  <div class="row g-2">
  <div class="col-auto">
      <div class="p-3 border bg-light rounded">
        <?php echo anchor("data_virtualization/pilih/1", "Data Virtualization - Hari Penamaan Calon", "class='text-decoration-none text-dark'"); ?>
      </div>
  </div>
  <div class="col-auto">
    <div class="p-3 border bg-info rounded">

    <?php echo anchor("data_virtualization/pilih/2", "Data Virtualization - Hari Pembuangan UNDI", "class='text-decoration-none text-white'"); ?>
    </div>
  </div>
</div>

</main>


    
  </body>
</html>
