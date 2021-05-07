<?php
 //conectamos Con el servidor
 $host ="localhost";
 $user ="id15475417_root";
 $pass ="Colombia2020+";
 $db="id15475417_social_brand";

 //funcion llamada conexion con (dominio,usuarios,contraseña,base_de_datos)
 $con = mysqli_connect($host,$user,$pass,$db)or die("Problemas al Conectar");
 mysqli_select_db($con,$db)or die("problemas al conectar con la base de datos");


 //recuperar las variables
 $usuario= $_POST['correo']; // PK EMAIL
 $password=$_POST['contrasena'];
 $pass_c = sha1($password);
 $nombre=$_POST['nombre'];
 $tipo_usuario= 3;
 $tipo_documento=$_POST['tipo_documento'];
 $documento=$_POST['documento'];
 $telefono_fijo=$_POST['telefono_fijo'];
 $celular=$_POST['celular'];
 /*ok*/


 //hacemos la sentencia de sql
 $sql="INSERT INTO usuarios VALUES(NULL,
                                   '$usuario',
                                   '$pass_c',
                                   '$nombre',
                                   '$tipo_usuario',
                                   '$tipo_documento',
                                   '$documento',
                                   '$telefono_fijo',
                                   '$celular')";


 $ejecutar=mysqli_query($con,$sql);
 //verificamos la ejecucion
 if(!$ejecutar){
  echo"Hubo Algun Error";
  echo mysqli_query($con,$sql);
  echo $ejecutar;
 }else{
    header("Location: ../index.php");
    echo '<script language="javascript">alert("Datos Guardados Correctamente");</script>';
  // echo"Datos Guardados Correctamente<br><a href='../index.html'>Volver</a>";
 }
?>