<?php

if (isset($_POST)) {
    //conexion
    require_once 'includes/conexion.php';
    
    //Obtener los datos del formulario
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    
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
    
    $guardar_usuario = false;
    if (count($errores) == 0) {
        $guardar_usuario = true;
        
        //Cifrar la password
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        
        $usuario = $_SESSION['usuario'];
        
        //Comprobar si el email existe
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        if ($isset_user['id'] == $usuario['id'] || empty($isset_user) ) {
            //Actualizar usuario en la bd
            $sql = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellido', email = '$email' WHERE id =" . $usuario['id'];
            $guardar = mysqli_query($db, $sql);

            if ($guardar) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellido;
                $_SESSION['usuario']['email'] = $email;

                $_SESSION['completado'] = "Tus datos se han actualizado con éxito";
            } else {
                $_SESSION['errores']['general'] = "Error al guardar la actualización";
            }
        }else{
            $_SESSION['errores']['general'] = "Error el usuario existe";
        }
    }else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location: mis-datos.php');
