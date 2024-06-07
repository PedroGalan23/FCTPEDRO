<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="estilolog.css">
</head>
<body>
    <form method="POST">
    <img src="logo__.svg" alt="Logo mal">
    <h1>Inicio de Sesión</h1>
    <input type="text" name="usuario" placeholder="Nombre">
    <input type="password" name="contraseña" placeholder="Contraseña">
    <?php
        $host='localhost';
        $dbname='control_fct';
        $user='root';
        $pass='';
        try{
         //verifica que en el array POST no está vacío y que el índice inicioEnviar se encuentra en el osea que el boton se ha puldado en el formulario
         if(!empty($_POST['inicioEnviar'])){
                $pdo=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
              $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

         }

         }catch(PDOException $e){
            echo "Se ha producido un error al intentar conectar el servidor SQL";
        }

    ?>
    <input id="submit" type="submit" name="inicioEnviar" value="Iniciar Sesion">
    </form>
</body>
</html>