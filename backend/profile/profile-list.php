<?php

// namespace\Clase
use DataBase\Perfiles;

require_once '../API/profile.php';

$var = new Perfiles();

$var->list($_GET);

echo $var->getResponse();
