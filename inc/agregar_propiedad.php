<?php
	session_start();
	require_once 'funciones_bd.php';
	$db = new funciones_BD();

	$titulo = $_POST['titulo'];
	$descripcion = $_POST['descripcion'];
	$ubicacion = $_POST['ubicacion'];
	$precio = $_POST['precio'];
	$estado = $_POST['estado'];
	
	if (!$db->SiExiste($titulo))
	{
		if($db->registrar_propiedad($titulo, $descripcion, $ubicacion, $precio, $estado))
		{
			$exito = urlencode("Propiedad agregada");
		    header("Location:../editar_propiedades.php?exito=".$exito);
		    die;
		}
		else
		{
			$error = urlencode("No se pudo agregar la propiedad");
		    header("Location:../editar_propiedades.php?error=".$error);
		    die;
		}
	}
	else
	{
		$error = urlencode("Ya existe la propiedad");
	    header("Location:../editar_propiedades.php?error=".$error);
	    die;
	}
	
?>