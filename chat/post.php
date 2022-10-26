<?php
session_start();

if(isset($_SESSION['user_id'])){
    $text = $_POST['text'];
    $name = $_SESSION['name'];
     
    $text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$name."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
    file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);

}
?>
<p> <?php echo ($name); ?> </p>