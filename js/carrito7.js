function inputCant() {
    $('.reducir').on('click', function(e){
        e.preventDefault();
        if ( $(this).parent('div').find('.cant').val() != 1  ) {
            $(this).parent('div').find('.cant').val(parseInt($(this).parent('div').find('.cant').val()) - 1);
        } else{
            $(this).parent('div').find('.cant').val(parseInt(1));
        }
        let precio = $(this).parent('div').find('input').data('precio');
        let id = $(this).parent('div').find('input').data('id');
        let cantidad = $(this).parent('div').find('input').val();
        montoItem(cantidad, precio, id);
        montoTotal();
    });
    $('.incrementar').on('click',function (e) {
        e.preventDefault();
        let stock = $(this).parent('div').find('.cant').data('stock');
        if ($(this).parent('div').find('.cant').val() != stock) {
            $(this).parent('div').find('.cant').val(parseInt($(this).parent('div').find('.cant').val()) + 1);
        }else{
            $(this).parent('div').find('.cant').val(parseInt(stock));
        }
        let precio = $(this).parent('div').find('input').data('precio');
        let id = $(this).parent('div').find('input').data('id');
        let cantidad = $(this).parent('div').find('input').val();
        montoItem(cantidad, precio, id);
        montoTotal();
    });
}

function montoItem(cantidad, precio, id) {
    let mult = parseFloat(cantidad) * parseFloat(precio);
    $(".cod_" + id).text("$" + mult);
    $.ajax({
        method: 'POST',
        url: './../PHP/includes_carrito/actualizar.php',
        data: {
            id: id,
            cantidad: cantidad
        }
    });
}

function montoTotal() {
    $.ajax({
        method: 'POST',
        url: './../PHP/includes_carrito/MontoFinal.php',
    }).done(function(res){
        $(".Fin").text(res);
    });
}

inputCant();

function eliminarItem() {
    $('.btnEliminar').on('click',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var boton = $(this);
        $.ajax({
            method: 'POST',
            url: './../PHP/includes_carrito/eliminarCarrito.php',
            data: {
                id: id
            }
        }).done(
            function(respuesta) {
                boton.parent('div').parent('li').remove();
            }
        );

        totalArticulos();
        montoTotal();
    })
}

function totalArticulos() {
    $.ajax({
        method: 'POST',
        url: './../PHP/includes_carrito/articulosCar.php',
    }).done(function(res){
        $(".articulosTotal").text(res);
        console.log(res);
    });
}

eliminarItem();