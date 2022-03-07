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
    $nomArticle = $_POST['nomArticle'];
    $categorie = $_POST['categorie'];
    $pour = $_POST['pour'];
    $prix = $_POST['prix'];
    $desc = $_POST['description'];
    $id_boutique = $_SESSION['boutique'];
     $name = $_FILES['file']['name'];
     $target_dir = "img/";
     $target_file = $target_dir . basename($_FILES["file"]["name"]);
     /* 
      //multiple files
      $filesCount =  count($_FILES['file2']['name']);
      for ($i=0; $i < $filesCount ; $i++) { 
        $fileName = $_FILES['file2']['name'][$i];
        $sql2 = "insert INTO produit_img VALUES (null,'$fileName','$id_produit')";
        mysqli_query($conn,$sql2);
        move_uploaded_file($_FILES['file2']['tmp_name'][$i],$target_dir.$fileName);

      }
*/
     // Select file type
     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
     // Valid file extensions
     $extensions_arr = array("jpg","jpeg","png","gif");
   
     // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
    
                // Insert record
                $sql = "INSERT INTO produit VALUES (null,'$nomArticle','$pour','$categorie','$prix','$desc','$name','$id_boutique')";
                $res1 = mysqli_query($conn,$sql);
     
                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

                header("location:index.php");

        }
    }
?>