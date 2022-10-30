<?php
session_start();

date_default_timezone_set('UTC');

if(isset($_SESSION['user_id'])){
    $text = $_POST['text'];
     
    $text_message = "<div class='msgln'><span class='chat-time'>".date("H:i:s")."</span> <b class='user-name'     $text_message = "<div class='msgln' style='font-size: 20px;'><span class='chat-time'>".date("H:i:s")."</span> <b class='user-name' styt>".$_SESSION['user_name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    >".$_SESSION['user_name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);

}
?>