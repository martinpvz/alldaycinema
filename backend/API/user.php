<?php
namespace DataBase;

use DataBase\DataBase;
require_once __DIR__ . '/database.php';

class User extends DataBase
{
    public function __construct($string = 'vod')
    {
        $this->response = "";
        parent::__construct($string);
    }

    // public function getResponse()
    // {
    //     return json_encode($this->response, JSON_PRETTY_PRINT);
    // }

    public function validate($post)
    {
        session_start();
        $_SESSION['sesion'] = true;
        $_SESSION['user'] = $post['user'];
        
        //Consulta
        $sql = "SELECT * FROM usuarios WHERE user='{$post['user']}' and pass='{$post['password']}'";
        $result = mysqli_query($this->conexion,$sql);
        
        $filas = mysqli_num_rows($result);
        
        if($filas){
            header("location:../../profiles.php?email=" . $_POST['email']); 
        }
        else{
            //REVISAR MENSAJE DE FALLO DE CONEXIÓN
            header("location:../../index.php"); 
        }
        mysqli_free_result($result);
        mysqli_close($this->conexion);       
    }
}

?>
