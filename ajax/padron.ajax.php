<?php
require_once "../controllers/padron.controller.php";
require_once "../models/padron.model.php";

// Cargar por ID (Editar)
if (isset($_POST["idPadron"])) {
    $item  = "id";
    $valor = (int)$_POST["idPadron"];
    $r = ControllerPadron::ctrMostrarPadron($item, $valor);
    header('Content-Type: application/json; charset=utf-8'); // (OPT)
    echo json_encode($r ?: []);
    exit;
}

// Validar CURP duplicado (Alta)
if (isset($_POST["validarCURP"])) {
    $curp = strtoupper(trim($_POST["validarCURP"]));
    $r = ModelPadron::mdlBuscarPorCurp("padron", $curp);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($r ?: null);
    exit;
}
