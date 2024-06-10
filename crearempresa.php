

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

    <link rel="stylesheet" type="text/css" href="crear.css">
    <title>Document</title>
</head>
<body>
    <h1>Crear nueva Empresa</h1>
    <form action="crearempresa.php" method="POST">
        <a href="crudtutor.php"><i class="bi bi-x-lg bi-3x"></i></a>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre">
        
        <label for="cif">Cif:</label>
        <input type="text" name="cif">
        
        <label for="nombre_fiscal">Nombre Fiscal:</label>
        <input type="text" name="nombre_fiscal">
        
        <label for="email">Email:</label>
        <input type="text" name="email">
        
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion">
        
        <label for="localidad">Localidad:</label>
        <input type="text" name="localidad">
        
        <label for="provincia">Provincia:</label>
        <input type="text" name="provincia">
        
        <label for="numero_plazas">Numero de Plazas:</label>
        <input type="text" name="numero_plazas">
        
        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono">

        <label for="persona_contacto">Persona de Contacto:</label>
        <input type="text" name="persona_contacto">

        <input type="submit" name="crear" value="Crear">
        <?php
  $host = 'localhost';
  $dbname = 'control_fct';
  $user = 'root';
  $pass = '';
        $nombre = $_POST["nombre"] ?? null; 
        $nombre_fiscal = $_POST["nombre_fiscal"] ?? null; 
        $email = $_POST["email"] ?? null; 
        $direccion = $_POST["direccion"] ?? null; 
        $localidad = $_POST["localidad"] ?? null; 
        $provincia = $_POST["provincia"] ?? null; 
        $numero_plazas = $_POST["numero_plazas"] ?? null; 
        $telefono = $_POST["telefono"] ?? null; 
        $persona_contacto = $_POST["persona_contacto"] ?? null; 
  try {
  if(isset($_POST['crear'])){
    if(empty($_POST['nombre'])){
        echo '<div class="error"> El campo del identificador esta vacío</div>';
    }else{
        $cif = $_POST["cif"]; 
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="INSERT INTO empresa (nombre, cif, nombre_fiscal, email, direccion, localidad, provincia, numero_plazas, telefono, persona_contacto)
        SELECT '$nombre', '$cif', '$nombre_fiscal', '$email', '$direccion', '$localidad', '$provincia', '$numero_plazas', '$telefono', '$persona_contacto'
        FROM dual
        WHERE NOT EXISTS (
            SELECT * FROM empresa WHERE nombre = '$nombre'
        )";
        /* Where not exists se utiliza para comprobar que la clave primaria no se duplique y por lo tanto salte un error.
            Dual se utiliza en una consulta donde no hay que acceder a ninguna tabla en específico, como esta
            donde cogemos las variables de nuestro codigo php.
        */
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount()> 0) {
            echo "<script>alert('La empresa [$nombre] se creó correctamente'); location.href='crudtutor.php';</script>";
        }else{
            echo "<script>alert('La empresa [$nombre] no se creó correctamente'); location.href='crearempresa.php';</script>";
        }
    }
  }

  } catch(PDOException $e) {
    echo "Ha ocurrido un error en la conexion";
    }
?>
    </form>



</body>
</html>