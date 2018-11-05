<?php 
  session_start();
  require_once('inc/funciones_bd.php');
  $db = new funciones_BD(); 
  if($_SESSION["usuario"] != 'admin')
    header("Location: index.php");
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Gestionar Propiedades</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/init.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-property">
      <a class="navbar-brand" href="#">GHG</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="editar_propiedades.php">Modificar Propiedades</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Listado de Cliente</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inc/logout.php">Cerrar Sesión</a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main">

      <div class="jumbotron head">
        <div class="container">
          <h1 class="text-white title">Gestión de Propiedades</h1>
          <p class="text-white">Aquí podrás añadir, modificar y eliminar propiedades.</p>
          <p><a class="btn btn-success btn-lg" href="propiedades.php" role="button">Listar Propiedades &raquo;</a></p>
          <?php 
          if(isset($_GET['error'])) {  ?>
          <div class="alert with-close alert-danger alert-dismissible fade show mt-4 text-left">
              <span class="badge badge-pill badge-danger text-left">Error</span>
                  <?php echo $_GET['error']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <?php } if(isset($_GET['exito'])) { ?>
            <div class="alert with-close alert-success alert-dismissible fade show mt-4 text-left">
              <span class="badge badge-pill badge-success text-left">Exito</span>
                  <?php echo $_GET['exito']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php } ?>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2>Añadir Propiedad</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#añadir">
            Añadir &raquo;</button></p>
          </div>
          <div class="col-md-4">
            <h2>Modificar Propiedad</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. </p>
            <p><a class="btn btn-success" href="editar_propiedades.php" role="button">Modificar &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2>Eliminar Propiedad</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus.</p>
            <p><a class="btn btn-success" href="editar_propiedades.php" role="button">Eliminar &raquo;</a></p>
          </div>
        </div>

        <hr>

      </div> <!-- /container -->

    </main>

  <!-- Modal -->
  <div class="modal fade" id="añadir" tabindex="-1" role="dialog" aria-labelledby="añadir" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-info" id="exampleModalCenterTitle">Añadir Propiedad</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="inc/agregar_propiedad.php" method="post">
            <div class="form-group">
              <label for="titulo">Título</label>
              <input type="text" class="form-control" name="titulo" placeholder="Ej: Milestone House XV" maxlength="50" required>
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción</label>          
                <textarea class="form-control" name="descripcion" rows="3" placeholder="Ej: 2 pisos, 4 baños..." required></textarea>
            </div>
            <div class="form-group">
              <label for="ubicacion">Ubicación</label>
                <input type="text" class="form-control" name="ubicacion" placeholder="Naguanagua, Urb. La Campiña..." maxlength="150" required>
            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
                <input type="number" class="form-control" name="precio" maxlength="50" required>
            </div>
            <div class="form-group">
              <label for="estado">Estado</label>
                <select class="custom-select mr-sm-2" name="estado">
                  <option value="Vendida">Vendida</option>
                  <option value="En Alquiler">En Alquiler</option>
                  <option value="Alquilada">Alquilada</option>
                  <option selected value="En Venta">En Venta</option>
                </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="submit" class="btn btn-info">Añadir</button>
          </div>
        </form>
      </div>
    </div>
  </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $('#añadir').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })
    </script>
  </body>
</html>
