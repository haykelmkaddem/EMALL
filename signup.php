<?php
$servername="localhost";
  $username="root";
  $password="1234";
  $dbname="emall";

  $conn=mysqli_connect($servername,$username,$password,$dbname);

    if( isset($_POST['submit']) ){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];
    $dateNaissance = $_POST['dateNaissance'];
    $pwd = $_POST['pwd'];
    $role = $_POST['role'];

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
                $sql = "INSERT INTO membre VALUES (null,'$nom','$prenom','$dateNaissance','$tel','$mail','$name','$pwd','$role')";
                $res1 = mysqli_query($conn,$sql);
                $last_id = $conn->insert_id;
                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);

                if ($role == "moderateur") {
                  session_start();
                  $_SESSION['id'] = $last_id;
                  $_SESSION['role'] = $role;
                  header("location:ajout-boutique.php");
                }else{
                  session_start();
                  $_SESSION['id'] = $last_id;
                  $_SESSION['role'] = $role;
                  header("location:index.php");
                }
                

        }
    }
?>