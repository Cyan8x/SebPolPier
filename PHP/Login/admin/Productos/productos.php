<?php
session_start();
include("../../includes_login/connection.php");
if (!isset($_SESSION['session_admin'])) {
  header("Location: ./../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Productos</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./../dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="./../dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./../dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="./../dashboard/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./../dashboard/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="./../dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="./../dashboard/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="./../dashboard/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php
    include("./../layouts/header.php")
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Productos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 text-right">
              <!-- Button Reporte EXCEL-->
              <a style="text-decoration: none; color:white;" href="../../../Reporte/R_ProductosExcel.php">
                <button type="button" class="btn btn-success">
                  <i class="fas fa-file-excel"></i></i> Reporte de Productos
                </button>
              </a>
              <!-- Button Reporte PDF-->
              <a style="text-decoration: none; color:white;" href="../../../Reporte/R_Productos.php" target="_blank">
                <button type="button" class="btn btn-secondary">
                  <i class="fas fa-file-pdf"></i> Reporte de Productos
                </button>
              </a>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> Insertar Producto
              </button>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <?php
          if (isset($_GET['error'])) {
          ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $_GET['error']; ?>
            </div>
          <?php
          }
          ?>
          <?php
          if (isset($_GET['success'])) {
          ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_GET['success']; ?>
            </div>
          <?php
          }
          ?>
          <table class="table">
            <thead>
              <tr>
                <th>Cod_Producto</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Proveedor</th>
                <th>Cod_Orginal_Producto</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = 'SELECT productos.*, marcas.marca AS marc, categorias.categoria AS categ, proveedores.proveedor AS prov FROM productos INNER JOIN marcas ON productos.cod_marca = marcas.cod_marca INNER JOIN categorias ON productos.cod_categoria = categorias.cod_categoria INNER JOIN proveedores ON productos.cod_prov = proveedores.cod_prov';
              foreach ($connection->query($sql) as $result) {
              ?>
                <tr>
                  <td><?php echo $result['cod_producto']; ?></td>
                  <td><?php echo $result['marc']; ?></td>
                  <td><?php echo $result['categ']; ?></td>
                  <td><?php echo $result['prov']; ?></td>
                  <td><?php echo $result['cod_orig_prod']; ?></td>
                  <td><img src="../../../../imagenes/<?php echo $result['imagen']; ?>" alt="<?php echo $result['nombre']; ?>" width="100px" height="100px"></td>
                  <td><?php echo $result['nombre']; ?></td>
                  <td><?php echo $result['stock']; ?></td>
                  <td><?php echo "$" . number_format($result['precio'], 2, '.', ','); ?></td>
                  <td>
                    <button class="btn btn-primary btn-small btnEditar" data-id="<?php echo $result['cod_producto'] ?>" data-marca="<?php echo $result['cod_marca'] ?>" data-categoria="<?php echo $result['cod_categoria'] ?>" data-proveedor="<?php echo $result['cod_prov'] ?>" data-codorigprod="<?php echo $result['cod_orig_prod'] ?>" data-nombre="<?php echo $result['nombre'] ?>" data-stock="<?php echo $result['stock'] ?>" data-precio="<?php echo $result['precio'] ?>" data-toggle="modal" data-target="#modalEditar">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-small btnEliminar" data-id="<?php echo $result['cod_producto'] ?>" data-toggle="modal" data-target="#modalEliminar">
                      <i class="fa fa-trash"></i>
                    </button>
                  </td>
                  <td></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="insertarProducto.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Insertar Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="cod_producto">Cod_Producto</label>
                <input type="text" name="cod_producto" placeholder="Cod_Producto" id="cod_producto" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="marca">Marca</label>
                <select name="marca" id="marca" class="form-control" required>
                  <?php
                  $sql = 'SELECT * FROM marcas';
                  foreach ($connection->query($sql) as $result) {
                    echo '<option value="' . $result['cod_marca'] . '">' . $result['marca'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria" class="form-control" required>
                  <?php
                  $sql = 'SELECT * FROM categorias';
                  foreach ($connection->query($sql) as $result) {
                    echo '<option value="' . $result['cod_categoria'] . '">' . $result['categoria'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="proveedor">Proveedor</label>
                <select name="proveedor" id="proveedor" class="form-control" required>
                  <?php
                  $sql = 'SELECT * FROM proveedores';
                  foreach ($connection->query($sql) as $result) {
                    echo '<option value="' . $result['cod_prov'] . '">' . $result['proveedor'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="cod_orig_prod">Cod_Original_Producto</label>
                <input type="text" name="cod_orig_prod" placeholder="Cod_Original_Producto" id="cod_orig_prod" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" placeholder="Stock" id="stock" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" step="any" name="precio" placeholder="Precio" id="precio" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="ModalEliminarLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEliminarLabel">Eliminar Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ¿Estás seguro de eliminar este producto?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" name="guardar" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="editarProducto.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditar">Editar Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="cod_producto" placeholder="Cod_Producto" id="cod_productoEdit" class="form-control" required>
              <div class="form-group">
                <label for="marcaEdit">Marca</label>
                <select name="marca" id="marcaEdit" class="form-control" required>
                  <?php
                  $sql = 'SELECT * FROM marcas';
                  foreach ($connection->query($sql) as $result) {
                    echo '<option value="' . $result['cod_marca'] . '">' . $result['marca'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="categoriaEdit">Categoria</label>
                <select name="categoria" id="categoriaEdit" class="form-control" required>
                  <?php
                  $sql = 'SELECT * FROM categorias';
                  foreach ($connection->query($sql) as $result) {
                    echo '<option value="' . $result['cod_categoria'] . '">' . $result['categoria'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="proveedorEdit">Proveedor</label>
                <select name="proveedor" id="proveedorEdit" class="form-control" required>
                  <?php
                  $sql = 'SELECT * FROM proveedores';
                  foreach ($connection->query($sql) as $result) {
                    echo '<option value="' . $result['cod_prov'] . '">' . $result['proveedor'] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <input type="hidden" name="cod_orig_prod" placeholder="Cod_Original_Producto" id="cod_orig_prodEdit" class="form-control" required>
              <div class="form-group">
                <label for="imagen">Imagen(SI NO DESEA EDITAR LA IMAGEN, LO DEJA VACIO)</label>
                <input type="file" name="imagen" id="imagen" class="form-control">
              </div>
              <div class="form-group">
                <label for="nombreEdit">Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre" id="nombreEdit" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="stockEdit">Stock</label>
                <input type="number" name="stock" placeholder="Stock" id="stockEdit" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="precioEdit">Precio</label>
                <input type="number" step="any" name="precio" placeholder="Precio" id="precioEdit" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" name="editar" class="btn btn-primary editar">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
    include("./../layouts/footer.php")
    ?>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="./../dashboard/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="./../dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 4 -->
  <script src="./../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="./../dashboard/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="./../dashboard/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="./../dashboard/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="./../dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="./../dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="./../dashboard/plugins/moment/moment.min.js"></script>
  <script src="./../dashboard/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="./../dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="./../dashboard/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="./../dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./../dashboard/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./../dashboard/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="./../dashboard/dist/js/pages/dashboard.js"></script>
  <script>
    $(document).ready(function() {
      var idEliminar = -1;
      var idEditar = -1;
      var fila;
      $(".btnEliminar").click(function() {
        idEliminar = $(this).data('id');
        fila = $(this).parent('td').parent('tr');
      });
      $(".eliminar").click(function() {
        $.ajax({
          url: 'eliminarProducto.php',
          method: 'POST',
          data: {
            id: idEliminar
          }
        }).done(function(res) {
          $(fila).fadeOut(1000);
        });
      });
      $(".btnEditar").click(function() {
        $("#cod_productoEdit").val($(this).data('id'));
        $("#marcaEdit").val($(this).data('marca'));
        $("#categoriaEdit").val($(this).data('categoria'));
        $("#marcaEdit").val($(this).data('marca'));
        $("#proveedorEdit").val($(this).data('proveedor'));
        $("#cod_orig_prodEdit").val($(this).data('codorigprod'));
        $("#nombreEdit").val($(this).data('nombre'));
        $("#stockEdit").val($(this).data('stock'));
        $("#precioEdit").val($(this).data('precio'));
      });
    });
  </script>
</body>

</html>