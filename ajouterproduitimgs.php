<?php
$servername="localhost";
$username="root";
$password="1234";
$dbname="emall";

$conn=mysqli_connect($servername,$username,$password,$dbname);
$target_dir = "img/";
if (isset($_POST['ajouterImgsBtn'])) {
    $id_produit = $_POST['prductId'];
      //multiple files
      $filesCount =  count($_FILES['file']['name']);
      for ($i=0; $i < $filesCount ; $i++) { 
        $fileName = $_FILES['file']['name'][$i];
        $sql2 = "insert INTO produit_img VALUES (null,'$fileName','$id_produit')";
        mysqli_query($conn,$sql2);
        move_uploaded_file($_FILES['file']['tmp_name'][$i],$target_dir.$fileName);

      }



}

    



?>