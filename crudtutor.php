<?php
session_start();
 //echo $_SESSION["id"];
if(empty($_SESSION["id"])){
    header("location:login.php");
}else{
    //echo" BIEN";
}
try {
    $pdo=new PDO('mysql:host=localhost;dbname=control_fct','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  //  echo 'conexión completada con exito';
} catch (PDOException $e) {
    echo "Ha ocurrido un error en la conexión a la bd";
}
//Llamada a todos los artículos
$sql='SELECT * FROM empresa';
$stmt = $pdo->prepare($sql);
$stmt->execute();
//Se guardan todos los resultados de la base de datos
$result = $stmt->fetchAll();
//Para comprobar que todo esté correcto usaremos var_dump que mostrará todos los elementos del array
//var_dump($result);
//El array mostrado en con var_dump vamos a mostrarlo en la tabla
/*
si el valor ha sido enviar mediante un formulario por el metodo get y por lo tanto existe su valor, se recoge en la variable
*/
$empresasxPagina = isset($_GET['num_articulos']) ? $_GET['num_articulos'] : 10; 
//Contar empresas de nuestra bd utilizando el metodo rowCount que cuenta las filas de un arrray
$numeroEmpresas=$stmt->rowCount();
//echo $numeroEmpresas;
//numero de paginas totales,usamos ceil para redondear
$paginas=ceil($numeroEmpresas/$empresasxPagina);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="crudtutor.css">
    <!---Función JAVASCRIPT para confirmar la eliminación de una empresa-->
    <script type="text/JAVASCRIPT">
        function confirmar() {
            //La función confirm se utiliza para mostrar un mensaje de aceptar o cancelar, devolverá el valor segun la elección
            return confirm('¿Estas seguro?, la empresa se eliminará');
        }
    </script>
    

</head>
<body>
    
        <div class="principal">
        <h1>Crud Empresa</h1>
        <a href="cerrarsesion.php"><button>Cerrar Sesion</button></a>
        </div>                                                                                                                                                                                          <br>
    <?php
        $nombre='%';
        //Controlar el error de la página
        $navVisible=true;
        if(isset($_GET['enviar']) && !empty($_GET['busqueda'])){
            $navVisible = !$navVisible;
            $nombre=$_GET['busqueda'];
            $sql='SELECT * FROM empresa WHERE nombre LIKE :nombre';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':nombre'=>$nombre]);
            $result = $stmt->fetchAll();
        }else{
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $inicio_empresas=($pagina - 1) * $empresasxPagina;
        $sql_empresas='SELECT * FROM empresa ORDER BY cif LIMIT :inicio,:nempresas';
        $stmt = $pdo->prepare($sql_empresas);
        //Evitar inyección .alternativa bind param o ponerlo directamente en la consulta
        /*
        $stmt->execute([
            ':inicio'=>$inicio_empresas,
            ':nempresas'=>$empresasxPagina]);
            */
        //bindParam 
        $stmt->bindParam(':inicio', $inicio_empresas, PDO::PARAM_INT);
        $stmt->bindParam(':nempresas', $empresasxPagina, PDO::PARAM_INT);
        $stmt->execute(); 
        $result = $stmt->fetchAll();
        }
    ?>
    
    <div class="principal">
    <div class="secundario">
        <a href="crearempresa.php"><button>Crear Empresa</button></a>
        <form action="crudtutor.php" method="GET">
            <label for="busqueda">Filtro:</label>
            <input type="text" name="busqueda" placeholder="Nombre">
            <input type="submit" name="enviar" value="Buscar">
        </form>
        <form action="crudtutor.php" method="GET">
            <label for="num_articulos">Artículos por Página:</label>
            <select name="num_articulos" >
                <option value="5"<?php if($empresasxPagina==5){echo 'selected';}?>>5</option>
                <option value="10" <?php if($empresasxPagina==10){echo 'selected';}?>>10</option>
                <option value="15" <?php if($empresasxPagina==15){echo 'selected';}?>>15</option>
            </select>
            <input type="hidden" name="pagina" value="<?php echo "$pagina" ?>">
            <input type="submit" value="Actualizar">
        </form>
        

    </div>
    <table>
    <tr>
            <th>Nombre</th>
            <th>Cif</th>
            <th>Nombre_fiscal</th>
            <th>Email</th>
            <th>Direccion</th>
            <th>Localidad</th>
            <th>Provincia</th>
            <th>Numero_plazas</th>
            <th>Telefono</th>
            <th>Persona_contacto</th>
            <th ></th>
            <th></th>
    </tr>    
    <?php foreach( $result as $empresa ): ?>
        <?php echo "<tr>" ?>
        <?php echo "<td>".$empresa['nombre']."</td>" ?>
        <?php echo "<td>".$empresa['cif']."</td>" ?>
        <?php echo "<td>".$empresa['nombre_fiscal']."</td>" ?>
        <?php echo "<td>".$empresa['email']."</td>" ?>
        <?php echo "<td>".$empresa['direccion']."</td>" ?>
        <?php echo "<td>".$empresa['localidad']."</td>" ?>
        <?php echo "<td>".$empresa['provincia']."</td>" ?>
        <?php echo "<td>".$empresa['numero_plazas']."</td>" ?>
        <?php echo "<td>".$empresa['telefono']."</td>" ?>
        <?php echo "<td>".$empresa['persona_contacto']."</td>" ?>
        <?php echo '<td><a href="modificarempresa.php?cif=' . $empresa["cif"] . '"><i class="bi bi-pen"></i></a></td>'; ?>
        <?php echo '<td><a href="eliminar.php?cif='. $empresa["cif"].'" onclick="return confirmar()"><i class="bi bi-trash"></i></a></td>'; ?>
        <?php echo "</tr>" ?>
    <?php endforeach ?>
    </table>

    <nav aria-label="..." <?php if(!$navVisible) echo 'style="display:none;"'; ?>>
      <ul class="pagination" >
        <li class="page-item <?php echo $pagina<=1 ? 'disabled':''?>" >
            <a class="page-link" href="crudtutor.php?pagina=1 &num_articulos=<?php echo $empresasxPagina; ?>"><<</a>
        </li>
         <li class="page-item <?php echo $pagina<=1 ? 'disabled':''?>">
            <a class="page-link"href="crudtutor.php?pagina=<?php echo $pagina-1?> &num_articulos=<?php echo $empresasxPagina; ?>"><</a>
         </li>
         <li class="page-item active">
            <a class="page-link" href="#"><?php echo $pagina?></a>
         </li>
        <li class="page-item <?php echo $pagina>=$paginas ? 'disabled':''?> ">
            <a class="page-link" href="crudtutor.php?pagina=<?php echo $pagina+1?> &num_articulos=<?php echo $empresasxPagina; ?> ">></a>
        </li>
        <li class="page-item <?php echo $pagina>=$paginas ? 'disabled':''?> ">
            <a class="page-link" href="crudtutor.php?pagina=<?php echo $paginas ?>&num_articulos=<?php echo $empresasxPagina; ?>">>></a>
        </li>
        </ul>
    </nav>
    </div>
</body>
</html>