<?php

use DataBase\Catalogo;

require_once '../API/catalogue.php';

$var = new Catalogo();

$var->edit($_POST);

echo $var->getResponse();
