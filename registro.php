<?php

if (isset($_POST)) {
    //conexion
    require_once 'includes/conexion.php';

    //iniciar sesion
    if (!isset($_SESSION)) {
        session_start();
    }
    
    //Obtener los datos del formulario
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
    
    //Array de errores
    $errores = array();
    
    //Validar los datos antes de guardarlos
    
    //Nombre
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    }else{
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es valido";  
    }
    
    //Apellido
    if (!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)) {
        $apellido_validado = true;
    }else{
        $apellido_validado = false;
        $errores['apellido'] = "El apellido no es valido";  
    }
    
    //Email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    }else{
        $email_validado = false;
        $errores['email'] = "El email no es valido";  
    }
    
    //Password
    if (!empty($password)) {
        $password_validado = true;
    }else{
        $password_validado = false;
        $errores['password'] = "La password esta vacia";  
    }
    
    $guardar_usuario = false;
    if (count($errores) == 0) {
        $guardar_usuario = true;
        
        //Cifrar la password
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        
        //Insertar usuario en la bd
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellido', '$email', '$password_segura', CURDATE())";
        $guardar = mysqli_query($db, $sql);
        
        if ($guardar) {
            $_SESSION['completado'] = "El registro se ha completado con exito";
        }else{
            $_SESSION['errores']['general'] = "Error al guardar el usuario";
        }
        
    }else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location: index.php');
