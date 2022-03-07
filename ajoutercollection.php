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
    $nomCollection = $_POST['nomCollection'];
    $id_boutique = $_SESSION['boutique'];
    $pour = $_POST['pour'];
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
                $sql = "INSERT INTO collection VALUES (null,'$nomCollection','$name','$pour','$id_boutique')";
                $res1 = mysqli_query($conn,$sql);

                $query = "SELECT * FROM collection order by id desc";
                $res2 = mysqli_query($conn,$query);
                $row = mysqli_fetch_array($res2);
                
                $last_id = $row[0];
                

                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

                for ($i=1; $i <5 ; $i++) { 
                  $product = $_POST['produit'.$i];
                  $sql2 = "INSERT INTO collection_produits VALUES (null,'$last_id','$product')";
                  $res3 = mysqli_query($conn,$sql2);
                }


        }
    }

?>