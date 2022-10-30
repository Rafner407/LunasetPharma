<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $desc = $_POST['descricao'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'produto já foi adicionado';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, descricao, image) VALUES('$name', '$price', '$desc','$image')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'tamanho de imagem muito grande';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'produto adicionado com sucesso!';
         }
      }else{
         $message[] = 'produto não pôde ser adicionado!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];
   $update_desc = $_POST['update_descricao'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', descricao= '$update_desc' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'tamanho de imagem muito grande';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'MainSideBar.php'; ?>

<header class="header">

   <div class="flex">  
      <a href="admin_products.php" class="logo">produtos</a>

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

<!-- product CRUD section starts  -->

<section class="add-products">

   <h1 class="title">produtos da loja</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <h3>adicionar produto</h3>
      <input type="text" name="name" class="box" placeholder="Digite o nome do produto" required>
      <input type="number" min="0" name="price" class="box" placeholder="Digite o preço do produto" required>
      <input type="text" name="descricao" class="box" placeholder="Digite uma descrição para o produto" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="adicionar" name="add_product" class="btn">
   </form>

</section>

<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" style="height: 250px; width: 250px;">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="price">R$<?php echo $fetch_products['price']; ?></div>
         <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">atualizar</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('deletar este produto?');">deletar</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">nenhum produto foi adicionado ainda!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Digite o nome do produto">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Digite o preço do produto">
      <input type="text" name="update_desc" value="<?php echo $fetch_update['descricao']; ?>" class="box" required placeholder="Digite uma descrição para o produto">
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="atualizar" name="update_product" class="btn" style="margin-bottom: 15px;">
      <input type="reset" value="cancelar" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>







<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>