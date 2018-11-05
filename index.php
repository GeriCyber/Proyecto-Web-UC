<?php 
  session_start();
  require_once('inc/funciones_bd.php');
  $db = new funciones_BD(); 
  $usuario = $_SESSION["usuario"];
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Propiedades</title>

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
          <?php if($usuario != 'admin') { ?>
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ingresar.php"> Iniciar Sesión</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="editar_propiedades.php">Modificar Propiedades</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Listado de Cliente</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inc/logout.php">Cerrar Sesión</a>
          </li>
        <?php } ?>
        </ul>
      </div>
    </nav>

    <main role="main">

      <div class="jumbotron">
        <div class="container mb-5">
          <h1 class="text-white title">Propiedades</h1>
          <p class="text-white">Listado de propiedades disponibles.</p>
        </div>
      </div>
      <div class="container-fluid mb-5">  
          <table id="tabla" class="table table-striped table-bordered table-responsive-sm">
            <thead class="bg-property text-white">
              <tr>
                  <th>Título</th>
                  <th>Descripción</th>
                  <th>Ubicación</th>
                  <th width="100">Estado</th>
                  <th width="80">Precio</th>
              </tr>
              </thead>
              <tfoot>
                <tr style="display: flex;justify-content: center;">
                  <th></th>
                  <th></th>
                  <th>Ubicación</th>
                  <th>Estado</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                  <?php $propiedades = $db->listar_propiedades();
                    foreach ($propiedades as $propiedad)
                    { 
                      if ($propiedad['estado'] != 'Vendida' && $propiedad['estado'] != 'Alquilada') { ?>
                    <tr>
                        <td style="vertical-align: middle;"><?=$propiedad['titulo']; ?></td>
                        <td style="vertical-align: middle;"><?=$propiedad['descripcion']; ?></td>
                        <td style="vertical-align: middle;"><?=$propiedad['ubicacion']; ?></td>
                        <td style="vertical-align: middle;"><?=$propiedad['estado']; ?></td>
                        <td style="vertical-align: middle;"><?=$propiedad['precio']; ?></td>
                    </tr>
                <?php } 
                } ?>
          </tbody>
        </table>
      </div>

    </main>

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

        $('#tabla tfoot th').not(":eq(0),:eq(1),:eq(4)").each( function() 
        {
            var title = $('#tabla tfoot th').eq( $(this).index() ).text();
            $(this).html('<div class="mr-3 mb-1"><input type="text" class="form-control input-search" placeholder="Filtrar por '+title+'" /></div>');
        } );

        table.columns().eq(0).each( function (colIdx) 
        {
            if(colIdx == 0 || colIdx == 1 || colIdx == 4) return; 
            $('input', table.column( colIdx ).footer() ).on( 'keyup change', function() 
            {
                table
                    .column(colIdx)
                    .search(this.value)
                    .draw();
            });
        });
        $('#tabla tfoot tr').insertBefore($('#tabla'));
    });

    </script>
  </body>
</html>
