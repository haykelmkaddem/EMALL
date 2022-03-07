<?php
session_start();
$id=$_SESSION['id'];



$servername="localhost";
$username="root";
$password="1234";
$dbname="emall";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(isset($_POST['updateinfo'])){

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$dateNaissance = $_POST['dateNaissance'];
$tel = $_POST['tel'];
$mail = $_POST['mail'];

$sql = "UPDATE membre
SET nom='$nom', prenom='$prenom' , datenaissance='$dateNaissance', tel= '$tel', mail='$mail'
WHERE id='$id' ";

$res1 = mysqli_query($conn,$sql);

header("location:profile.php");
}

if(isset($_POST['updatemdp'])){
    $mdp = $_POST['pwd'];
    $mdpi = $_POST['pwdi'];
    $userinfo="SELECT * FROM membre where id = '$id'";
    $info=mysqli_query($conn,$userinfo);
     while ($row = mysqli_fetch_array($info)){
        $mdp1 = $row[7];
     }
    echo "1- mdp".$mdp."mdp1".$mdp1."mdpi".$mdpi."id".$id;
    if($mdpi == $mdp1)
    {
        echo "2- mdp".$mdp."mdp1".$mdp1."mdpi".$mdpi."id".$id;

        $sql = "UPDATE membre
        SET mdp='$mdp'
        WHERE id='$id' ";
        $res1 = mysqli_query($conn,$sql);
        header("location:mdp.php");

    }
    
    }


?>


