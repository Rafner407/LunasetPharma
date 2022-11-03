<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];
$name = $_SESSION['admin_name'];

if(!isset($admin_id)){
    header('location:login.php');
} else {
    $_SESSION['admin_name'] = stripslashes(htmlspecialchars($_SESSION['admin_name']));
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
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="icon" href="uploaded_img/LUNA.png">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/styleChat.css">

</head>
<body>
   
<?php include 'MainSideBar.php'; ?>

<header class="header">

   <div class="flex">  
      <a href="admin_contacts.php" class="logo">mensagens</a>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars" style="color: white"></div>
         <button id="user-btn" class="btn">sair</button>
      </div>

      <div class="account-box">
         <p>nome de usuário: <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>novo <a href="login.php">login</a> | <a href="register.php">registro</a></div>
      </div>

   </div>

</header> 


<?php
    if(!isset($_SESSION['admin_name'])){
        loginForm();
    }
    else {
    ?>
        <div id="wrapper" style="margin-top: 20px;">
            <div id="menu">
               <p style="font-size: 20px"><b> Olá, <?php echo $_SESSION['admin_name']; ?></b></p></br>
               <p style="font-size: 20px"> Veja suas mensagens recebidas!</p>
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
                    $.post("post_admin.php", { text: clientmsg });
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


</body>
</html>
<?php
    } 
   }
    ?>