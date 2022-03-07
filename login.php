<?php
session_start();

//connect to database
$servername="localhost";
$username="root";
$password="1234";
$dbname="emall";
$conn=mysqli_connect($servername,$username,$password,$dbname);

//login

if(isset($_POST['loginbtn'])){
    $mail = $_POST['loginmail'];
    $mdp = $_POST['loginmdp'];

    $query = "SELECT * FROM `membre` WHERE mail='$mail' and mdp='$mdp'";
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        while ($row = mysqli_fetch_row($result)) {
            $_SESSION['id'] = $row[0];
            $_SESSION['role'] = $row[8];
        }
    if( $_SESSION['role'] == "admin" or $_SESSION['role'] == "moderateur")
    {
        $idmod = $_SESSION['id'];
        $boutique="SELECT * FROM boutique where id_mod ='$idmod'";
        $boutiques=mysqli_query($conn,$boutique);

             while ($row1 = mysqli_fetch_row($boutiques)) {
                $_SESSION['boutique'] = $row1[0];
             }

    }
        header("location:index.php");
    }else{
        echo "error";
    }
    
    
    

}
?>


