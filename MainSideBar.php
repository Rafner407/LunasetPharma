<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">

  <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>
 
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #000000; position: fixed;">
    <!-- Brand Logo -->
    <a href="admin_page.php" class="brand-link"  style="font-size:25px;">
      <img src="AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; margin-top: 2px; margin-right: 10px;">
      <span class="brand-text font-weight-light" style=" color: var(--purple);">Lunaset </span> Admin
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div>
          <img src="AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" style="height: 30px; width: 30px; margin-left: 10px; margin-top: 5px">
        </div class="image">
        <div class="info">
          <a href="logout.php" class="d-block" style="font-size: 20px;"><?php echo $_SESSION['admin_name']; ?></a>
        </div>
      </div>

    
    <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item" style="font-size: 20px;">
            <a href="admin_page.php" class="nav-link">
              <i class="fa-solid fa-house" style="font-size: 20px;"></i>
              <p>
                início
              </p>
            </a>
          </li>

          <li class="nav-item" style="font-size: 20px;">
            <a href="admin_products.php" class="nav-link">
              <i class="fa-solid fa-basket-shopping" style="font-size: 20px;"></i>
              <p>
                produtos
              </p>
            </a>
          </li>

          <li class="nav-item" style="font-size: 20px;">
            <a href="admin_orders.php" class="nav-link">
              <i class="fa-solid fa-money-check-dollar" style="font-size: 20px;"></i>
              <p>
                pedidos
              </p>
            </a>
          </li>

          <li class="nav-item" style="font-size: 20px;">
            <a href="admin_users.php" class="nav-link">
              <i class="fa-solid fa-user" style="font-size: 20px;"></i>
              <p>
                usuários
              </p>
            </a>
          </li>

          <li class="nav-item" style="font-size: 20px;">
            <a href="admin_contacts.php" class="nav-link">
              <i class="fa-solid fa-message" style="font-size: 20px;"></i>
              <p>
                mensagens
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</body>
</html>