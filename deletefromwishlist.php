<?php
session_start();
$id=$_GET['id'];
$servername="localhost";
  $username="root";
  $password="1234";
  $dbname="emall";
  $conn=mysqli_connect($servername,$username,$password,$dbname);

  

    $id = $_GET['id'];

    $sql = "DELETE FROM wishlist
    WHERE id='$id' ";
    $res1 = mysqli_query($conn,$sql);


    header("location:wishlist.php");
    
?>