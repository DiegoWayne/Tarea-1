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
  
  //creamos la ruta donde estara el archivo y lo nombremos de manera que no pueda haber videos con la misma ruta
  $VideoNombre="../Videos/".uniqid().$_FILES['Video']['name']; 
  
  //Copiamos el video en el servidor
  copy($_FILES['Video']['tmp_name'],$VideoNombre);
  
  //Obtenemos las imagenes y las guardamos en una variable
  $Imagen_1=addslashes (file_get_contents($_FILES['Imagen_1']['tmp_name']));//imagen 1
  $Imagen_2=addslashes (file_get_contents($_FILES['Imagen_2']['tmp_name']));//imagen 2
  $Imagen_3=addslashes (file_get_contents($_FILES['Imagen_3']['tmp_name']));//imagen 3

  $Query="Call GuardarArticulo('$_POST[Nombre]',
                               '$_POST[Categoria]',
                                $_SESSION[ID],
                                $_POST[Precio],
                                $_POST[Unidades],
                                '{$Imagen_1}',
                                '{$Imagen_2}',
                                '{$Imagen_3}',
                                '$VideoNombre',
                                '$_POST[Descripcion]')";
   
  //ejecutamos y comprobamos que el query se ejecuto correctamente
  if ($Conexion->query($Query) === TRUE) 
     {
    	header ("Location:http://localhost/Mercado");//redireccionamos al home
	 }
?>