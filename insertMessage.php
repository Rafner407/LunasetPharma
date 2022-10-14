<?php

include 'config.php';

session_start();

$fromUser = $_POST["fromUser"];
$toUser = $_POST["toUser"];
$message = $_POST["message"];

$output="";

$sql = "INSERT INTO `message` (fromUser, toUser, message) VALUES ('$fromUser', '$toUser', '$message')";

if($conn -> query($sql))
{
    $output.="";
} else {
    $output.="Erro. Por favor, tente novamente.";
}
echo $output;
?>