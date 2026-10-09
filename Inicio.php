<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header('Location: formLogin.php');
    exit;
}
require_once __DIR__.'/includes/PageClass.php';
require_once __DIR__.'/conexion.php';

$sql = "SELECT id_materia, nombre FROM materias";
$resultado = $conexion->query($sql);

$filasTabla = '';
if ($resultado && $resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $filasTabla .= '<tr>
            <td>' . $fila['id_materia'] . '</td>
            <td>' . htmlspecialchars($fila['nombre'], ENT_QUOTES, 'UTF-8') . '</td>
            <td class="text-end">
                <a href="eliminarMateria.php?id=' . $fila['id_materia'] . '" class="btn btn-sm btn-outline-danger">Eliminar</a>
            </td>
        </tr>';
    }
} else {
    $filasTabla = '<tr><td colspan="3" class="text-center text-muted">No hay materias cargadas.</td></tr>';
}

$body = '
<div class="row mt-4">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header text-white" style="background-color: #0d6efd;">
                <h5 class="card-title mb-0">Nueva Materia</h5>
            </div>
            <div class="card-body">
                <form action="guardarMateria.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la materia</label>
                        <input type="text" name="nombre" class="form-control" required placeholder="Ej: Bases de Datos">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Guardar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0">Mis Materias</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        ' . $filasTabla . '
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>';

    $oPage=new PageClass();

      $oPage->setBody($body);

    echo $oPage->getHtml();


?>
