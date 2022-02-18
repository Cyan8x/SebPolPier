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
    <title>Usuarios</title>

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
                            <h1 class="m-0">Usuarios</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6 text-right">
                            <!-- Button Reporte EXCEL-->
                            <a style="text-decoration: none; color:white;" href="../../../Reporte/R_UsuariosExcel.php">
                                <button type="button" class="btn btn-success">
                                    <i class="fas fa-file-excel"></i></i> Reporte de Usuarios
                                </button>
                            </a>
                            <!-- Button Reporte -->
                            <a style="text-decoration: none; color:white;" href="../../../Reporte/R_Usuarios.php" target="_blank">
                                <button type="button" class="btn btn-secondary">
                                    <i class="fas fa-file-pdf"></i> Reporte de Usuarios
                                </button>
                            </a>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus"></i> Insertar Usuario
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
                                <th>Id_Usuario</th>
                                <th>Usuario</th>
                                <th>Correo Eletronico</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Contraseña</th>
                                <th>DNI</th>
                                <th>Direccion</th>
                                <th>Ciudad</th>
                                <th>Telefono</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = 'SELECT * FROM usuarios';
                            foreach ($connection->query($sql) as $result) {
                            ?>
                                <tr>
                                    <td><?php echo $result['id_usuario']; ?></td>
                                    <td><?php echo $result['usuario']; ?></td>
                                    <td><?php echo $result['email']; ?></td>
                                    <td><?php echo $result['nombres']; ?></td>
                                    <td><?php echo $result['apellidos']; ?></td>
                                    <td><?php echo $result['contraseña']; ?></td>
                                    <td><?php echo $result['dni']; ?></td>
                                    <td><?php echo $result['direccion']; ?></td>
                                    <td><?php echo $result['ciudad']; ?></td>
                                    <td><?php echo $result['telefono']; ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-small btnEditar" data-id="<?php echo $result['id_usuario'] ?>" data-usuario="<?php echo $result['usuario'] ?>" data-email="<?php echo $result['email'] ?>" data-nombres="<?php echo $result['nombres'] ?>" data-apellidos="<?php echo $result['apellidos'] ?>" data-contraseña="<?php echo $result['contraseña'] ?>" data-dni="<?php echo $result['dni'] ?>" data-direccion="<?php echo $result['direccion'] ?>" data-ciudad="<?php echo $result['ciudad'] ?>" data-telefono="<?php echo $result['telefono'] ?>" data-toggle="modal" data-target="#modalEditar">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-small btnEliminar" data-id="<?php echo $result['id_usuario'] ?>" data-toggle="modal" data-target="#modalEliminar">
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
                    <form action="insertarUsuario.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Insertar Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" name="usuario" placeholder="Usuario" id="usuario" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electronico</label>
                                <input type="email" name="email" placeholder="Correo Electronico" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" name="nombres" placeholder="Nombres" id="nombres" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" name="apellidos" placeholder="Apellidos" id="apellidos" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contraseña">Contraseña</label>
                                <input type="password" name="contraseña" placeholder="Contraseña" id="contraseña" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contraseña2">Confirmar Contraseña</label>
                                <input type="password" name="contraseña2" placeholder="Confirmar Contraseña" id="contraseña2" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="number" name="dni" placeholder="DNI" id="dni" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="text" name="direccion" placeholder="Direccion" id="direccion" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="ciudad">Ciudad</label>
                                <input type="text" name="ciudad" placeholder="Ciudad" id="ciudad" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="number" name=" telefono" placeholder="Telefono" id="telefono" class="form-control" required>
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
                        <h5 class="modal-title" id="modalEliminarLabel">Eliminar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de eliminar este usuario?
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
                    <form action="editarUsuario.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditar">Editar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_usuario" placeholder="Id_Usuario" id="id_usuarioEdit" class="form-control" required>
                            <div class="form-group">
                                <label for="usuarioEdit">Usuario</label>
                                <input type="text" name="usuario" placeholder="Usuario" id="usuarioEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="emailEdit">Correo Electronico</label>
                                <input type="email" name="email" placeholder="Correo Electronico" id="emailEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nombresEdit">Nombres</label>
                                <input type="text" name="nombres" placeholder="Nombres" id="nombresEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="apellidosEdit">Apellidos</label>
                                <input type="text" name="apellidos" placeholder="Apellidos" id="apellidosEdit" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="contraseñaEdit">Contraseña</label>
                                <input type="password" name="contraseña" placeholder="Contraseña" id="contraseñaEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="dniEdit">DNI</label>
                                <input type="number" name="dni" placeholder="DNI" id="dniEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="direccionEdit">Direccion</label>
                                <input type="text" name="direccion" placeholder="Direccion" id="direccionEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="ciudadEdit">Ciudad</label>
                                <input type="text" name="ciudad" placeholder="Ciudad" id="ciudadEdit" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="telefonoEdit">Telefono</label>
                                <input type="number" name="telefono" placeholder="Telefono" id="telefonoEdit" class="form-control" required>
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
                    url: 'eliminarUsuario.php',
                    method: 'POST',
                    data: {
                        id: idEliminar
                    }
                }).done(function(res) {
                    $(fila).fadeOut(1000);
                });
            });
            $(".btnEditar").click(function() {
                $("#id_usuarioEdit").val($(this).data('id'));
                $("#usuarioEdit").val($(this).data('usuario'));
                $("#emailEdit").val($(this).data('email'));
                $("#nombresEdit").val($(this).data('nombres'));
                $("#apellidosEdit").val($(this).data('apellidos'));
                $("#contraseñaEdit").val($(this).data('contraseña'));
                $("#dniEdit").val($(this).data('dni'));
                $("#direccionEdit").val($(this).data('direccion'));
                $("#ciudadEdit").val($(this).data('ciudad'));
                $("#telefonoEdit").val($(this).data('telefono'));
            });
        });
    </script>
</body>

</html>