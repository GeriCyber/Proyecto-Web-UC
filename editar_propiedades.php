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

    <title>Modifica Propiedades</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/init.css">
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
  </head>

  <body>
    <div id="overlay">
        <div class="spinner"></div> 
    </div>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-property">
      <a class="navbar-brand" href="#">GHG</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
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

      <div class="jumbotron">
        <div class="container mb-5">
          <h1 class="text-white title">Listado de Propiedades</h1>
          <p class= "text-white">Aquí podrás agregar, modificar y eliminar propiedades.</p>
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
      <div class="container-fluid text-center mb-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#añadir">Agregar Propiedad</button>
      </div> 
      <div class="container-fluid mb-5"> 
          <table id="tabla" class="table table-striped table-bordered table-responsive" style="width:100%">
            <thead class="bg-property text-white">
              <tr>
                  <th class="d-none"></th>
                  <th>Título</th>
                  <th>Descripción</th>
                  <th>Ubicación</th>
                  <th width="100">Estado</th>
                  <th width="80">Precio</th>
                  <th class="text-center">Editar</th>
                  <th class="text-center">Eliminar</th>
              </tr>
              </thead>
              <tbody>
                  <?php $propiedades = $db->listar_propiedades();
                    foreach ($propiedades as $propiedad)
                    { ?>
                    <tr>
                        <td class="d-none"><?=$propiedad['id']; ?></td>
                        <td style="vertical-align: middle;"><?=$propiedad['titulo']; ?></td>
                        <td style="vertical-align: middle;"><?=$propiedad['descripcion']; ?></td>
                        <td style="vertical-align: middle;"><?=$propiedad['ubicacion']; ?></td>
                        <td style="vertical-align: middle;"><?=$propiedad['estado']; ?></td>
                        <td style="vertical-align: middle;"><?=$propiedad['precio']; ?></td>
                        <td style="vertical-align: middle;" class="text-center"><button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-editar">Editar</button></td>
                        <td style="vertical-align: middle;" class="text-center"><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalEliminar">Eliminar</button></td>
                    </tr>
                <?php } ?>
              </tbody>
          </table>
      </div>
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
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="submit" class="btn btn-info">Añadir</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    
  <!-- Modal -->
  <div class="modal fade" id="modal-editar" tabindex="-1" role="dialog" aria-labelledby="modal-editar" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-info" id="exampleModalCenterTitle">Editar Propiedad</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="inc/editar_propiedad.php" method="post">
            <input type="hidden" name="propiedad" class="oculto_id_propiedad">
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
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="submit" class="btn btn-info">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--modal eliminar-->
  <div class="modal fade" id="ModalEliminar">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title text-danger mt-2">Eliminar Propiedad</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      <i class="fa fa-times-circle"></i>
                  </button>
              </div>
              <div class="modal-body text-center">
                  <form method="post" action="inc/eliminar_propiedad.php">
                      <input type="hidden" name="propiedad" class="oculto_id_propiedad">
                      <div class="alert alert-danger py-3">¿Seguro que quieres eliminar la propiedad seleccionada?</div>
                      <button type="submit" class="btn btn-danger" id="eliminar_propiedad">Eliminar</button>
                  </form>
              </div>
              <div class="modal-footer">
                  <a href="#" data-dismiss="modal" class="btn btn-secondary">Cancelar</a>
              </div>
          </div>
      </div>
  </div>
  <!--fin modal eliminar-->

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/main.js"></script>
    <script>
      $(document).ready(function() 
      {
          var table = $('#tabla').DataTable({
          order: [[3, 'asc']],
          lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "Todo"]],
          language:
          {
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": 
              {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": 
              {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
          }
        });

        $('#tabla tbody').on( 'click', 'tr', function() 
        {
            var fila_seleccionada = table.row(this).data();
            var id_propiedad = fila_seleccionada[0];
            console.log(id_propiedad);
            $('.oculto_id_propiedad').attr('value', id_propiedad);
        } );
    });
    </script>
  </body>
</html>
