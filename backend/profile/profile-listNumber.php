<?php

// namespace\Clase
use DataBase\Perfiles;

require_once '../API/profile.php';

$var = new Perfiles();

$var->listNumber($_GET);

echo $var->getResponse();

?>