<?php
	session_start();
	require_once 'funciones_bd.php';
	$db = new funciones_BD();

	$id = $_POST['propiedad'];
	$titulo = $_POST['titulo'];
	$descripcion = $_POST['descripcion'];
	$ubicacion = $_POST['ubicacion'];
	$precio = $_POST['precio'];
	$estado = $_POST['estado'];
	
	if (!$db->SiExiste($titulo))
	{
		if($db->editar_propiedad($titulo, $descripcion, $ubicacion, $estado, $precio, $id))
		{
			$exito = urlencode("Propiedad modificada");
		    header("Location:../editar_propiedades.php?exito=".$exito);
		    die;
		}
		else
		{
			$error = urlencode("No se pudo modificar la propiedad");
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