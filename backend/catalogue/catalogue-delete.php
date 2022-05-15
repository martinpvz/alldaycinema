<?php

use DataBase\Catalogo;

require_once '../API/catalogue.php';

$var = new Catalogo();

$var->delete($_POST);

echo $var->getResponse();
