<?php
 $host ="localhost";
 $user ="root";
 $pass ="";
 $db="social-brand";

//funcion llamada conexion con (dominio,usuarios,contraseña,base_de_datos)
$con = mysqli_connect($host,$user,$pass,$db)or die("Problemas al Conectar");
mysqli_select_db($con,$db)or die("problemas al conectar con la base de datos");
;

session_start();
$usuario = $_SESSION['usuario'];
$nombre = $_SESSION['nombre'];
/*hello*/

if(!isset($_SESSION['id'])){
  header("Location: ../index.php");
  }
 ?>


<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="../css/desarrollador.css">
   <title>Desarrollador/a</title>

 </head>

  <body>
    <div class="inicio">
      <a  class="cerrar_sesion" width="50" height="40"  href="../php/logout.php">Cerrar sesión</a>
    </div>


    <h1>Bienvenid@ <?php echo $nombre?></h1>

    <form class="lista_pedidos" action="../php/modificar.php" method="POST">

    <div class="text_pedido_container">
        <h2>Modificar pedido</h2>
      <div class="pedido_container">
          <p>ID del pedido:
                <select name="id_pedido" required>
                  <?php
                  // $sql="SELECT * from pedido";
                  //$sql2 = "SELECT id_pedido, disenador_preferencia, correo_usuario  FROM pedido WHERE disenador_preferencia= '$nombre'";
                  $sql2 = "
                  SELECT
                    pedidos.id_pedido
                      ,contactoDisenador.EMAIL_PRINCIPAL disenador
                      ,contactoCliente.EMAIL_PRINCIPAL cliente
                  FROM
                    ped_pedidos 		pedidos
                      ,usu_usuario		usuario
                      ,usu_usuario		desarrollador
                      ,usu_contacto		contactoCliente
                      ,usu_contacto		contactoDisenador
                  WHERE
                    pedidos.ID_CLIENTE = usuario.ID_USUARIO
                  AND pedidos.ID_DISENADOR = desarrollador.ID_USUARIO
                  AND usuario.ID_USUARIO = contactoCliente.ID_USUARIO
                  AND desarrollador.ID_USUARIO = contactoDisenador.ID_USUARIO
                  AND usuario.ID_TIPOUSUARIO = 3
                  AND desarrollador.ID_TIPOUSUARIO = 2
                  AND contactoDisenador.EMAIL_PRINCIPAL = '$usuario'
                  ";
                  $result2=mysqli_query($con,$sql2);
                  $num2 = $result2->num_rows;
                  if($num2>0){
                  while ($mostrar2=mysqli_fetch_array($result2)) {
                   ?>
                        echo '<option><?php echo $mostrar2['id_pedido'];?></option>';
                   <?php
                    }
                    ?>
                  <!-- </option> -->
                  <?php
                }else{
                        echo '<script language="javascript">alert("No hay pedidos asignados");</script>';
                        // echo $num;
                          }

                   ?>


                </select>
             </p>

          <p>Estado del pedido
                <select name="estado" required>
                    <option value="COMPLETADO">Completado</option>
                    <option value="CANCELADO">Cancelado</option>
                    <option value="PENDIENTE">Pendiente</option>
                </select>
              </p>

          <p>Agregar comentario:
            <input type="text" name="comentarios_desarrollador">
          </p>

          <p>Link:
            <input type="text" name="link">
          </p>

          <p>Valor:
            <input type="text" name="valor">
          </p>


    </p>
            <div class="modificar_container">
          <input type="submit" name="register" value="Modificar" onclick="confirmacion()">
                    <script language="JavaScript">
                         function confirmacion(){
                             alert("Pedido actualizado");
                         }
                     </script>
        </div>
    </div>
  </div>

  </form>


      <div class="lista_pendientes">
          <h2>Lista de pedidos pendientes</h2>

          <table class="tabla_pedidos">
                    <tr>
                    <td>Id pedido</td>
                    <td>Fecha</td>
                    <td>Tipo de trabajo</td>
                    <td>Diseñador</td>
                    <td>Usuario</td>
                    <td>Comentarios pedido</td>
                    <td>Comentarios desarrollador</td>
                    <td>Estado</td>
                    <td>Link</td>
                    <td>Valor</td>
                    </tr>
                    <?php
                    // $sql="SELECT * from pedido";
                   /* $sql = "SELECT id_pedido, fecha, tipo_trabajo, disenador_preferencia, comentarios_pedido, comentarios_desarrollador, estado, link, valor, correo_usuario
                    FROM pedido WHERE disenador_preferencia= '$nombre'";*/
                      $sql = "
                      SELECT
                        pedidos.id_pedido
                        ,pedidos.fecha
                        ,tipo.TIPOTRABAJO tipo_trabajo
                        ,concat(desarrollador.primer_nombre,' ',desarrollador.primer_apellido,' ',desarrollador.segundo_apellido) disenador
                        ,contacto.EMAIL_PRINCIPAL cliente
                        ,pedidos.COMENTARIO_PEDIDO comentario_pedido
                        ,pedidos.COMENTARIO_DESARROLLO comentario_desarrollador
                        ,estado.estado
                        ,pedidos.link
                        ,pedidos.valor
                    FROM
                        ped_pedidos 		pedidos
                        ,ped_estado 		estado
                        ,ped_tipotrabajo	tipo
                        ,usu_usuario		usuario
                        ,usu_usuario		desarrollador
                        ,usu_contacto		contacto
                    WHERE
                      pedidos.ID_ESTADO = estado.ID_ESTADO
                    AND pedidos.ID_TIPOTRABAJO = tipo.ID_TIPOTRABAJO
                    AND pedidos.ID_CLIENTE = usuario.ID_USUARIO
                    AND pedidos.ID_DISENADOR = desarrollador.ID_USUARIO
                    AND usuario.ID_USUARIO = contacto.ID_USUARIO
                    AND usuario.ID_TIPOUSUARIO = 3
                    AND desarrollador.ID_TIPOUSUARIO = 2
                      ";

                    $result=mysqli_query($con,$sql);
                    $num = $result->num_rows;
                    if($num>0){
                    while ($mostrar=mysqli_fetch_array($result)) {
                     ?>
                        <tr>
                          <td><?php echo $mostrar['id_pedido']?></td>
                          <td><?php echo $mostrar['fecha']?></td>
                          <td><?php echo $mostrar['tipo_trabajo']?></td>
                           <!-- remover cuando tenga bien hecho el condicional -->
                          <td><?php echo $mostrar['disenador']?></td>
                          <td><?php echo $mostrar['cliente']?></td>
                          <td><?php echo $mostrar['comentario_pedido']?></td>
                          <td><?php echo $mostrar['comentario_desarrollador']?></td>
                          <td><?php echo $mostrar['estado']?></td>
                          <td><?php echo $mostrar['link']?></td>
                          <td><?php echo $mostrar['valor']?></td>
                        </tr>
                     <?php
                      }
                      ?>
                    </table>
                    <?php
                  }else{
                          echo "Buen trabajo NO existen pedidos pendientes";
                          // echo $num;
                        }

                     ?>

  </body>

</html>
