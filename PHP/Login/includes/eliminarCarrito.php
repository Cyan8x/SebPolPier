<?php
    session_start();
    $arreglo = $_SESSION['carrito'];
    for ($i=0; $i < count($arreglo); $i++) {
        if ($arreglo[$i]['Cod_producto'] != $_POST['id']) {
            //SE CREA UN NUEVO ARREGLO CON TODOS LOS PRODUCTOS QUE TENIA EL ARREGLO ANTIGUO, EXCEPTO CON EL PRODUCTO QUE QUEREMOS ELIMINAR
            $arregloNuevo[] = array(
                'Cod_producto' => $arreglo[$i]['Cod_producto'],
                'Cod_orig' => $arreglo[$i]['Cod_orig'],
                'Nombre' => $arreglo[$i]['Nombre'],
                'Imagen' => $arreglo[$i]['Imagen'],
                'Stock' => $arreglo[$i]['Stock'],
                'Precio_dolares' => $arreglo[$i]['Precio_dolares'],
                'Precio_soles' => $arreglo[$i]['Precio_soles'],
                'Cantidad' => $arreglo[$i]['Cantidad']
            );
        }
    }
    if (isset($arregloNuevo)) {
        $_SESSION['carrito'] = $arregloNuevo;
    }else{
        //quiere decir que el unico registro a eliminar es el unico que habia
        unset($_SESSION['carrito']);
    }
    echo 'listo';
?>