<?php 
  session_start();//contiene la informacion de session del usuario
  $q = intval($_GET['q']);//obtenemos la informacion a buscar
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
    <!-- Contenido de la pagina-->
   <section class="content" id="Contenido">
      <!--Titulo de la busqueda-->
      <div class="box box-primary">
           <div class="box-header with-border">
             <h3 class="box-title">Resultado de la busqueda</h3>
      </div>

      <!--Contenedor de los Productos-->
      <div class="box-body">
        <ul class="products-list product-list-in-box">
          <!--Lista de productos-->
            <li class="item">
            <div class="product-img">
            <img src="dist/img/default-50x50.gif" alt="Product Image">
            </div>
            <div class="product-info">
            <a href="javascript:void(0)" class="product-title">Samsung TV
            <span class="label label-warning pull-right">$1800</span></a>
            <span class="product-description">Samsung 32" 1080p 60Hz LED Smart HDTV.</span>
            </div>
            </li>        
        </ul>
      </div>
      </div>
      
    </section>


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
