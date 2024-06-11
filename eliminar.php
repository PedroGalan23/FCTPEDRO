<?php
     $id=$_GET["id"];
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


?>