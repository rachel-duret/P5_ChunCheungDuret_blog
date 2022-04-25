<?php

try {
$db = new PDO('mysql:host=localhost;dbname=blog','root','root');
}
catch (Exception $error)
{
die('Erreur:' . $error->getMessage());
}