<?php
    include 'config.php';
    
    session_start();

$user_id = $_SESSION['user_id'];

$query = 'SELECT * FROM products WHERE id = "'.$_GET['product'].'"';


if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'produto já adicionado!';
    }else{
       mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'produto adicionado ao carrinho!';
    }
 
 };

?>

<html style="background-color: #BC89E1">
<head>
    <title>Lunaset Produto</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/3a65185406.js" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php include 'header.php'; ?>
    <!-- Produto -->
    
<?php    
$select_products = mysqli_query($conn, $query) or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
                ?>
    <section class="single-product">
        <div class="container" style="align: center; margin-top: 150px;">
            <!-- Div 1 -->

            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); max-width: 600px; margin: auto; text-align: center; font-family: arial; font-size: 20px; padding-bottom: 25px; background-color: white;">
            <div class="row" style="display: flex;">
            <div class="col-sm-6">
                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" style="height: 300px; width: 300px;">
                <h1><?php echo $fetch_products['name']?></h1>
                <p class="price" style="color: grey; font-size: 18px;">R$<?php echo $fetch_products['price']?>,00</p>
                <p style="font-size: 15px;"><b>Disponibilidade:</b> Em estoque</p>
            </div>
            <div class="col-sm-6" style="margin-top: 10px;">
                    <h4 style="color: #6A6A6A; text-align: left;">Descrição do produto</h4>
                    <p style="text-align: left; padding-right: 10px; font-size: 15px; margin-top: 15px; color: grey;"><?php echo $fetch_products['descricao']?></p>
                    <form action="" method="post" class="row" style="position: absolute; top: 580; bottom: 0; left: 880;">
                <input type="submit" class="btn" value="adicionar" name="add_to_cart" style="width: 50%;">
                <input type="number"  class="qty" name="product_quantity" min="1" value="1" style="width: 20%; padding:1.2rem 1.4rem; border-radius: .5rem; border:var(--border); margin:1rem 0; font-size: 2rem; height: 41px;">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                </form>
            </div>
            <!-- Div 1 -->
            </div>
        </div>
        </div>
    </section>

    <!-- Descrição do produto -->
                <?php
            }
        }
            ?>



</body>
</html>