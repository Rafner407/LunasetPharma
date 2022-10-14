<?php
    include 'config.php';
    
    session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<html>
<head>
    <title>Lunaset Produto</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3a65185406.js" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php include 'header.php'; ?>
    <!-- Produto -->
    <section class="single-product">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div id="slider" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="imagens/fundoCinza.jpg" class="d-block" height="766px">
                          </div>
                          <div class="carousel-item">
                            <img src="imagens/fundoRosa.jpg" class="d-block" height="766px">
                          </div>
                          <div class="carousel-item">
                            <img src="imagens/fundoLaranja.jpg" class="d-block" height="766px">
                          </div>
                          <div class="carousel-item">
                            <img src="imagens/fundoVermelho.jpg" class="d-block" height="766px">
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                          </button>
                      </div>
                </div>
                <div class="col-md-7">
                    <p class="new-arrival">NOVO</p>
                    <h2>Nome do produto</h2>
                    <p>Código do produto: PRC3928</p>
                    
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>

                    <p class="price">R$ 15.00</p>
                    <p><b>Disponibilidade:</b> Em estoque</p>
                    <p><b>Condição:</b> Novo</p>
                    <p><b>Marca:</b> Marca</p>
                    <label>Quantidade: </label>
                    <input type="text" value="1">
                    <button type="button" class="btn btn-primary">Adicionar ao carrinho</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Descrição do produto -->
    <section class="product-description">
        <div class="container">
            <h6>Descrição do produto</h6>
            <p>Caderno de poesias

                Caderno de poesias<br/>
                é um belo lugar.<br/>
                Tantas coisas lindas<br/>
                que eu gostaria de falar.<br/>
                Eu falo em forma de versos<br/>
                para todos poderem escutar.<br/>
                Agora você já sabe<br/>
                por que os poetas passam os dias<br/>
                escrevendo em seus cadernos de poesias.</p>

            <hr>    
        </div>
    </section>



    <?php include 'footer.php'; ?>

</body>
</html>