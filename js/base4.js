const $navProducts = document.querySelector(".products");
const $subnav = document.querySelector(".subnav");
const $arrowDown = document.getElementsByClassName("down");
const $arrowUp = document.getElementsByClassName("up");

$navProducts.addEventListener('click', ()=>{
    $subnav.classList.toggle('showSubnavJs');
    $arrowDown[1].classList.toggle('downJs');
    $arrowUp[1].classList.toggle('upJs');
})

const $ham = document.querySelector(".ham");
const $nav1 = document.querySelector(".nav1");
const $nav2 = document.querySelector(".nav2");


const $user = document.querySelector(".user h3");
const $userSubnav = document.querySelector(".user h3 ul");

$user.addEventListener('click', ()=>{
    $userSubnav.classList.toggle('showUserSubnavJs');
    $arrowDown[0].classList.toggle('downJs');
    $arrowUp[0].classList.toggle('upJs');
})



$ham.addEventListener('click', ()=>{
    $nav1.classList.toggle('showNav1Js');
    $nav2.classList.toggle('showNav2Js');
    $subnav.classList.remove('showSubnavJs');
    $userSubnav.classList.remove('showUserSubnavJs');
    $nav2.classList.remove('showNav2Js2');

    let hasShowNav1Js = $nav1.classList.contains('showNav1Js');
    let hasShowNav2Js = $nav2.classList.contains('showNav2Js');

    if (!hasShowNav1Js && !hasShowNav2Js) {
        for (let i = 0; i < $arrowDown.length; i++) {
            for (let j = 0; j < $arrowUp.length; j++) {
                $arrowDown[i].classList.remove('downJs');
                $arrowUp[j].classList.remove('upJs');
            }
        }
    }

    $user.addEventListener('click', ()=>{
        let hasshowUserSubnavJs = $userSubnav.classList.contains('showUserSubnavJs');
        if (hasshowUserSubnavJs) {
            $nav2.classList.add('showNav2Js2');
        }else{
            $nav2.classList.remove('showNav2Js2');
        }
        console.log("hola1");
    })
    console.log("hola2");
})

function totalArticulos() {
    $.ajax({
        method: 'POST',
        url: './../PHP/Login/includes/articulosCar.php',
    }).done(function(res){
        $(".articulosTotal").text(res);
        console.log(res);
    });
}





