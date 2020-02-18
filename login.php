<?php

//Iniciar la sesion y la conexion a la bd
require_once 'includes/conexion.php';

//Obtener datos del formulario
if (isset($_POST)) {
    
    //Borro error antiguo
    if (isset($_SESSION['error_login'])) {
        session_unset($_SESSION['error_login']);
    }
    
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    //Consulta a la bd si el mail y la pass existen
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);
    
    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);
        
        //Comprobar la password
        $verify = password_verify($password, $usuario['password']);
        
        if ($verify) {
            //Utilizar una sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;
            
        }else{
            //Si falla enviar sesion con fallo
            $_SESSION['error_login'] = "Login incorrecto";
        }
        
    }else{
        $_SESSION['error_login'] = "Login incorrecto";
    }
    
}

//Redirigir al index
header('Location: index.php');
