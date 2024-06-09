<?php
try {
    $pdo=new PDO('mysql:host=localhost;dbname=control_fct','root','');
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
$articulosxPagina=6;
//Contar empresas de nuestra bd utilizando el metodo rowCount que cuenta las filas de un arrray
$numeroEmpresas=$stmt->rowCount();
//echo $numeroEmpresas;
//numero de paginas totales,usamos ceil para redondear
$paginas=ceil($numeroEmpresas/$articulosxPagina);
echo $paginas;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <h1>Crud Empresa</h1>
    <?php
        if(!$_GET){
        header('Location:crudtutor.php?pagina=1');
        }
    ?>
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
        <?php echo "</tr>" ?>
    <?php endforeach ?>
    </table>

    <nav aria-label="...">
      <ul class="pagination">
         <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled':''?>">
            <a class="page-link"href="crudtutor.php?pagina=<?php echo $_GET['pagina']-1?>">Anterior</a>
         </li>
        <?php
            for($i= 0;$i<=$paginas;$i++){
                /*
                Utilizando el
                El metodo GET para active hace que si la pagina recogida por GET , es decir la página actual es igual a la página mostrada
                entonces dará como resultado 'active' lo cual es una clase de
                */
                echo '<li class="page-item' . ($_GET['pagina'] == $i + 1 ? ' active' : '') . '"><a class="page-link" href="crudtutor.php?pagina=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
            }
        ?>
        <li class="page-item <?php echo $_GET['pagina']>=$paginas ? 'disabled':''?> ">
            <a class="page-link" href="crudtutor.php?pagina=<?php echo $_GET['pagina']+1?>">Siguiente</a>
        </li>
        </ul>
    </nav>
</body>
</html>