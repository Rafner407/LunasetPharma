<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];

if(!isset($user_id)){
    header('location:login.php');
} else {
    $_SESSION['user_name'] = stripslashes(htmlspecialchars($_SESSION['user_name']));
}
$select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
while ($fetch_users = mysqli_fetch_assoc($select_users));{



 
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="icon" href="uploaded_img/LUNA.png">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/styleChat.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>converse conosco</h3>
   <p> <a href="home.php">início</a> / contato </p>
</div>

<?php
    if(!isset($_SESSION['user_name'])){
        loginForm();
    }
    else {
    ?>
        <div id="wrapper">
            <div id="menu">
               <p style="font-size: 20px"><b> Olá, <?php echo $_SESSION['user_name']; ?></b></p></br>
               <p style="font-size: 20px"> Entre em contato com os administradores!</p>
            </div>
 
            <div id="chatbox">
            <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $contents = file_get_contents("log.html");          
                echo $contents;
            }
            ?>
            </div>
 
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" placeholder="  Digite uma mensagem"/>
                <input name="submitmsg" type="submit" id="submitmsg" value="Enviar" />
            </form>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            // jQuery Document
            $(document).ready(function () {
                $("#submitmsg").click(function () {
                    var clientmsg = $("#usermsg").val();
                    $.post("post.php", { text: clientmsg });
                    $("#usermsg").val("");
                    return false;
                });
 
                function loadLog() {
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
 
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }
 
                setInterval (loadLog, 2500);
 
            });
        </script>

<!-- <section class="contact">

   <form action="" method="post">
      <h3>Diga algo!</h3>
      <input type="text" name="name" required placeholder="Digite seu nome" class="box">
      <input type="email" name="email" required placeholder="Digite seu email" class="box">
      <input type="number" name="number" required placeholder="Digite seu número" class="box">
      <textarea name="message" class="box" placeholder="Digite sua mensagem" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="enviar" name="send" class="btn">
   </form>

</section> -->


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
<?php
    } 
   }
    ?>