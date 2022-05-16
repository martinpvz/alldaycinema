<?php
// namespace\Clase
use DataBase\Cuenta;

require_once '../API/account.php';

$var = new Cuenta();

$var->create($_POST);
echo $var->getResponse();
?>