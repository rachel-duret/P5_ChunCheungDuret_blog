<?php
require_once('config.php');
$id = $_POST['id'];
echo '<pre>';
var_dump($_POST);
echo '</pre>';
if(!$id){
    header('location: blogs.php');

}


$sqlQuery = 'DELETE FROM posts Where id= :id ';
// send one request
$postStatement = $db->prepare($sqlQuery);
$postStatement->execute( ['id'=>$id]);
header('location: blogs.php');