<?php

use DataBase\Catalogo;

require_once '../API/catalogue.php';

$var = new Catalogo();

$var->searchAdmin($_GET);

echo $var->getResponse();
