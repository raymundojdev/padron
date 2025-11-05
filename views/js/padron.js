// Editar: carga por AJAX y abre el modal después de poblar inputs (evita aria-hidden focus issue)
$(document).on("click", ".btnEditarPadron", function () {
  var id = $(this).attr("idPadron");
  if (!id) return;

  var datos = new FormData();
  datos.append("idPadron", id);

  $.ajax({
    url: "ajax/padron.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (r) {
      if (!r || !r.id) {
        Swal.fire({ icon: "error", title: "No se encontró el registro" });
        return;
      }
      $("#editar_id").val(r.id);
      $("#editar_nombre").val(r.nombre);
      $("#editar_apellido_paterno").val(r.apellido_paterno);
      $("#editar_apellido_materno").val(r.apellido_materno);
      $("#editar_genero").val(r.genero);
      $("#editar_curp").val(r.curp);
      $("#editar_calle").val(r.calle);
      $("#editar_numero").val(r.numero);
      $("#editar_colonia").val(r.colonia);
      $("#editar_sede").val(r.sede);

      var el = document.getElementById("modalEditarPadron");
      var modal = bootstrap.Modal.getOrCreateInstance(el);
      modal.show();
    },
    error: function (xhr) {
      console.error(xhr.responseText);
    },
  });
});

// Eliminar
$(document).on("click", ".btnEliminarPadron", function () {
  var id = $(this).attr("idPadron");
  if (!id) return;

  Swal.fire({
    icon: "warning",
    title: "¿Eliminar registro?",
    text: "Esta acción no se puede deshacer",
    showCancelButton: true,
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((res) => {
    if (res.isConfirmed) {
      window.location =
        "index.php?url=padron&idPadron=" + encodeURIComponent(id);
    }
  });
});

// Validar CURP duplicado en alta
$("#curp_alta").on("change", function () {
  var curp = $(this).val();
  var datos = new FormData();
  datos.append("validarCURP", curp);

  $.ajax({
    url: "ajax/padron.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (r) {
      if (r) {
        // ya existe
        Swal.fire({ icon: "warning", title: "CURP ya registrada" });
        $("#curp_alta").val("").focus();
      }
    },
  });
});

// (OPT) Inicialización específica de DataTables para esta tabla (evita conflictos globales)
$(function () {
  if ($("tablaPadron").length) {
    $("#tablaPadron").DataTable({
      autoWidth: false,
      responsive: true,
      pageLength: 10,
      columnDefs: [
        { targets: -1, orderable: false, searchable: false }, // Acciones
      ],
    });
  }
});
