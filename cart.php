<?php
session_start();
if(!isset($_SESSION['id'])){header("location: inscription.php");
}
$servername="localhost";
$username="root";
$password="1234";
$dbname="emall";
$conn=mysqli_connect($servername,$username,$password,$dbname);

$idClient = $_SESSION['id'];
$cart="SELECT * FROM cart where id_client ='$idClient'";   
$cartList=mysqli_query($conn,$cart);

  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($cartList);

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to EMALL</title>
    <link href="sass/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    
    <script src="jquery/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </head>

  <body>
 <!-- modal -->
<form action="login.php" method="POST">
  <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <input type="email" id="defaultForm-email" placeholder="Adresse email" name="loginmail" class="form-control emall-input validate">
        </div>

        <div class="md-form mb-4">
          <input type="password" id="defaultForm-pass" name="loginmdp" placeholder="mot de passe" class="form-control emall-input validate">
        </div>
        <a href="inscription.php" class="text-danger" style="float: right; right: 10px; bottom: 5px; position: absolute;">créer un compte</a>
      </div>

     

      <div class="modal-footer d-flex justify-content-center">
        <input type="submit" name="loginbtn" value="Login" class="btn btn-emall-top-left-rounded">
      </div>
    </div>
  </div>
</div>
</form>

  <!-- modal -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <a class="navbar-brand" href="#">
        <img src="img/logo.png" alt="" height="50px" loading="lazy">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="boutiques.php">Boutiques</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="produits.php">Prouduits</a>
        </li>
        <li class="nav-item">
          <?php if(isset($_SESSION['id']) and isset($_SESSION['role'])){ ?>
            <div class="dropdown">
                <a href="" class="nav-link text-primary ml-5 btn-rounded mb-4 dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fas fa-user-alt"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="profile.php">profile</a>
                  <?php if($_SESSION['role'] == 'moderateur' or $_SESSION['role'] == 'admin'){ ?>
                    <?php if(isset($_SESSION['boutique'])){ ?>
                  <a class="dropdown-item" href="shop.php?id=<?php echo  $_SESSION['boutique']; ?>">Boutique</a>
                  <?php }
                else{ ?>
                  <a class="dropdown-item" href="ajout-boutique.php">Boutique</a>
                  <?php
                }
                } ?>                 
                  <a class="dropdown-item" href="logout.php">Se deconnecter</a>
                </div>
            </div>
          <?php }else { ?>
          <a href="" class="nav-link text-primary ml-5 btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-user-alt"></i></a>
          <?php } ?> 
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-primary" href="#"><i class="fas fa-map-marker-alt"></i></a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="search-input" type="search" placeholder="RECHERCHER" aria-label="Search">
      </form>
    </div>
  </nav>
	<div class="container product-info-page">
  <nav class="categories-navbar">
          <div class="categories-nav pt-5 pb-5">
            <ul class="pb-5 text-primary font-weight-bold">
              <li> <button id="categories-btn" class="btn-emall-top-left-rounded bg-primary">Categories >>></button></li>
              <ul class="d-none pb-5" id="categories-nav" style="box-shadow: 0 4px 2px -2px gray;">
                <li><a href="boutiques.php?categorie=vetement" class="ml-5">Vetements</a></li>
                <li><a href="boutiques.php?categorie=meuble">meubles et decoration</a></li>
                <li><a href="boutiques.php?categorie=informatique">Materiels informatique</a></li>
                <li><a href="boutiques.php?categorie=cosmetique">Cosmetique</a></li>

                <li><a id="categories-close" class="text-grey" style="float: right;" href="#">X</a></li>
              </ul> 
            </ul>
          </div>
        </nav>
        <?php if ($rowcount >=1) {?>
        
        <div class="card" style="background:#F3F4F8; padding:0px;">
        <?php while ($row = mysqli_fetch_array($cartList)){
            $idProduit = $row[1];
            $produit="SELECT * FROM produit where id = '$idProduit'";
            $produitInfo = mysqli_query($conn,$produit);
            while ($row1 = mysqli_fetch_array($produitInfo)){
            ?>

        <div class="card" style="height:100px; border-bottom-right-radius:15px; padding:0px; margin:0px; margin-top:10px;">
               <div class="row">
                    <div class="col-md-3">
                        <img src="img/<?php echo $row1[6]; ?>" height="100px" alt="">
                    </div>
                    <div class="col-md-4" style="text-align:center;">
                        <h3  class="text-danger">Produit</h3>
                        <h4><?php echo $row1[1]; ?></h4>
                        <div class="row">
                            <div class="col-md-6">Mettre a coté</div>
                            <div class="col-md-6"> <a class="text-grey" href="deletefromcart.php?id=<?php echo $row[0] ?>">supprimer</a></div>
                        </div>
                    </div>
                    <div class="col-md-2" style="text-align:center;">
                    <h3  class="text-danger">Quntité</h3>
                        <h5>1</h5>
                    </div>
                    <div class="col-md-3" style="text-align:center;">
                    <h3  class="text-danger">Prix</h3>
                        <h5><?php echo $row1[4]; ?></h5>
                    </div>
               </div>
           </div>
        <?php 
            }
    }?>
            <div class="card" style="height:50px; border-bottom-right-radius:15px; padding:5px;">
               <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <a href="" class="btn-emall-top-left-rounded bg-secondary">
                            Poursuivre vos achats
                        </a>
                    </div>
                    <div class="col-md-3">
                    <a href="" class="btn-emall-top-left-rounded">
                            Poursuivre vos achats
                        </a>
                    </div>
               </div>
           </div>
        </div>
        <?php } else{?>
        <div class="card" style="background:#F3F4F8;">
            <img src="img/vide.png" alt="">
            <a href="index.php" class="btn-emall-top-left-rounded" style="width:30%; margin-left:35%;">Commencez vos achats</a>
        </div>
        <?php } ?>
  </div>
         
  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <img class="mb-2" src="img/logo.png" alt="" width="100%" >
        <p style="padding-left: 35px; padding-right: 35px;">The Vans All-Weather MTE Collection features footwear and apparel designed to withstand the elements whilst still looking cool. </p>
      </div>
      <div class="col-6 col-md">
        <h5>Features</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Cool stuff</a></li>
          <li><a class="text-muted" href="#">Random feature</a></li>
          <li><a class="text-muted" href="#">Team feature</a></li>
          <li><a class="text-muted" href="#">Stuff for developers</a></li>
          <li><a class="text-muted" href="#">Another one</a></li>
          <li><a class="text-muted" href="#">Last time</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Resources</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Resource</a></li>
          <li><a class="text-muted" href="#">Resource name</a></li>
          <li><a class="text-muted" href="#">Another resource</a></li>
          <li><a class="text-muted" href="#">Final resource</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>About</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Team</a></li>
          <li><a class="text-muted" href="#">Locations</a></li>
          <li><a class="text-muted" href="#">Privacy</a></li>
          <li><a class="text-muted" href="#">Terms</a></li>
        </ul>
      </div>
    </div>
  </footer>
  <script>
    $("#categories-btn").click(function(){
        $('#categories-nav').removeClass("d-none");
        $("#categories-btn").hide(500);
    });
    $("#categories-close").click(function(){
        $('#categories-nav').addClass("d-none");
        $("#categories-btn").show();
    });
  </script>
  </body>
</html>
