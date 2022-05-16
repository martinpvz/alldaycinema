<?php

// namespace\Clase
use DataBase\Perfiles;

require_once '../API/profile.php';

$var = new Perfiles();

$var->edit($_POST);

echo $var->getResponse();
