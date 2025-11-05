<?php
require_once "conexion.php";

class ModelPadron
{

    // Mostrar todos o uno
    static public function mdlMostrarPadron($tabla, $item, $valor)
    {
        $pdo = conexiondb::conectar();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // (OPT) fetch por defecto

        if ($item != null) {
            // (OPT) Whitelist de columnas permitidas para filtrar
            $permitidas = ["id", "curp"];
            if (!in_array($item, $permitidas, true)) return [];

            $st = $pdo->prepare("SELECT * FROM $tabla WHERE $item = :val LIMIT 1");
            $st->bindParam(":val", $valor, PDO::PARAM_STR);
            $st->execute();
            return $st->fetch() ?: [];
        }

        $st = $pdo->prepare("SELECT * FROM $tabla ORDER BY creado_en DESC, id DESC");
        $st->execute();
        return $st->fetchAll() ?: [];
    }

    // Crear
    static public function mdlGuardarPadron($tabla, $d)
    {
        $sql = "INSERT INTO $tabla
      (nombre, apellido_paterno, apellido_materno, genero, curp, calle, numero, colonia, sede)
      VALUES (:nombre, :ap_pat, :ap_mat, :genero, :curp, :calle, :numero, :colonia, :sede)";
        $st = conexiondb::conectar()->prepare($sql);

        $st->bindParam(":nombre",  $d["nombre"], PDO::PARAM_STR);
        $st->bindParam(":ap_pat",  $d["apellido_paterno"], PDO::PARAM_STR);
        $st->bindParam(":ap_mat",  $d["apellido_materno"], PDO::PARAM_STR);
        $st->bindParam(":genero",  $d["genero"], PDO::PARAM_STR);
        $st->bindParam(":curp",    $d["curp"], PDO::PARAM_STR);
        $st->bindParam(":calle",   $d["calle"], PDO::PARAM_STR);
        $st->bindParam(":numero",  $d["numero"], PDO::PARAM_STR);
        $st->bindParam(":colonia", $d["colonia"], PDO::PARAM_STR);
        $st->bindParam(":sede",    $d["sede"], PDO::PARAM_STR);

        return $st->execute() ? "ok" : "error";
    }

    // Editar
    static public function mdlEditarPadron($tabla, $d)
    {
        $sql = "UPDATE $tabla SET
      nombre=:nombre,
      apellido_paterno=:ap_pat,
      apellido_materno=:ap_mat,
      genero=:genero,
      curp=:curp,
      calle=:calle,
      numero=:numero,
      colonia=:colonia,
      sede=:sede
      WHERE id=:id";
        $st = conexiondb::conectar()->prepare($sql);

        $st->bindParam(":id",      $d["id"], PDO::PARAM_INT);
        $st->bindParam(":nombre",  $d["nombre"], PDO::PARAM_STR);
        $st->bindParam(":ap_pat",  $d["apellido_paterno"], PDO::PARAM_STR);
        $st->bindParam(":ap_mat",  $d["apellido_materno"], PDO::PARAM_STR);
        $st->bindParam(":genero",  $d["genero"], PDO::PARAM_STR);
        $st->bindParam(":curp",    $d["curp"], PDO::PARAM_STR);
        $st->bindParam(":calle",   $d["calle"], PDO::PARAM_STR);
        $st->bindParam(":numero",  $d["numero"], PDO::PARAM_STR);
        $st->bindParam(":colonia", $d["colonia"], PDO::PARAM_STR);
        $st->bindParam(":sede",    $d["sede"], PDO::PARAM_STR);

        return $st->execute() ? "ok" : "error";
    }

    // Eliminar
    static public function mdlEliminarPadron($tabla, $id)
    {
        $st = conexiondb::conectar()->prepare("DELETE FROM $tabla WHERE id=:id");
        $st->bindParam(":id", $id, PDO::PARAM_INT);
        return $st->execute() ? "ok" : "error";
    }

    // (OPT) Verificar duplicado por CURP
    static public function mdlBuscarPorCurp($tabla, $curp)
    {
        $st = conexiondb::conectar()->prepare("SELECT id FROM $tabla WHERE curp=:curp LIMIT 1");
        $st->bindParam(":curp", $curp, PDO::PARAM_STR);
        $st->execute();
        return $st->fetch() ?: null;
    }
}
