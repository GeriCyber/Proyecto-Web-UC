<?php
	session_start();
	require_once 'funciones_bd.php';
	$db = new funciones_BD();

	$id = $_POST['propiedad'];
	
	if($db->eliminar_propiedad($id))
	{
		$exito = urlencode("Propiedad eliminada");
	    header("Location:../editar_propiedades.php?exito=".$exito);
	    die;
	}
	else
	{
		$error = urlencode("No se pudo eliminar la propiedad");
	    header("Location:../editar_propiedades.php?error=".$error);
	    die;
	}
	
?>