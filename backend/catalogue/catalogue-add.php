<?php

// namespace\Clase
use DataBase\Catalogo;

require_once '../API/catalogue.php';

$var = new Catalogo();

$var->add($_POST);

echo $var->getResponse();
