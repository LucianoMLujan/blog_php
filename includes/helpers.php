<?php

function mostrarError($errores, $campo){
    $alerta = '';
    
    if($errores[$campo] && !empty($campo)){
        $alerta = "<div class='alerta error'>".$errores[$campo]."</div>";
    }
    
    return $alerta;
}

function borrarErrores() {
    $_SESSION['errores'] = null; 
    $_SESSION['completado'] = null;
    $borrado = session_unset();
    
    return $borrado;
}

function conseguirCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC";
    $categorias = mysqli_query($conexion, $sql);
    $result = array();
    
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $result = $categorias;
    }
    
    return $result;
}

function conseguirUltimasEntradas($conexion) {
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e"
            . " INNER JOIN categorias c ON e.categoria_id = c.id"
            . " ORDER BY e.id DESC LIMIT 4";

    $entradas = mysqli_query($conexion, $sql);
    $result = array();

    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $result = $entradas;
    }
    
    return $result;
}