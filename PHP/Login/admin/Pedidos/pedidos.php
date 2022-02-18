<?php
session_start();
include("../../includes/connection.php");
if (!isset($_SESSION['session_admin'])) {
    header("Location: ./../../../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedidos</title>

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
                            <h1 class="m-0">Pedidos</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6 text-right">
                            <!-- Button Reporte EXCEL-->
                            <a style="text-decoration: none; color:white;" href="../../../Reporte/R_PedidosExcel.php">
                                <button type="button" class="btn btn-success">
                                    <i class="fas fa-file-excel"></i></i> Reporte de Pedidos
                                </button>
                            </a>
                            <!-- Button Reporte -->
                            <a style="text-decoration: none; color:white;" href="../../../Reporte/R_Pedidos.php" target="_blank">
                                <button type="button" class="btn btn-secondary">
                                    <i class="fas fa-file-pdf"></i> Reporte de Pedidos
                                </button>
                            </a>
                            <!-- Button trigger modal -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> Insertar Pedido
                            </button> -->
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
                    <div id="accordion">
                        <?php
                        $sql1 = 'SELECT ventas.*, detalle2_venta.monto_finalD, detalle2_venta.monto_finalS FROM ventas INNER JOIN detalle2_venta ON ventas.cod_venta = detalle2_venta.cod_venta';
                        foreach ($connection->query($sql1) as $result1) {
                        ?>
                            <div class="card">
                                <div class="card-header" id="heading<?php echo $result1['cod_venta'] ?>">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $result1['cod_venta'] ?>" aria-expanded="true" aria-controls="collapse<?php echo $result1['cod_venta'] ?>">
                                            <?php
                                            echo $result1['cod_venta'] . " - " . $result1['usuario'] . " - " . $result1['fecha_compra'] . " - " . $result1['estado']
                                            ?>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse<?php echo $result1['cod_venta'] ?>" class="collapse show" aria-labelledby="heading<?php echo $result1['cod_venta'] ?>" data-parent="#accordion">
                                    <div class="card-body">
                                        <p style="font-size: 25px;"><u><b>Datos del Cliente</b>  </u></p>
                                        <p>Nombres del Cliente: <?php echo $result1['nombres'] ?></p>
                                        <p>Apellidos del Cliente: <?php echo $result1['apellidos'] ?></p>
                                        <p>DNI del Cliente: <?php echo $result1['dni'] ?></p>
                                        <p>Correo Electrónico del Cliente: <?php echo $result1['email'] ?></p>
                                        <p>Dirección del Cliente: <?php echo $result1['direccion'] ?></p>
                                        <p>Ciudad del Cliente: <?php echo $result1['ciudad'] ?></p>
                                        <p>Numero de contacto del Cliente: <?php echo $result1['telefono'] ?></p>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Cod_Producto</th>
                                                    <th>Imagen</th>
                                                    <th>Nombre</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio_Dolares</th>
                                                    <th>Precio_Soles</th>
                                                    <th>Subtotal_Dolares</th>
                                                    <th>Subtotal_Soles</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql2 = 'SELECT detalle1_venta.*, productos.imagen, productos.nombre FROM detalle1_venta INNER JOIN productos ON productos.cod_producto = detalle1_venta.cod_producto WHERE cod_venta = '.$result1['cod_venta'];
                                                foreach ($connection->query($sql2) as $result2) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $result2['cod_producto']; ?></td>
                                                        <td><img src="../../../../imagenes/<?php echo $result2['imagen']; ?>" alt="<?php echo $result2['nombre']; ?>" width="100px" height="100px"></td>
                                                        <td><?php echo $result2['nombre']; ?></td>
                                                        <td><?php echo $result2['cantidad']; ?></td>
                                                        <td><?php echo "$" . number_format($result2['precio_dolares'], 2, '.', ','); ?></td>
                                                        <td><?php echo "S/" . number_format($result2['precio_soles'], 2, '.', ','); ?></td>
                                                        <td><?php echo "$" . number_format($result2['subtotal_dolares'], 2, '.', ','); ?></td>
                                                        <td><?php echo "S/" . number_format($result2['subtotal_soles'], 2, '.', ','); ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <p>Monto total a pagar por el Cliente: <?php echo "$" . number_format($result1['monto_finalD'], 2, '.', ','). " - S/" . number_format($result1['monto_finalS'], 2, '.', ','); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
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
                                    $sql = 'SELECT * FROM marca';
                                    foreach ($connection->query($sql) as $result) {
                                        echo '<option value="' . $result['cod_marca'] . '">' . $result['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <select name="categoria" id="categoria" class="form-control" required>
                                    <?php
                                    $sql = 'SELECT * FROM categoria';
                                    foreach ($connection->query($sql) as $result) {
                                        echo '<option value="' . $result['cod_categoria'] . '">' . $result['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="proveedor">Proveedor</label>
                                <select name="proveedor" id="proveedor" class="form-control" required>
                                    <?php
                                    $sql = 'SELECT * FROM proveedor';
                                    foreach ($connection->query($sql) as $result) {
                                        echo '<option value="' . $result['cod_prov'] . '">' . $result['nombre'] . '</option>';
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
                                <label for="precio_dolares">Precio_Dolares</label>
                                <input type="number" step="any" name="precio_dolares" placeholder="Precio_Dolares" id="precio_dolares" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="precio_soles">Precio_Soles</label>
                                <input type="number" step="any"" name=" precio_soles" placeholder="Precio_Soles" id="precio_soles" class="form-control" required>
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
                                    $sql = 'SELECT * FROM marca';
                                    foreach ($connection->query($sql) as $result) {
                                        echo '<option value="' . $result['cod_marca'] . '">' . $result['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categoriaEdit">Categoria</label>
                                <select name="categoria" id="categoriaEdit" class="form-control" required>
                                    <?php
                                    $sql = 'SELECT * FROM categoria';
                                    foreach ($connection->query($sql) as $result) {
                                        echo '<option value="' . $result['cod_categoria'] . '">' . $result['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="proveedorEdit">Proveedor</label>
                                <select name="proveedor" id="proveedorEdit" class="form-control" required>
                                    <?php
                                    $sql = 'SELECT * FROM proveedor';
                                    foreach ($connection->query($sql) as $result) {
                                        echo '<option value="' . $result['cod_prov'] . '">' . $result['nombre'] . '</option>';
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
                                <label for="precio_dolaresEdit">Precio_Dolares</label>
                                <input type="number" step="any" name="precio_dolares" placeholder="Precio_Dolares" id="precio_dolaresEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="precio_solesEdit">Precio_Soles</label>
                                <input type="number" step="any" name="precio_soles" placeholder="Precio_Soles" id="precio_solesEdit" class="form-control" required>
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
                $("#precio_dolaresEdit").val($(this).data('preciodolares'));
                $("#precio_solesEdit").val($(this).data('preciosoles'));
            });
        });
    </script>
</body>

</html>