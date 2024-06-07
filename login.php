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
    <input id="submit" type="submit" name="inicioEnviar" value="Iniciar Sesion">
    <?php
        $host='localhost';
        $dbname='control_fct';
        $user='root';
        $pass='';
        try{
            //isset devuelve true si la variable incioEnviar está definida en el array Post y no es null
         if(isset($_POST["inicioEnviar"])){
            if(empty($_POST["usuario"]) || empty($_POST["contraseña"])){
                echo'<div class="bad">Los campos están vacíos</div>';
            }else{
                $pdo=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
         }

         }catch(PDOException $e){
            echo "Se ha producido un error al intentar conectar el servidor SQL";
            }

    ?>
    </form>
</body>
</html>