const $linkProductos = document.querySelector('.productos');
const $lista = document.querySelector('.lista');
const $productosArrowDown = document.querySelector('.arrow-down');
const $productosArrowUp = document.querySelector('.arrow-up');

$linkProductos.addEventListener('click',function () {
    $lista.classList.toggle('lista-show');
    $productosArrowDown.classList.toggle('hide-down');
    $productosArrowUp.classList.toggle('show-up');
})