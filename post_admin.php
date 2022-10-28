<?php
session_start();

date_default_timezone_set('UTC');

if(isset($_SESSION['admin_id'])){
    $text = $_POST['text'];
     
    $text_message = "<div class='msglnA'><span class='chat-time'>".date("H:i:s")."</span> <b class='user-name'>".$_SESSION['admin_name']."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);

}
?>