/*Dropdown Menu*/
$('.dropdown').click(function () {
  $(this).attr('tabindex', 1).focus();
  $(this).toggleClass('active');
  $(this).find('.dropdown-menu').slideToggle(300);
});
$('.dropdown').focusout(function () {
  $(this).removeClass('active');
  $(this).find('.dropdown-menu').slideUp(300);
});
$('.dropdown .dropdown-menu li').click(function () {
  $(this).parents('.dropdown').find('span').text($(this).text());
  $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
});
/*End Dropdown Menu*/


$('.dropdown-menu li').click(function () {
var input = '<strong>' + $(this).parents('.dropdown').find('input').val() + '</strong>',
msg = '<span class="msg">Hidden input value: ';
$('.msg').html(msg + input + '</span>');
}); 


let editarPerfil = () => {
  let botones = document.getElementsByClassName("edit-image");
  for (let boton of botones) {
    boton.style.display = "block";
  }
  let perfiles = document.getElementsByClassName("profile");
  for (let perfil of perfiles) {
    perfil.href = "./editProfile.html"
    perfil.style.animation = "tilt-shaking 0.5s infinite";
  }
  let agregar = document.getElementById("add-profile");
  agregar.style.display = "none";
  document.getElementById("create-text").innerHTML = "¿Qué perfil deseas modificar?";
  document.getElementById("editarPerfil").innerHTML = "Cancelar";
  document.getElementById("editarPerfil").style.backgroundColor = "#ee2222";
  document.getElementById("editarPerfil").onclick = () => {
    let botones = document.getElementsByClassName("edit-image");
    for (let boton of botones) {
      boton.style.display = "none";
    }
    let perfiles = document.getElementsByClassName("profile");
    for (let perfil of perfiles) {
      perfil.href = "./mainPage.html"
      perfil.style.animation = "none";
    }
    let agregar = document.getElementById("add-profile");
    agregar.style.display = "block";
    document.getElementById("editarPerfil").innerHTML = "Editar perfiles";
    document.getElementById("create-text").innerHTML = "¿Quién eres?";
    document.getElementById("editarPerfil").style.backgroundColor = "#ee5622";
    document.getElementById("editarPerfil").onclick = editarPerfil;
  }
}

document.getElementById('perfil-main').onmouseover = () => {
  document.getElementById('controles-main').style.display = "inherit";
}
document.getElementById('controles-main').onmouseleave = () => {
  document.getElementById('controles-main').style.display = "none";
}

document.getElementById("search-main").onfocus = () => {
  document.getElementById("buscador-div").style.filter = "drop-shadow(0 0.4rem 0.25rem #ee6c4d)"
  console.log('hola')
}
document.getElementById("search-main").onblur = () => {
  document.getElementById("buscador-div").style.filter = "drop-shadow(0 0 0 white)"
  console.log('hola')
}

//AGREGAR CUENTA Y USUARIO
$('#addAccount').click(function () {
  $.post('../backend/API/account.php', {
    name: $('#name').val(),
    lastname: $('#lastname').val(),
    email: $('#email').val(),
    account: $('#account').val(),
    country: $('#country').val(),
    card: $('#card').val(),
    suscription: $('#suscription').val(),
    user: $('#user').val(),
    password: $('#password').val()
  }, function (response) {
      let respuesta = JSON.parse(response);
      console.log(respuesta);
  });
});