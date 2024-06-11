

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
    <?php 
     $host='localhost';
     $dbname='control_fct';
     $user='root';
     $pass='';
    try{
        $pdo=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Ha ocurrido un error en la conexión";
    }

    if(isset($_POST['modificar'])){
        //Lo que pasará cuando enviemos el formulario editado
    }else{
        //Lo que pasará cuando no se presione, es decir mostrar información actual de la empresa seleccionada
        $cif=$_GET['cif'];
        //echo $cif; verificado
    }
    
    ?>



    <h1>Modificar Empresa</h1>
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

        <label for="modificar"></label>
        <input type="submit" name="modificar" value="Guardar Cambios">
        </form>    
</body>