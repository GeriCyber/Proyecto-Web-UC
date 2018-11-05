<?php 
  session_start();
  $usuario = isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : "";
  switch ($usuario) 
  {
      case "admin":
          header("Location: dashboard.php");
          break;
  }
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Iniciar Sesión</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">

  </head>

  <body class="text-center">
    <form class="form-signin" action="inc/login.php" method="post">
      <img class="mb-4" src="img/5af9b03d8222820180514035021.png" alt="" width="150">
      <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
      <input type="text" name="usuario" class="form-control mb-2" placeholder="Usuario" required autofocus>
      <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
      <div class="checkbox mb-3 text-left">
        <label>
          <input type="checkbox" value="remember-me"> Recuerdame
        </label>
      </div>
      <button class="btn btn-lg btn-info btn-block" name="submit" type="submit">Iniciar Sesión</button>
      <?php 
        if(isset($_GET['error']))
        { 
      ?>
        <div class="alert with-close alert-danger alert-dismissible fade show mt-4 text-left">
            <span class="badge badge-pill badge-danger text-left">Error</span>
                <?php echo $_GET['error']; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php } ?>
    </form>
    
  </body>
</html>
