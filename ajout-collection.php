<?php
session_start();
if(!isset($_SESSION['id'])){header("location: inscription.php");
}else{
$servername="localhost";
$username="root";
$password="1234";
$dbname="emall";
$conn=mysqli_connect($servername,$username,$password,$dbname);
$idBoutique = $_SESSION['boutique'];
$produits="SELECT * FROM produit WHERE id_boutique = '$idBoutique'";
$produitsList=mysqli_query($conn,$produits);
$produitsList1=mysqli_query($conn,$produits);
$produitsList2=mysqli_query($conn,$produits);
$produitsList3=mysqli_query($conn,$produits);

}

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
                    <a class="dropdown-item" href="shop.php?id=<?php echo  $_SESSION['boutique']; ?>">Boutique</a>
                  <?php } ?>
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
      <div class="container">

          <div class="card border-0">
            <div class="row">
              <div class="inscription-left col-md-6">
                  <img src="img/inscription.PNG" alt="" class="inscription-img">
              </div>
              <div class="inscription-right col-md-6 text-center p-5">
                <form action="ajoutercollection.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="nomCollection" placeholder="Nom du Collection" class="form-control emall-input">
                    </div>
                    <div class="form-group">
                    <select name="pour" id="pour" class="form-control emall-input" >
                        <option value="">--Pour--</option>
                        <option value="homme">Homme</option>
                        <option value="femme">Femme</option>
                        <option value="enfant">Enfant</option>
                    </select>
                    </div>
                    <div class="form-group">
                      <select name="produit1" placeholder="Produit1" class="form-control emall-input" >
                        <option value="">--Produit Num 1--</option>
                        <?php while ($row = mysqli_fetch_array($produitsList)){ ?>
                            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <select name="produit2" placeholder="Produit1" class="form-control emall-input" >
                        <option value="">--Produit Num 2--</option>
                        <?php while ($row1 = mysqli_fetch_array($produitsList1)){ ?>
                            <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                        <?php } ?>
                     
                    </select>
                    </div>
                    <div class="form-group">
                      <select name="produit3" placeholder="Produit1" class="form-control emall-input" >
                        <option value="">--Produit Num 3--</option>
                        <?php while ($row2 = mysqli_fetch_array($produitsList2)){ ?>
                            <option value="<?php echo $row2[0]; ?>"><?php echo $row2[1]; ?></option>
                        <?php } ?>
                     
                    </select>
                    </div>
                    <div class="form-group">
                      <select name="produit4" placeholder="Produit1" class="form-control emall-input" >
                        <option value="">--Produit Num 4--</option>
                        <?php while ($row3 = mysqli_fetch_array($produitsList3)){ ?>
                            <option value="<?php echo $row3[0]; ?>"><?php echo $row3[1]; ?></option>
                        <?php } ?>
                     
                    </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="size" value="1000000" />
                        <input type="file" name="file" class="form-control emall-input">
                    </div>

                      <div class="form-group mt-5">
                        <input type="submit" name="submit" value="ajouter article" class="btn-emall-top-left-rounded">
                    </div>
                </form>
              </div>
            </div>
          </div>
      </div>


      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="img/logo.png" alt="" style="width: 70%; margin-left: 15%;" >
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
</body>
</html>