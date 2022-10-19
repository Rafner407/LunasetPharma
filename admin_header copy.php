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

<body>
<header class="header" id="header">



   <div class="flex" id="body-pd">
      <a href="admin_page.php" class="logo"><span>Lunaset</span> painel do admin</a>
      <nav class="navbar">
         <a href="admin_page.php">início</a>
         <a href="admin_products.php">produtos</a>
         <a href="admin_orders.php">pedidos</a>
         <a href="admin_users.php">usuários</a>
         <a href="admin_contacts.php">mensagens</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>nome de usuário : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>novo <a href="login.php">login</a> | <a href="register.php">registro</a></div>
      </div>

   </div>

</header>
</body>