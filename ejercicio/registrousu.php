<?php
    require_once("connections/connection.php")
?>

<?php
    $control="SELECT * from tipo_usuario WHERE id_tipo_usuario >= 2";
    $query=mysqli_query($mysqli,$control);
    $fila=mysqli_fetch_assoc($query);
?>
<?php
    $control2="SELECT * from tipo_documento";
    $query2=mysqli_query($mysqli,$control2);
    $fila2=mysqli_fetch_assoc($query2);
?>

<?php
    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
    {
        $documento= $_POST['documento'];
        $nombre=    $_POST['nombre'];
        $usuario=   $_POST['usuario'];
        $clave=     $_POST['clave'];
        $idusu=     $_POST['idusu'];
        $iddoc=     $_POST['iddoc'];

        $validar ="SELECT * FROM usuario WHERE documento='$documento' or usuario='$usuario'";
        $queryi=mysqli_query($mysqli,$validar);
        $fila1=mysqli_fetch_assoc($queryi);

       if ($fila1) {
           echo '<script>alert ("DOCUMENTO O USUARIO EXISTEN //CAMBIELOS//");</script>';
           echo '<script>windows.location="registrousu.php"</script>';
       }
        else if ($documento=="" || $nombre=="" || $usuario=="" || $clave=="" || $idusu=="" || $iddoc=="")
        {
            echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
           echo '<script>windows.location="registrousu.php"</script>';
        }

        else
        {
 $insertsql="INSERT INTO usuario(documento,nombres,usuario,password,Id_tipo_usuario,Id_tipo_documento) VALUES('$documento','$nombre','$usuario','$clave','$idusu','$iddoc')";
           mysqli_query($mysqli,$insertsql) or die(mysqli_error());
           echo '<script>alert (" Registro Exitoso, Gracias");</script>';
           echo '<script>window.location="index.html"</script>';
        }
    }
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Registro Usuario | LSMF</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body onload="form2.documento.focus()">

    <div class="login-box">
        <!--crea una caja imaginaria-->
        <img src="imagenes/logo1.png" class="avatar" alt="Avatar Image">
        <!--insertamos una imagen-->

        <h2>REGISTRO DE USUARIOS</h2>
        <!--Inserra titulo-->
        <form method="post" name="form2" autocomplete="off">
        <!--crea formularios-->
        <select name="iddoc">
            <option value="">seleccione opcion...</option>
            <?php
                do{
            ?>
                <option value="<?php echo($fila2['Id_tipo_documento'])?>"> <?php echo($fila2['tipo_documento'])?>
            <?php      
                }while($fila2=mysqli_fetch_assoc($query2));
            ?>
        </select>
        </select>
         <input type="text" name="documento" id="documento" placeholder="Ingrese Documento Identidad">
         <!-- Caja de texto donde el usuario coloca el documento de identidad -->
         <input type="text" name="nombre" id="nombre" placeholder="Ingrese Nombres Completos">
         <!-- Caja de texto donde el usuario coloca el nombre completo -->
         <input type="text" name="usuario" id="usuario" placeholder="Ingrese un Usuario">
         <!-- Caja de texto donde el usuario digite texto -->
         <input type="password" name="clave" id="password" placeholder="Ingrese Contraseña">
         <!-- caja de texto donde el usuario coloca la contraseña -->
        <!--select-->
        <select name="idusu">
            <option value="">seleccione uno...</option>
            <?php
                do{
            ?>
                <option value="<?php echo($fila['Id_tipo_usuario'])?>"> <?php echo($fila['tipo_usuario'])?>
            <?php      
                }while($fila=mysqli_fetch_assoc($query));
            ?>
        </select>

        <input type="submit" name="validar" value="Registrarme">
        <input type="hidden" name="MM_insert" value="formreg">
         <!--Crear el boton-->

         
        </form>
        

    </div>

    
</body>
</html>