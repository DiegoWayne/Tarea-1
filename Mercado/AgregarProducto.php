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
        <!--Contenedor chido-->
          <div class="box box-primary">
            <!--titulo del contenedor-->
            <div class="box-header with-border">
              <h3 class="box-title">Agregar producto</h3>
            </div>
            <form action="scrips/GuardarProducto.php" method="post" enctype="multipart/form-data">
              <!--Contenedor del formulario-->
              <div class="box-body">
                <!-- Titulo del producto -->
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Nombre del producto" name="Nombre" required="">
                  <span class="glyphicon glyphicon-pencil form-control-feedback"></span>
                </div>
                <!--Lista de las imagenes-->
                 <ul class="mailbox-attachments clearfix">
                     <!--Formato de la primera imagen-->
                     <li>
                     <span class="mailbox-attachment-icon has-img"><img id="Img_1" src="http://placehold.it/150x100"></span>
                      <div class="mailbox-attachment-info">
                       <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i>Imagen 1</a>
                       <span class="mailbox-attachment-size">
                         <div class="btn btn-default btn-file pull-right">
                          <i> Agregar</i>
                          <input name="Imagen_1" id="Imagen_1" type="file" required="">
                         </div>
                       </span>
                      </div>
                     </li>
                    <!--Formato de la Segunda imagen-->
                    <li>
                     <span class="mailbox-attachment-icon has-img"><img id="Img_2" src="http://placehold.it/150x100"></span>
                      <div class="mailbox-attachment-info">
                       <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i>Imagen 2</a>
                       <span class="mailbox-attachment-size">
                         <div class="btn btn-default btn-file pull-right">
                          <i>Agregar</i> 
                          <input name="Imagen_2" id="Imagen_2" type="file" required="">
                         </div>
                       </span>
                      </div>
                    </li>
                    <!--Formato de la Tercera imagen-->
                    <li>
                     <span class="mailbox-attachment-icon has-img"><img id="Img_3" src="http://placehold.it/150x100"></span>
                      <div class="mailbox-attachment-info">
                       <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i>Imagen 3</a>
                       <span class="mailbox-attachment-size">
                         <div class="btn btn-default btn-file pull-right">
                          <i>Agregar</i> 
                          <input name="Imagen_3" id="Imagen_3" type="file" required="">
                         </div>
                       </span>
                      </div>
                    </li>
                    <!--Formato del video-->
                    <li>
                     <span class="mailbox-attachment-icon has-img"><video width="100%" height="100%" controls id="VideoPre"></video></span>
                      <div class="mailbox-attachment-info">
                       <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i>Video</a>
                       <span class="mailbox-attachment-size">
                         <div class="btn btn-default btn-file pull-right">
                          <i>Agregar</i> 
                          <input name="Video" id="Video" type="file" required="">
                         </div>
                       </span>
                      </div>
                    </li>
                </ul>
                <!--Control de la descripcion-->
                <textarea class="form-control" rows="3" placeholder="Descripcion del producto..." name="Descripcion" required=""></textarea>
                <div class="col-xs-6">
                          <div class="table-responsive">
                            <table class="table">
                              <tbody><tr>
                                <th style="width:50%">Precio:</th>
                                <td><input type="number" name="Precio" required=""></td>
                              </tr>
                              <tr>
                                <th>Unidades</th>
                                <td><input type="number" name="Unidades" required=""></td>
                              </tr>
                              <tr>
                                <th>Categoria</th>
                                <td>
                                 <select name="Categoria" required="">
                                  <?php
                                    mysqli_next_result($Conexion);//le decimos a la conexion que va a realizar otra consulta 
                                    //hacemos una colsulta para obtener la informacion de las categorias
                                    $Query = "CALL VerCategorias ();";//Query para acceder a las categorias
                                    $Resultado = $Conexion->query($Query);//Ejecutamos el query

                                    while ($Row = $Resultado->fetch_array(MYSQLI_ASSOC)) 
                                    {
                                      echo "<option value='$Row[Categoria_ID]' >".$Row['Categoria_Nombre']."</option>";
                                    }
                                   ?>
                                 </select>
                                </td>
                              </tr>
                            </tbody></table>
                          </div>
                </div>
                <!--Boton-->
                <button type="submit" class="btn btn-primary btn-block btn-flat">Agregar</button>
              </div>
            </form>
          </div>

      </section>

  </div>

  <footer class="main-footer">
    <div class="container">
    </div>
  </footer>
</div>

<!-- jQuery 3.1.1 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
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
<!--Scrip para previzualisar las imagenes-->
 <script src="js/CargarImagen.js"></script>


</body>
</html>

