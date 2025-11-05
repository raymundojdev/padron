<?php

ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log",  "R:/xampp/htdocs/cms-proyecto/php_error_log");


require_once "controllers/plantilla.controller.php";

require_once "controllers/usuarios.controller.php";
require_once "models/usuarios.model.php";

require_once "controllers/padron.controller.php";
require_once "models/padron.model.php";





$plantilla = new ControllerPlantilla();
$plantilla->ctrPlantilla();
