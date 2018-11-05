<?php
session_start();
/*LOGIN*/

$usuario = $_POST['usuario'];
$clave = $_POST['password'];

require_once 'funciones_bd.php';
$db = new funciones_BD();

$resultado = $db->login($usuario,$clave);

    if ($resultado[0]["logstatus"] == 1)
    {
        $_SESSION["usuario"] = $resultado[0]["usuario"];
        switch ($resultado[0]["usuario"]) 
        {
            case "admin":
                header("Location: ../dashboard.php");
                break;
            default:
                break;
        }
    }
    else
    {
        $error = urlencode("Usuario o Contraseña inválida");
        header("Location: ../ingresar.php?error=".$error);
        die;
    }

    echo json_encode($resultado);

?>
