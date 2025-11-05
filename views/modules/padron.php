<?php
require_once "controllers/padron.controller.php";
require_once "models/padron.model.php";
$lista = ControllerPadron::ctrMostrarPadron(null, null);
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Encabezado -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div style="font-size:25px;"><i class="fas fa-id-card"></i> Módulo Padrón</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Columna izquierda: FORMULARIO (ALTA) -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3"><i class="fas fa-user-plus"></i> Agregar Registro</h5>

                            <form method="post" role="form" id="formPadronAlta">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nombre(s)</label>
                                        <input type="text" class="form-control" name="nombre" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" name="apellido_paterno" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Apellido Materno</label>
                                        <input type="text" class="form-control" name="apellido_materno">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Género</label>
                                        <select class="form-control" name="genero" required>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">CURP</label>
                                        <input type="text" class="form-control" id="curp_alta" name="curp"
                                            maxlength="18" style="text-transform:uppercase" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Sede</label>
                                        <input type="text" class="form-control" name="sede">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Calle</label>
                                        <input type="text" class="form-control" name="calle">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Número</label>
                                        <input type="text" class="form-control" name="numero">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Colonia</label>
                                        <input type="text" class="form-control" name="colonia">
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                        Guardar</button>
                                </div>

                                <?php
                                $guardar = new ControllerPadron();
                                $guardar->ctrGuardarPadron();
                                ?>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Columna derecha: DATATABLE -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3"><i class="fas fa-table"></i> Registros</h5>

                            <table id="padronTable"
                                class="table table-striped table-bordered dt-responsive nowrap example2 tablas"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Ap. Paterno</th>
                                        <th>Ap. Materno</th>
                                        <th>Género</th>
                                        <th>CURP</th>
                                        <th>Sede</th>
                                        <th>Colonia</th>
                                        <th>Creado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($lista)) {
                                        foreach ($lista as $key => $v) {
                                            echo '
                        <tr>
                          <td>' . ($key + 1) . '</td>
                          <td>' . htmlspecialchars($v["nombre"]) . '</td>
                          <td>' . htmlspecialchars($v["apellido_paterno"]) . '</td>
                          <td>' . htmlspecialchars($v["apellido_materno"]) . '</td>
                          <td>' . htmlspecialchars($v["genero"]) . '</td>
                          <td>' . htmlspecialchars($v["curp"]) . '</td>
                          <td>' . htmlspecialchars($v["sede"]) . '</td>
                          <td>' . htmlspecialchars($v["colonia"]) . '</td>
                          <td>' . htmlspecialchars($v["creado_en"]) . '</td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-primary btn-sm btnEditarPadron"
                                      idPadron="' . $v["id"] . '"
                                      data-bs-toggle="modal"
                                      data-bs-target="#modalEditarPadron">
                                <i class="fas fa-pencil-alt"></i> Editar
                              </button>
                              <button class="btn btn-danger btn-sm btnEliminarPadron"
                                      idPadron="' . $v["id"] . '">
                                <i class="fas fa-trash-alt"></i> Eliminar
                              </button>
                            </div>
                          </td>
                        </tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div> <!-- /row -->

        </div>
    </div>
</div>

<!-- MODAL: Editar -->
<div class="modal fade" id="modalEditarPadron" tabindex="-1" aria-labelledby="labelEditarPadron" style="display:none;"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="labelEditarPadron"><i class="fas fa-user-edit"></i> Editar Registro</h5>
                <hr>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="post" role="form" id="formPadronEditar">
                    <input type="hidden" class="form-control" id="editar_id" name="editar_id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre(s)</label>
                            <input type="text" class="form-control" id="editar_nombre" name="editar_nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="editar_apellido_paterno"
                                name="editar_apellido_paterno" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="editar_apellido_materno"
                                name="editar_apellido_materno">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Género</label>
                            <select class="form-control" id="editar_genero" name="editar_genero" required>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">CURP</label>
                            <input type="text" class="form-control" id="editar_curp" name="editar_curp" maxlength="18"
                                style="text-transform:uppercase" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sede</label>
                            <input type="text" class="form-control" id="editar_sede" name="editar_sede">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Calle</label>
                            <input type="text" class="form-control" id="editar_calle" name="editar_calle">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Número</label>
                            <input type="text" class="form-control" id="editar_numero" name="editar_numero">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Colonia</label>
                            <input type="text" class="form-control" id="editar_colonia" name="editar_colonia">
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>

                    <?php
                    $editar = new ControllerPadron();
                    $editar->ctrEditarPadron();
                    ?>
                </form>
            </div>

        </div>
    </div>
</div>

<?php
$eliminar = new ControllerPadron();
$eliminar->ctrEliminarPadron();
?>

<!-- JS del módulo -->
<script src="views/js/padron.js"></script>