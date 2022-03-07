<?php
session_start();

if(!isset($_SESSION['id'])){header("location: inscription.php");
}else{
  $id_mod=$_SESSION['id'];
}
$servername="localhost";
  $username="root";
  $password="1234";
  $dbname="emall";

  $conn=mysqli_connect($servername,$username,$password,$dbname);

    if( isset($_POST['submit']) ){
    $nomBoutique = $_POST['nomBoutique'];
    $categorie = $_POST['categorie'];
    $pack = $_POST['pack'];
    $dateD = $_POST['dateD'];
    $dateF = $_POST['dateF'];
    $paiement = $_POST['paiement'];
    $desc = $_POST['description'];
    
     $name = $_FILES['file']['name'];
     $target_dir = "img/";
     $target_file = $target_dir . basename($_FILES["file"]["name"]);
   
     // Select file type
     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
     // Valid file extensions
     $extensions_arr = array("jpg","jpeg","png","gif");
   
     // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
    
                // Insert record
                $sql = "INSERT INTO boutique VALUES (null,'$nomBoutique','$categorie','$pack','$dateF','$dateD','$paiement','$name','$id_mod','$desc')";
                $res1 = mysqli_query($conn,$sql);
     
                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

                header("location:boutiques.php");
              echo $nomBoutique.'|'.$categorie.'|'.$pack.'|'.$dateF.'|'.$dateD.'|'.$paiement.'|'.$name.'|'.$id_mod.'|'.$desc ;
        }
        echo $nomBoutique.'|'.$categorie.'|'.$pack.'|'.$dateF.'|'.$dateD.'|'.$paiement.'|'.$name.'|'.$id_mod.'|'.$desc ;
    }
?>