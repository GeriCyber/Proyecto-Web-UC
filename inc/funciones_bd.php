<?php

class funciones_BD 
{
    public function __construct() 
    {
        require_once 'protected/config.php';
        $this->user = DB_USER;
        $this->password = DB_PASSWORD;
        $this->database = DB_DATABASE;
        $this->host = DB_HOST;
    }
    protected function connect() 
    {
        return mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    // destructor
    function __destruct() 
    {
        mysqli_close($this->connect());
    }

    public function login($usuario,$clave)
    {
        $db = $this->connect();
        $clave_encriptada = mysqli_real_escape_string($db,md5($clave));
        $result = mysqli_query($db, "SELECT usuario, password FROM rol WHERE usuario='$usuario' AND password='$clave_encriptada' LIMIT 1");
        if (mysqli_num_rows($result) > 0)
        {
            $registro = mysqli_fetch_assoc($result);
            $datos = array(
                "logstatus" => 1,
                "usuario" => $registro["usuario"]
            );
        }
        else 
        {
            $datos = array(
                "logstatus" => 0,
            );
        }
        $lista = array();
        $lista[] = $datos;

        return ($lista);
    }  

    public function listar_propiedades()
    {
        $db = $this->connect();
        $sql = "SELECT * FROM propiedad";
        $lista = [];
        $result = mysqli_query($db, $sql);
        if ($result)
        {
            while ($registro = mysqli_fetch_assoc($result))
            {
                $lista[] = 
                [
                    'id' => $registro['id'],
                    'titulo' => $registro['titulo'],
                    'descripcion' => $registro['descripcion'],
                    'ubicacion' => $registro['ubicacion'],
                    'precio' => $registro['precio'],
                    'estado' => $registro['estado']
                ];
            }
        }
        return $lista;
    }

    public function SiExiste($titulo) 
    {
        $db = $this->connect();
        $result = mysqli_query($db, "SELECT titulo from propiedad WHERE titulo = '$titulo'");

        $num_rows = mysqli_num_rows($result);

        if ($num_rows > 0) 
           return true;
         else 
            return false; 
    }

    public function registrar_propiedad($titulo, $descripcion, $ubicacion, $estado, $precio)
    {
        $db = $this->connect();
        $titulo_codificado = mysqli_real_escape_string($db, ($titulo));
        $descripcion_codificado = mysqli_real_escape_string($db, ($descripcion));
        $ubicacion_codificado = mysqli_real_escape_string($db, ($ubicacion));
        $precio_codificado = mysqli_real_escape_string($db, ($precio));
        $sql =
            "INSERT INTO propiedad(titulo, descripcion, ubicacion, estado, precio) VALUES('$titulo_codificado', '$descripcion_codificado', '$ubicacion_codificado', '$precio_codificado', '$estado')";
        $result = mysqli_query($db, $sql);

        if ($result) 
            return true;
        else 
            return false;
    }
    public function editar_propiedad($titulo, $descripcion, $ubicacion, $estado, $precio, $id)
    {
        $db = $this->connect();
        $titulo_codificado = mysqli_real_escape_string($db, ($titulo));
        $descripcion_codificado = mysqli_real_escape_string($db, ($descripcion));
        $ubicacion_codificado = mysqli_real_escape_string($db, ($ubicacion));
        $precio_codificado = mysqli_real_escape_string($db, ($precio));
        $sql = "UPDATE propiedad SET titulo = '$titulo_codificado', descripcion = '$descripcion_codificado', ubicacion = '$ubicacion_codificado', precio = $precio_codificado, estado = '$estado' WHERE id = $id";

        $result = mysqli_query($db, $sql);

        if ($result) 
            return true;
        else 
            return false;
    }
    public function eliminar_propiedad($id)
    {
        $db = $this->connect();
        $sql = "DELETE FROM propiedad WHERE id = $id";
        $result = mysqli_query($db, $sql);
        if ($result)
            return true;
        else
            return false;
    }
}
?>