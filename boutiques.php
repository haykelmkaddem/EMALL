<?php
session_start();
$servername="localhost";
$username="root";
$password="1234";
$dbname="emall";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if (isset($_GET['categorie'])) {
  $categorie = $_GET['categorie'];
  $boutique="SELECT * FROM boutique WHERE categorie='$categorie'";
}else{
  $boutique="SELECT * FROM boutique";
}


$boutiques=mysqli_query($conn,$boutique);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutiques</title>
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
    <div class="container">
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
        <div class="row">

          <?php while ($row = mysqli_fetch_array($boutiques)){ ?>
            <div class="col-md-4 mb-5">
              <div class="card card-boutique" >
                <div class="card-img-fix">
                  <img class="card-img" src="img/<?php echo $row[7]; ?>" alt="<?php echo $row[1]; ?>">
               </div>
                <div class="card-body">
                 
                  <p class="card-text">
                    <?php echo $row[9]; ?>
                  </p>
                 
                  <div class="buy d-flex justify-content-between align-items-center">
                    <div class="price text-primary mt-3"><i class="fas fa-share-alt ml-4"></i><i class="fas fa-heart ml-4"></i></div>
                     <a href="shop.php?id=<?php echo $row[0]; ?>" class="btn-emall-top-left-rounded mt-3"> Visit </a>
                     
                  </div>
                  <div class="rating text-center mt-3">
                    <div class="stars">
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star checked"></span>
                      <span class="fa fa-star"></span>
                      <span class="fa fa-star"></span>
                    </div>
                    <span class="review-no">41 reviews</span>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
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