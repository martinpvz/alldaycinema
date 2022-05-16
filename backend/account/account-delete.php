<?php

// namespace\Clase
use DataBase\Cuentas;

require_once '../API/account.php';

$var = new Cuentas();

$var->delete($_POST);

echo $var->getResponse();
