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
    <input type="password" name="password" placeholder="Contraseña">
    <input id="submit" type="submit" name="inicioEnviar" value="Iniciar Sesion">
    <?php
        $host='localhost';
        $dbname='control_fct';
        $user='root';
        $pass='';
        try{
            //isset devuelve true si la variable incioEnviar está definida en el array Post y no es null
         if(isset($_POST["inicioEnviar"])){
            if(empty($_POST["usuario"]) || empty($_POST["password"])){
                echo'<div class="bad">Alguno de los campos está vacío</div>';
            }else{
                $pdo=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $usuario=$_POST["usuario"];
                $password=$_POST["password"];
                //Diferenciación del alumno
                //los ? son indicadores de posición de los valores para los que se va a ejecutar la consulta
                $sql_alumno="SELECT * FROM alumno WHERE nombre=? AND password=? ";
                $stmt_alumno = $pdo->prepare($sql_alumno);
                $stmt_alumno->execute([$usuario,$password]);
                if($stmt_alumno->rowCount()> 0){
                 header("location:dashboardAlumno.php");
                }
                $sql_tutor="SELECT * FROM tutor where nombre=? AND password=?";
                $stmt_tutor = $pdo->prepare($sql_tutor);
                $stmt_tutor->execute([$usuario,$password]);
                if($stmt_tutor->rowCount()> 0){
                    header("location:crudtutor.php");
                }
            }
         }
         }catch(PDOException $e){
            echo "Se ha producido un error al intentar conectar el servidor SQL";
            }

    ?>
    </form>
</body>
</html>