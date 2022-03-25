$(document).ready(function(){
    $.ajax(
        {
            url:'./../PHP/carritoAjax/data.php',
            method:'POST'
        }
    ).done(function(res){
        var datos = JSON.parse(res);
        console.log(datos);
    })
})