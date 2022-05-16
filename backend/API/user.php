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

    public function getResponse()
    {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }

    public function validate($post)
    {
        session_start();
        $_SESSION['sesion'] = true;
        $_SESSION['user'] = $post['user'];
        
        //Consulta
        $sqlAdmin = "SELECT * FROM usuarios WHERE user='{$post['user']}' and pass='{$post['password']}' and nivel = '0'";
        $sqlUser = "SELECT * FROM usuarios WHERE user='{$post['user']}' and pass='{$post['password']}' and nivel = '1'";
        $resultAdmin = mysqli_query($this->conexion,$sqlAdmin);
        $resultUser = mysqli_query($this->conexion,$sqlUser);
        
        $filasAdmin = $resultAdmin->fetch_all(MYSQLI_ASSOC);;
        $filasUser = $resultUser->fetch_all(MYSQLI_ASSOC);;
        
        if($filasUser){
            header("location:../../profiles.php?email=" . $_POST['email']); 
        }
        else if($filasAdmin){
            header("location:../../homeAdmin_Peliculas.php"); 
        } else {
            header("location:../../index.php"); 
        }
        mysqli_free_result($resultAdmin);
        mysqli_close($this->conexion);       
    }
}

?>
