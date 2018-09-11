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

    //Hacemos las validacion del correo y del mote
 	$Query = "CALL ComprobarUsuario ('$_POST[Correo]', 2);";//Query para Comprobar el correo
 	$Resultado = $Conexion->query($Query);//Ejecutamos el query
 	$VDC = mysqli_num_rows($Resultado);//VDC es la validacion del correo

	mysqli_next_result($Conexion);//le decimos a la conexion que va a realizar otra consulta
 	$Query = "CALL ComprobarUsuario ('$_POST[Nickname]', 1);";//Query para Comprobar el Mote
 	$Resultado = $Conexion->query($Query);//Ejecutamos el query
 	$VDM = mysqli_num_rows($Resultado);//VDC es la validacion del Mote

    //Comprovamos si el usuario puede registrarse
 	if ($VDC==0 && $VDM==0) 
 	{
 		//Comenzamos el registro del usuario.

	    //Obtenemos las imagenes y las guardamos en una variable
	    $Perfil=addslashes (file_get_contents($_FILES['Perfil']['tmp_name']));//imagen de perfil
	    $Portada=addslashes (file_get_contents($_FILES['Portada']['tmp_name']));//imagen de portada

	    //Encriptamos la contraseña
	    $Contrasena= $_POST['Contrasena'];
	    $HashContra = password_hash($Contrasena, PASSWORD_BCRYPT);

	    //Registramos
	    mysqli_next_result($Conexion);//le decimos a la conexion que va a realizar otra consulta
 		$Query = "CALL GuardarUsuario ('$_POST[Nombre]',
 		                               '$_POST[Nickname]',
 		                               '$HashContra',
 		                               '$_POST[Telefono]',
 		                               '$_POST[Calle]',
 		                               '$_POST[Numero]',
 		                               '$_POST[Postal]',
 		                               '$_POST[Estados]',
 		                               '{$Perfil}',
 		                               '{$Portada}',
 		                               '$_POST[Correo]');";//Query para registrar al usuario

 		//ejecutamos y comprobamos que el query se ejecuto correctamente
		if ($Conexion->query($Query) == TRUE) 
		{
			echo "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
			header ("Location:http://localhost/Mercado/Login.php");//redireccionamos al login
		}
		else
			echo "<h2>" . "Error al registar" . "</h2>";
  	}
  	//Si el correo o el mote ya estan registrado pues mandamos el else 
    else
    	echo "<h2>" . "Correo o Mote ya registrados" . "</h2>";
 ?>
