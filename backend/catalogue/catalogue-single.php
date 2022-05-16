<?php

use DataBase\Catalogo;

require_once '../API/catalogue.php';

$var = new Catalogo();

$var->single($_POST);

echo $var->getResponse();
