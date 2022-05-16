<?php

// namespace\Clase
use DataBase\Cuentas;

require_once '../API/account.php';

$var = new Cuentas();

$var->add($_POST);

echo $var->getResponse();
