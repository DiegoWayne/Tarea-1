<?php 
  session_start();//contiene la informacion de session del usuario

  //Atributos para la conexion con la base de datos
  $host_db = "localhost";//sera local
  $user_db = "root";//usuario
  $pass_db = "";//contraseña del usuario
  $db_name = "Mercado";//nombre de la base de datos a usar

  //Realiza la conexion con la base de datos
  $Conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
    
  //Compureba si la conexion fue exitosa
  if ($Conexion->connect_error) 
  die("La conexion falló: " . $Conexion->connect_error);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Mercado</title>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Muchos iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Estilo Principal -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- Skins varias  -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Estilo de productos  -->
  <link rel="stylesheet" href="dist/css/Productos.css">
</head>

<!-- Tipo de de menu -->
<body class="skin-black-light fixed layout-top-nav">
<div class="wrapper">

  <header class="main-header">
  <nav class="navbar navbar-static-top">
  <div class="container">

        <div class="navbar-header">
          <a href="Index.php" class="navbar-brand"> <p style="border-style: solid; border-width:2px;"><b>El</b>Merca</p></a>
        </div>

        <!-- Menu Principal -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
             <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias<span class="caret"></span></a>
             <ul class="dropdown-menu" role="menu">
              <?php 
                  //hacemos una colsulta para obtener la informacion de las categorias
                  $Query = "CALL VerCategorias ();";//Query para acceder a las categorias
                  $Resultado = $Conexion->query($Query);//Ejecutamos el query

                  while ($Row = $Resultado->fetch_array(MYSQLI_ASSOC)) 
                  {
                    echo "<li><a href='Categoria.php?ID=$Row[Categoria_Nombre]'>".$Row['Categoria_Nombre']."</a></li>";
                  }

               ?>
             </ul>
             </li>
          </ul>
         <!-- Buscador -->
          <form class="navbar-form navbar-left" role="search">
            <!--Buscar input-->
            <div class="form-group">
            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search" >
            </div>
            <!--Buscar boton-->
            <div class="form-group">
            <button onclick="Buscar()" type="button" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </form>

         </div>

         <div class='navbar-custom-menu'>
         <ul class='nav navbar-nav'>
         <li class="dropdown messages-menu open">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="glyphicon">&#xe116;</i>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Carrito de compras</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/photo1.png"  alt="User Image">
                      </div>
                      <h4>
                        Producto
                        <small><i class="fa fa-clock-o"></i> Precio</small>
                      </h4>
                      <p>Descripcion</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="Pagar.php">Pagar</a></li>
            </ul>
          </li>
        </ul>
      </div>
         
         <!-- Usuario -->
        <?php 
        if (isset($_SESSION["Session"]) && $_SESSION["Session"]==true)
        {
        echo "<div class='navbar-custom-menu'>
                    <ul class='nav navbar-nav'>
                    <li class='user user-menu'>
                    <a href='Perfil.php' > ";
        echo       "<img src='data:image/jpeg;base64,".base64_encode($_SESSION["Perfil"])."' class='user-image' alt='User Image' >";
        echo       "<span class='hidden-xs'>$_SESSION[Mote]</span>
                    </a>
                    </li>
                    </ul>
              </div>";
        }
        else
        {
        echo "<div class='navbar-custom-menu'>
                    <ul class='nav navbar-nav'>
                    <li class='user user-menu'>
                    <a href='Login.php' > 
                    <span class='hidden-xs'>Login</span>
                    </a>
                    </li>
                    </ul>
              </div>";
        echo "<div class='navbar-custom-menu'>
                    <ul class='nav navbar-nav'>
                    <li class='user user-menu'>
                    <a href='Registro.php' > 
                    <span class='hidden-xs'>Registro</span>
                    </a>
                    </li>
                    </ul>
              </div>";
        }
         ?>

  </div>
  </nav>
  </header>

  <div class="content-wrapper">
    <!-- Contenido de la pagina-->
      <section class="content" id="Contenido">
        <!--Contenedor de los datos de usuario-->
        <div class="box box-widget widget-user">
            <!-- Informacion del usuario -->
          <div class="widget-user-header bg-black" style=" background: url(<?php echo "'data:image/jpeg;base64,".base64_encode($_SESSION["Portada"])."'"; ?>) center center;">
          </div>
          <!--Imagen de perfil-->
          <div class="widget-user-image">
            <?php echo"<img src='data:image/jpeg;base64,".base64_encode($_SESSION["Perfil"])."' class='img-circle' alt='User Avatar' >";?>
          </div>

          <div class="box-footer">
              <div class="row">
               <!--Ventas-->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">3,200</h5>
                    <span class="description-text">SALES</span>
                  </div>
                </div>

                <!-- Relleno de enmedio -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                  <h5 class="widget-user-username"><?php echo $_SESSION['Mote']; ?></h5>
                  <a class="description-text" href="AgregarProducto.php">Agregar Producto</a>
                              <a href="#"><h5 class="widget-user-desc">Editar Perfil</h5></a>

                  </div>
                </div>

                <!-- Cantidad de productos -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">35</h5>
                    <span class="description-text">  <?php echo "string";  ?></span>
                  </div>
                </div>

              </div>
            </div>
        </div>
      <!--Fin del contenedor de los datos de usuario-->

      <!--Comienza la lista de los productos del usuario-->
      <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Tus Productos</h3>
          </div>
      <!--Contenedor de los Productos-->
      <div class="box-body">
        <ul class="products-list product-list-in-box">
          <!--Lista de productos-->
            <li class="item">
            <div class="product-img">
            <img src="http://placehold.it/150x100" style="width: 150px ; height: 100px;">
            </div>
            <div class="product-info">
            <a href="#" class="product-title">Samsung TV</a>
            <a href="#"><span class="label label-info pull-right">Editar</span></a>
            <span class="label label-warning pull-right">$1800</span>
            <span class="product-description">Samsung 32" 1080p 60Hz LED Smart HDTV.</span>
            </div>
            </li>        
        </ul>
      </div>
      </div>

      </section>
  </div>

  <footer class="main-footer">
    <div class="container">
    </div>
  </footer>
</div>

<!-- jQuery 3.1.1 -->
<script src="plugins/jQuery/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!--Scrip para buscar-->
<script src="js/Buscar.js"></script>

</body>
</html>
