<?php
 //conectamos Con el servidor
 $host ="localhost";
 $user ="root";
 $pass ="";
 $db="socialbrand";


 $con = mysqli_connect($host,$user,$pass,$db)or die("Problemas al Conectar");
 mysqli_select_db($con,$db)or die("problemas al conectar con la base de datos");
 session_start();


 $id_pedido=$_POST['id_pedido'];
 $estado =$_POST['estado'];
 $comentarios_desarrollador =$_POST['comentarios_desarrollador'];
 $link=$_POST['link'];
 $valor = $_POST['valor'];
 $estado = $_POST['estado'];

 $sqlEstado = "SELECT id_estado FROM ped_estado WHERE estado = '$estado'";

 $resultEstado = mysqli_query($con,$sqlEstado);

 $extraeEstado=mysqli_fetch_array($resultEstado);

 $idEstado = $extraeEstado['id_estado'];

 $sql="UPDATE ped_pedidos SET comentario_desarrollo = '$comentarios_desarrollador', link = '$link', valor = '$valor', id_estado = $idEstado WHERE id_pedido = '$id_pedido'";
 
 //ejecutamos la sentencia de sql
 
 $ejecutar=mysqli_query($con,$sql);

 

 if(!$ejecutar){
  echo"Hubo Algun Error";
  echo $id_pedido;
  echo "--";
  echo $estado;
  echo "--";
  echo $comentarios_desarrollador;
  echo "--";
  echo $link;
 }else{
     header("Location: ../pages/desarrollador.php");
 //echo $estado;
 //echo $_POST['estado'];

 // echo $id_pedido;
 // echo "--";
 // echo $estado;
 // echo "--";
 // echo $comentarios_desarrollador;
 // echo "--";
 // echo $link;
 //echo '<script language="javascript">alert("Datos Modificados Correctamente");</script>';
 //header("Location: ../pages/desarollador.php");
 }
?>
