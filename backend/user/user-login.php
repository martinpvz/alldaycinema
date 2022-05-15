<?php
// namespace\Clase
use DataBase\User;

require_once '../API/user.php';

$var = new User();

$var->validate($_POST);
?>