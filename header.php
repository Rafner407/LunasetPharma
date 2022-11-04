<?php

$user_id = $_SESSION['user_id'];

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

<head>
   <link rel="stylesheet" href="css/style.css">
</head>

<header class="header">



   <div class="header-2">
      <div class="flex">
         <div class="row" style="display: flex">
         <div>
         <img src="uploaded_img/LUNA.png" style="height: 40px; width: 40px; border-radius: 50%; float: right">
         </div>
         <div>
         <a href="home.php" class="logo" style="color: black; float: left; margin-top: 7px;">Lunaset Pharma</a>
         </div>
         </div>

         <nav class="navbar">
            <a href="home.php">início</a>
            <a href="shop.php">comprar</a>   
            <a href="contact.php">contato</a>
            <a href="orders.php">pedidos</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <?php  
         $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$user_id'") or die('query failed');
         if(mysqli_num_rows($select_users) > 0){
            while($fetch_users = mysqli_fetch_assoc($select_users)){
         ?>
            <img class="image" id="user-btn" src="uploaded_img/<?php echo $fetch_users['image']; ?>" alt="" style="height: 30px; width: 30px; border-radius: 50%;">
            <?php
         }
      }
         ?>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>nome de usuário : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="logout.php" class="delete-btn">logout</a>
         </div>

      </div>
   </div>

</header>