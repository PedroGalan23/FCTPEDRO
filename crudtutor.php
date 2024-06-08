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
var_dump($result);
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
    <nav aria-label="...">
      <ul class="pagination">
         <li class="page-item disabled">
            <a class="page-link">Previous</a>
         </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item active" aria-current="page">
             <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
        </ul>
    </nav>
</body>
</html>