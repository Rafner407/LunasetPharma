<?php

include 'config.php';

session_start();

$connect = mysqli_connect("localhost", "root", "", "shop_db");

$user_id = $_SESSION['user_id'];

$fromUser = $_POST["fromUser"];
$toUser = $_POST["toUser"];
$output="";

$chats = mysqli_query($connect, "SELECT * FROM message where (fromUser = '".$fromUser."' AND toUser = '".$toUser."') OR (fromUser = '".$toUser."' AND toUser = '".$fromUser."')")
    or die("Falha no banco de dados".mysqli_error());
    while($chat = mysqli_fetch_assoc($chats))
    {
        if($chat["fromUser"] == $fromUser)
                              {
                                 $output.= "<div style='text-align:right;'>
                                          <p style='background-color:lightblue; word-wrap:breakword; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                                             ".$chat["message"]."
                                          </p>
                                       </div>";
                              } else { 
                                 $output.= "<div style='text-align:left;'>
                                          <p style='background-color:yellow; word-wrap:breakword; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                                             ".$chat["message"]."
                                          </p>
                                       </div>";
                              }
    }
    echo $output;

?>