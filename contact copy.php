<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

$users = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '".$_SESSION["user_id"]."'")
         or die("Falha no banco de dados".mysql_error());
         $user = mysqli_fetch_assoc($users);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="/resourses/demos/style.css">
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


</head>
<body>
<div class="container-fluid">
   <div class="row">
      <div class="col-md-4">
         <p>Hi <?php echo $user["name"]; ?></p>
         <input type="text" id="FromUser" value=<?php echo $user["id"]; ?> hidden />

         <p>Enviar mensagem para:</p>
            <ul>
               <?php 
                  $msgs = mysqli_query($conn, "SELECT * FROM `users`")
                  or die("Falha no banco de dados".mysql_error());
                  while ($msg = mysqli_fetch_assoc($msgs))
                  {
                     echo '<li><a href="?ToUser='.$msg["id"].'">'.$msg["name"].'</a></li>';
                  }
               ?>
            </ul>
      </div>
      <div class="col-md-4">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h4>
                     <?php 
                        if(isset($_GET["ToUser"]))
                        {
                           $userName = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '".$_GET["ToUser"]."'")
                           or die("Falha no banco de dados".mysqli_error());
                           $uName = mysqli_fetch_assoc($userName);
                           echo '<input type="text" value='.$_GET["ToUser"].' id="ToUser" hidden />';
                           echo $uName["name"];
                        } else {
                           $userName = mysqli_query($conn, "SELECT * FROM `users`")
                           or die("Falha no banco de dados".mysqli_error());
                           $uName = mysqli_fetch_assoc($userName);
                           $_SESSION["ToUser"] = $uName["id"];
                           echo '<input type="text" value='.$_GET["ToUser"].' id="ToUser" hidden />';
                           echo $uName["name"];
                        }
                     ?>
                  </h4>
               </div>
               <div class="modal-body" id="msgBody" style="height:400px; overflow-y: scroll; overflow-x: hidden;">
                     <?php 
                        if(isset($_GET["ToUser"]))
                        {
                              $chats = mysqli_query($conn, "SELECT * FROM `message` where (fromUser = '".$_SESSION["user_id"]."' AND 
                              toUser = '".$_GET["ToUser"]."') OR (fromUser = '".$_GET["ToUser"]."' AND 
                              toUser = '".$_SESSION["user_id"]."') ")
                           or die("Falha no banco de dados".mysqli_error());
                           $chat = mysqli_fetch_assoc($chats);
                        } else {
                        $chats = mysqli_query($conn, "SELECT * FROM `message` where (fromUser = '".$_SESSION["user_id"]."' AND 
                              toUser = '".$_SESSION["ToUser"]."') OR (fromUser = '".$_SESSION["ToUser"]."' AND 
                              toUser = '".$_SESSION["user_id"]."') ")
                           or die("Falha no banco de dados".mysqli_error());
                           
                           while($chat = mysqli_fetch_assoc($chats))
                           {
                              if($chat["fromUser"] == $_SESSION["user_id"])
                                 echo "<div style='text-align:right;'>
                                          <p style='background-color:lightblue; word-wrap:breakword; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                                             ".$chat["message"]."
                                          </p>
                                       </div>";
                               else
                                 echo "<div style='text-align:left;'>
                                          <p style='background-color:yellow; word-wrap:breakword; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                                             ".$chat["message"]."
                                          </p>
                                       </div>";
                              
                           }
                        }   
                     ?>
               </div>
               <div class="modal-footer">
                  <textarea id="message" class="form-control" style="height:70px;"></textarea>
                  <button id="send" class="btn btn-primary" style="height:70%">send</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

</body>

<script type="text/javascript">
   $(document).ready(function(){

      $("#send").on("click",function(){
         $.ajax({
            url:"insertMessage.php",
            method:"POST",
            data:{
               fromUser: $("#fromUser").val(),
               toUser: $("#toUser").val(),
               message: $("#message").val(),
            },
            dateType:"text",
            success:function(data)
            {
               $("#message").val("");
            }
         });
      });

      setInterval(function(){
         $.ajax({
            url:"realTimeChat.php",
            method:"POST",
            data:{
               fromUser:$("#fromUser").val(),
               toUser:$("#toUser").val()
            },
            dataType:"text",
            success:function(data)
            {
               $(#msgBody).html(data);
            }
         });
      }, 700);
   });
</script>
</html>