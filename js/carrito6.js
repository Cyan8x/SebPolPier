// $(document).ready(function(){
//     if (x === undefined) {
//         console.log('vacio');
//     }else{
//         var y = JSON.parse(x);
//         console.log(y);
//     }
// })


function inputCant() {
    $('.reducir').on('click', function(e){
        e.preventDefault();
        if ( $(this).parent('div').find('.cant').val() != 1  ) {
            $(this).parent('div').find('.cant').val(parseInt($(this).parent('div').find('.cant').val()) - 1);
        } else{
            $(this).parent('div').find('.cant').val(parseInt(1));
        }
        let precioD = $(this).parent('div').find('input').data('preciod');
        let precioS = $(this).parent('div').find('input').data('precios');
        let id = $(this).parent('div').find('input').data('id');
        let cantidad = $(this).parent('div').find('input').val();
        montoItem(cantidad, precioD, precioS, id);
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
        let precioD = $(this).parent('div').find('input').data('preciod');
        let precioS = $(this).parent('div').find('input').data('precios');
        let id = $(this).parent('div').find('input').data('id');
        let cantidad = $(this).parent('div').find('input').val();
        montoItem(cantidad, precioD, precioS, id);
        montoTotal();
    });
}

function montoItem(cantidad, precioD, precioS, id) {
    let multD = parseFloat(cantidad) * parseFloat(precioD);
    let multS = parseFloat(cantidad) * parseFloat(precioS);
    $(".cod_" + id).text("$" + multD + " - S/" + multS);
    $.ajax({
        method: 'POST',
        url: './../PHP/Login/includes/actualizar.php',
        data: {
            id: id,
            cantidad: cantidad
        }
    });
}

function montoTotal() {
    $.ajax({
        method: 'POST',
        url: './../PHP/Login/includes/MontoFinal.php',
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
            url: './../PHP/Login/includes/eliminarCarrito.php',
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
        url: './../PHP/Login/includes/articulosCar.php',
    }).done(function(res){
        $(".articulosTotal").text(res);
        console.log(res);
    });
}

eliminarItem();