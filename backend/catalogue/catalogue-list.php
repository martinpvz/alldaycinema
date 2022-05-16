<?php

// namespace\Clase
use DataBase\Catalogo;

require_once '../API/catalogue.php';

$var = new Catalogo();

$var->list($_GET);

echo $var->getResponse();
