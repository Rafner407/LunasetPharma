<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'MainSideBar.php'; ?>

<header class="header">

   <div class="flex">  
      <a href="admin_users.php" class="logo">usuários</a>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
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

<section class="users">

   <h1 class="title"> Contas dos usuários </h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> id do usuário: <span><?php echo $fetch_users['id']; ?></span> </p>
         <p> nome do usuário: <span><?php echo $fetch_users['name']; ?></span> </p>
         <p> alergias: <span><?php echo $fetch_users['alergia']; ?></span> </p>
         <p> email: <span><?php echo $fetch_users['email']; ?></span> </p>
         <p> tipo de usuário: <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('deletar este usuário?');" class="delete-btn">deletar usuário</a>
      </div>
      <?php
         };
      ?>
   </div>

</section>









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>