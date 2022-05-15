<?php

use DataBase\Catalogo;

require_once '../API/catalogue.php';

$var = new Catalogo();

$var->search($_GET);

echo $var->getResponse();
