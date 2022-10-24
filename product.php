<?php
    include 'config.php';
    
    session_start();

$user_id = $_SESSION['user_id'];

$query = 'SELECT * FROM products WHERE id = "'.$_GET['product'].'"';


if(!isset($user_id)){
   header('location:login.php');
}

?>

<html>
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
        <div class="container">
            <!-- Div 1 -->
            <div class="row" style="display: flex;">

            <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); max-width: 300px; margin: auto; text-align: center; font-family: arial; font-size: 20px; padding-bottom: 25px;">
                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" style="height: 300px; width: 300px;">
                <h1><?php echo $fetch_products['name']?></h1>
                <p class="price" style="color: grey; font-size: 18px;">R$<?php echo $fetch_products['price']?>,00</p>
                <p style="font-size: 15px;"><b>Disponibilidade:</b> Em estoque</p>
                <button type="button" class="btn btn-primary">Adicionar ao carrinho</button>
            </div>

                <div class="col-sm-6">
                    <h2>Descrição do produto</h2>
                    <p><?php echo $fetch_products['descricao']?></p>
                </div>

            </div>
            <!-- Div 1 -->
            </div>
        </div>
    </section>

    <!-- Descrição do produto -->
                <?php
            }
        }
            ?>


    <?php include 'footer.php'; ?>

</body>
</html>