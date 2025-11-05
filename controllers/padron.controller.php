<?php

class ControllerPadron
{

    // Listar / Mostrar uno
    static public function ctrMostrarPadron($item, $valor)
    {
        $tabla = "padron";
        return ModelPadron::mdlMostrarPadron($tabla, $item, $valor);
    }

    // Crear
    static public function ctrGuardarPadron()
    {
        if (!isset($_POST["nombre"])) return;

        $valNombre = '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/';
        $valCurp   = '/^[A-Z]{4}\d{6}[HM][A-Z]{5}\d{2}$/'; // patrón general de CURP
        $generos   = ['Masculino', 'Femenino', 'Otro'];      // ajustado a tu ENUM

        $d = [
            "nombre"            => trim($_POST["nombre"]),
            "apellido_paterno"  => trim($_POST["apellido_paterno"]),
            "apellido_materno"  => isset($_POST["apellido_materno"]) ? trim($_POST["apellido_materno"]) : null,
            "genero"            => $_POST["genero"],
            "curp"              => strtoupper(trim($_POST["curp"])),
            "calle"             => isset($_POST["calle"]) ? trim($_POST["calle"]) : null,
            "numero"            => isset($_POST["numero"]) ? trim($_POST["numero"]) : null,
            "colonia"           => isset($_POST["colonia"]) ? trim($_POST["colonia"]) : null,
            "sede"              => isset($_POST["sede"]) ? trim($_POST["sede"]) : null,
        ];

        if (!preg_match($valNombre, $d["nombre"]) || !preg_match($valNombre, $d["apellido_paterno"])) {
            echo '<script>Swal.fire({icon:"error",title:"Nombre o Apellido inválido"}).then(()=>{window.location="padron";});</script>';
            return;
        }
        if (!in_array($d["genero"], $generos, true)) {
            echo '<script>Swal.fire({icon:"error",title:"Género inválido"}).then(()=>{window.location="padron";});</script>';
            return;
        }
        if (!preg_match($valCurp, $d["curp"])) {
            echo '<script>Swal.fire({icon:"error",title:"CURP inválida"}).then(()=>{window.location="padron";});</script>';
            return;
        }

        // (OPT) Evita duplicados
        if (ModelPadron::mdlBuscarPorCurp("padron", $d["curp"])) {
            echo '<script>Swal.fire({icon:"warning",title:"CURP ya registrada"}).then(()=>{window.location="padron";});</script>';
            return;
        }

        $r = ModelPadron::mdlGuardarPadron("padron", $d);
        if ($r == "ok") {
            echo '<script>Swal.fire({icon:"success",title:"¡Registro guardado!"}).then(()=>{window.location="padron";});</script>';
        } else {
            echo '<script>Swal.fire({icon:"error",title:"No se pudo guardar"}).then(()=>{window.location="padron";});</script>';
        }
    }

    // Editar
    static public function ctrEditarPadron()
    {
        if (!isset($_POST["editar_id"])) return;

        $valNombre = '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/';
        $valCurp   = '/^[A-Z]{4}\d{6}[HM][A-Z]{5}\d{2}$/';
        $generos   = ['Masculino', 'Femenino', 'Otro'];

        $d = [
            "id"                => (int)$_POST["editar_id"],
            "nombre"            => trim($_POST["editar_nombre"]),
            "apellido_paterno"  => trim($_POST["editar_apellido_paterno"]),
            "apellido_materno"  => isset($_POST["editar_apellido_materno"]) ? trim($_POST["editar_apellido_materno"]) : null,
            "genero"            => $_POST["editar_genero"],
            "curp"              => strtoupper(trim($_POST["editar_curp"])),
            "calle"             => isset($_POST["editar_calle"]) ? trim($_POST["editar_calle"]) : null,
            "numero"            => isset($_POST["editar_numero"]) ? trim($_POST["editar_numero"]) : null,
            "colonia"           => isset($_POST["editar_colonia"]) ? trim($_POST["editar_colonia"]) : null,
            "sede"              => isset($_POST["editar_sede"]) ? trim($_POST["editar_sede"]) : null,
        ];

        if (!preg_match($valNombre, $d["nombre"]) || !preg_match($valNombre, $d["apellido_paterno"])) {
            echo '<script>Swal.fire({icon:"error",title:"Nombre o Apellido inválido"}).then(()=>{window.location="padron";});</script>';
            return;
        }
        if (!in_array($d["genero"], $generos, true)) {
            echo '<script>Swal.fire({icon:"error",title:"Género inválido"}).then(()=>{window.location="padron";});</script>';
            return;
        }
        if (!preg_match($valCurp, $d["curp"])) {
            echo '<script>Swal.fire({icon:"error",title:"CURP inválida"}).then(()=>{window.location="padron";});</script>';
            return;
        }

        $r = ModelPadron::mdlEditarPadron("padron", $d);
        if ($r == "ok") {
            echo '<script>Swal.fire({icon:"success",title:"¡Registro editado!"}).then(()=>{window.location="padron";});</script>';
        } else {
            echo '<script>Swal.fire({icon:"error",title:"No se pudo editar"}).then(()=>{window.location="padron";});</script>';
        }
    }

    // Eliminar
    static public function ctrEliminarPadron()
    {
        if (!isset($_GET["idPadron"])) return;

        $id = (int)$_GET["idPadron"];
        $r  = ModelPadron::mdlEliminarPadron("padron", $id);

        if ($r == "ok") {
            echo '<script>Swal.fire({icon:"success",title:"¡Registro eliminado!"}).then(()=>{window.location="padron";});</script>';
        } else {
            echo '<script>Swal.fire({icon:"error",title:"No se pudo eliminar"}).then(()=>{window.location="padron";});</script>';
        }
    }
}
