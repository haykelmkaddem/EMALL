<?php
session_start();
session_start();
if(!isset($_SESSION['id'])){header("location: inscription.php");
}else{
    $servername="localhost";
    $username="root";
    $password="1234";
    $dbname="emall";
  
    $conn=mysqli_connect($servername,$username,$password,$dbname);

    $idProduit = $_GET['id'];
    $idClient = $_SESSION['id'];

    $sql = "INSERT INTO cart VALUES (null,'$idProduit','$idClient')";
    $res1 = mysqli_query($conn,$sql);
    header("location:produits.php");
}
    

?>