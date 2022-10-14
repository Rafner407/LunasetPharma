<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $alerg = mysqli_real_escape_string($conn, $_POST['alergia']);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, alergia) VALUES('$name', '$email', '$cpass', '$alerg')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>registro</h3>
      <input type="text" name="name" placeholder="Digite seu nome" required class="box">
      <input type="email" name="email" placeholder="Digite seu email" required class="box">
      <input type="password" name="password" placeholder="Digite sua senha" required class="box">
      <input type="password" name="cpassword" placeholder="Confirme sua senha" required class="box">
      <select class="box" id="selection"  onChange="selectOnchange();">
         <option>Possui alergia a algum medicamento?</option>
         <option value="sim">sim</option>
         <option value="nao">não</option>
      </select>
      <input type="text" name="alergia" placeholder="Qual?" required class="box" id="alerg" hidden/>
      <input type="submit" name="submit" value="registrar" class="btn">
      <p>já possui uma conta? <a href="login.php">faça login aqui</a></p>
   </form>

</div>

</body>

<script>
function selectOnchange(){
    var select = document.getElementById('selection').value 
    if(select == "sim")
        document.getElementById("alerg").style.display="block";
    else
        document.getElementById("alerg").style.display="none";
}
 </script>

</html>