
//EDITAR USUARIO
$(".tablas").on("click", ".btnEditarUsuario", function () {
  var idUsuario = $(this).attr("idUsuario");

  var datos = new FormData();
  datos.append("idUsuario", idUsuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#id").val(respuesta["id"]);
      $("#editar_nombre").val(respuesta["nombre"]);
      $("#editar_usuario").val(respuesta["usuario"]);
      $("#editar_perfil").html(respuesta["perfil"]);
      $("#editar_perfil").val(respuesta["perfil"]);
    },
  });
});

//ELIMINAR USUARIO

$(".tablas").on("click", ".btnEliminarUsuario", function () {

  var idUsuario = $(this).attr("idUsuario");

  Swal.fire({
    icon: "info",
    title: "¿Está seguro de borrar el usuario?",
    text: "¡Si no lo está puede cancelar la accion!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "¡Si, borrar usuario!",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      window.location = "index.php?url=usuarios&idUsuario=" + idUsuario;
    }
  });
});



var togglePassword = document.getElementById('togglePassword');
if (togglePassword) {
  togglePassword.addEventListener('click', function () {
    var passwordField = document.getElementById('password');
    var passwordFieldType = passwordField.getAttribute('type');
    if (passwordFieldType == 'password') {
        passwordField.setAttribute('type', 'text');
        this.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
        passwordField.setAttribute('type', 'password');
        this.innerHTML = '<i class="fas fa-eye"></i>';
    }
  });
}