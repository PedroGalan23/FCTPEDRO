<?php
     $cif=$_GET["cif"];
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
    $sql="DELETE FROM empresa WHERE cif=:cif";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute([":cif"=>$cif])){
        echo "<script>alert('La empresa se eliminó correctamente'); location.href='crudtutor.php';</script>";
    }else{
        echo "<script>alert('La empresa no se eliminó correctamente'); location.href='crudtutor.php';</script>";
    } 



?>