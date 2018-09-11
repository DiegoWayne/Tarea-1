<?php 
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
 	
    mysqli_next_result($Conexion);//le decimos a la conexion que va a realizar otra consulta
 	$Query = "CALL Login ('$_POST[Correo]');";//Query para hacer login
 	$Resultado = $Conexion->query($Query);//Ejecutamos el query
 	$Row = $Resultado->fetch_array(MYSQLI_ASSOC);

 	if(password_verify($_POST['Contrasena'],$Row['Usuario_Contrasena']))//validacion del Login
 	{
    	session_start();//iniciamos la variable global session para guardar informacion importante del usuario
    	$_SESSION["Session"]=true;
    	$_SESSION["ID"]=$Row['Usuario_ID'];//guardamos el id
    	$_SESSION["Perfil"]=$Row['Usuario_Perfil'];//guardamos la foto de perfil
    	$_SESSION["Portada"]=$Row['Usuario_Portada'];//guardamos la foto de portada
    	$_SESSION["Mote"]=$Row['Usuario_Mote'];//guardamos la foto de portada
    	header ("Location:http://localhost/Mercado");//redireccionamos al home
 	}
    else
	 header ("Location:http://localhost/Mercado/Login.php");//redireccionamos al login a que vuelva a intentar
 ?>