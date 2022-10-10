<?php

include 'config.php';

session_start();

$connect = mysqli_connect("localhost", "root", "", "shop_db");

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

$fromUser = $_POST["fromUser"];
$toUser = $_POST["toUser"];
$message = $_POST["message"];

$output="";

$sql = "INSERT INTO messages(fromUser, toUser, message) VALUES ('$fromUser', '$toUser', '$message')";

if($connect -> query($sql))
{
    $output.="";
} else {
    $output.="Erro. Por favor, tente novamente.";
}
echo $output;
?>