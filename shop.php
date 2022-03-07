<?php
session_start();
$servername="localhost";
$username="root";
$password="1234";
$dbname="emall";
$conn=mysqli_connect($servername,$username,$password,$dbname);
$id_boutique = $_GET['id'];
$produitsFemme="SELECT * FROM produit where id_boutique='$id_boutique' and pour ='femme'";
$produitsEnfant="SELECT * FROM produit where id_boutique='$id_boutique' and pour ='enfant'";
$produitsHomme="SELECT * FROM produit where id_boutique='$id_boutique' and pour ='homme'";

$produitsFemmeList=mysqli_query($conn,$produitsFemme);
$produitsEnfantList=mysqli_query($conn,$produitsEnfant);
$produitsHommeList=mysqli_query($conn,$produitsHomme);


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
      <div class="container">
        <!--CAROUSEL-->
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">

          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/becca-mchaffie-Fzde_6ITjkw-unsplash.jpg" class="d-block" alt="...">
              <?php if (isset($_SESSION['boutique'])) {
                      if($_SESSION['boutique']== $_GET['id']){ ?>
              <div class="carousel-caption d-none d-md-block">
                <a href="ajout-article.php" class="btn-emall-top-left-rounded bg-primary mr-4">Ajouter un article</a>
                <a href="list-modifier-article.php?id=<?php echo $_SESSION['boutique'] ; ?>" class="btn-emall-top-left-rounded bg-danger mr-4">Modifier/Supprimer un article</a>
                <a href="ajout-collection.php" class="btn-emall-top-left-rounded bg-secondary mr-4">Ajouter une collection</a>
              </div>
              <?php }                 
              } ?>
            </div>
            
          </div>
        </div>
        <!--CAROUSEL-->
        <div class="shop-header pt-4 pb-3">
          <h3 class="text-danger">Vêtements et Maquillages</h3>
        </div>
        <div class="card border-0">

            <div class="shop-categories-container">
            <a href="produits.php?boutique=<?php echo $_GET['id']; ?>&categorie=vetement&pour=femme">
              <div class="shop-left-categories">
                <div class="flip-card">
                  <div class="flip-card-inner">
                    <div class="flip-card-front">
                      <img src="img/boutique1.png" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                    </div>
                    <div class="flip-card-back">
                      <img src="img/boutique2.png" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                    </div>
                  </div>
                </div>
              </div>
              </a>
              <div class="shop-right-categories">

                <div class="shop-right-top-categories">
                <a href="produits.php?boutique=<?php echo $_GET['id']; ?>&categorie=enceinte&pour=femme">
                  <div class="shop-right-top-categories-element">
                    <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="img/boutique3.png" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                        </div>
                        <div class="flip-card-back">
                          <img src="img/boutique4.png" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
                <a href="produits.php?boutique=<?php echo $_GET['id']; ?>&categorie=maquillage&pour=femme">
                  <div class="shop-right-top-categories-element">
                    <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="img/boutique5.jpeg" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                        </div>
                        <div class="flip-card-back">
                          <img src="img/boutique5.jpeg" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
                </div>
                <a href="produits.php?boutique=<?php echo $_GET['id']; ?>&categorie=bijoux&pour=femme">
                <div class="shop-right-bottom-categories">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <img src="img/boutique6.jpeg" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                      </div>
                      <div class="flip-card-back">
                        <img src="img/boutique6.jpeg" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                      </div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>    
        </div>
        <div class="shop-header pt-5 pb-3 mt-5">
          <h3 class="text-danger">Accessoires et Parfum</h3>
        </div>
        <div class="card border-0">

            <div class="shop-categories-container">
            <a href="produits.php?boutique=<?php echo $_GET['id']; ?>&categorie=sac&pour=femme">
              <div class="shop-left-categories">
                <div class="flip-card">
                  <div class="flip-card-inner">
                    <div class="flip-card-front">
                      <img src="img/boutique7.PNG" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                    </div>
                    <div class="flip-card-back">
                      <img src="img/boutique7.PNG" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                    </div>
                  </div>
                </div>
              </div>
              </a>
              <div class="shop-right-categories">
                <div class="shop-right-top-categories">
                <a href="produits.php?boutique=<?php echo $_GET['id']; ?>&categorie=lunettes&pour=all">
                  <div class="shop-right-top-categories-element">
                    <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="img/boutique8.PNG" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                        </div>
                        <div class="flip-card-back">
                          <img src="img/boutique9.PNG" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                  <a href="produits.php?boutique=<?php echo $_GET['id']; ?>&categorie=bijoux&pour=femme">
                  <div class="shop-right-top-categories-element">
                    <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="flip-card-front">
                          <img src="img/boutique10.PNG" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                        </div>
                        <div class="flip-card-back">
                          <img src="img/boutique10.PNG" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>
                <a href="produits.php?boutique=<?php echo $_GET['id']; ?>&categorie=parfum&pour=All">
                <div class="shop-right-bottom-categories">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="flip-card-front">
                        <img src="img/boutique11.jpeg" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                      </div>
                      <div class="flip-card-back">
                        <img src="img/boutique11.jpeg" alt="Avatar" style="height:100%;width:100%;"  class="br-emall">
                      </div>
                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div>    
        </div>
        <div class="shop-header pt-5 pb-3 mt-5">
          <h3 class="text-danger">Homme</h3>
        </div>
        <div class="row">
        <?php while ($row = mysqli_fetch_array($produitsHommeList)){ ?>
          <div class="col-md-3 mb-5 ">
          <a href="product.php?id=<?php echo $row[0]; ?>">

            <div class="card simple-card-product border-0" >
                <div class="card-img-fix">
                  <img class="card-img dropbtn" style="width: 100%; padding:0px" src="img/<?php echo $row[6]; ?>" alt="Vans">
               </div>
               

              </div>
        </a>
          </div>
        <?php 
                }
        ?>

        </div>

        <div class="row">
          <div class="col-md-3 mb-5 ">
            <div class="card simple-card-product border-0" >
                <div class="card-img-fix">
                  <img class="card-img dropbtn" style="width: 100%; padding:0px" src="img/boutique20.PNG" alt="Vans">
               </div>
              </div>
            </div>
            <div class="col-md-6 mb-5">
              <div class="pt-5 text-grey" style="text-align: center; color: #6D6D6D;">
                <h1 class="mt-5">-50% Sur Les Articles<br>Enfants</h1>
                <h4 class="mt-5">Acheter maintenant</h4>
              </div>
            </div>
            <div class="col-md-3 mb-5 ">
              <div class="card simple-card-product border-0" >
                  <div class="card-img-fix">
                    <img class="card-img dropbtn" style="width: 100%; padding:0px" src="img/boutique21.PNG" alt="Vans">
                 </div>
              </div>
            </div>
        </div>
        <div class="shop-header pt-5 pb-3 mt-5">
          <h3 class="text-danger">Enfants</h3>
        </div>
        <div class="row">
        <?php while ($row2 = mysqli_fetch_array($produitsEnfantList)){ ?>
        <div class="col-md-3 mb-5 ">
        <a href="product.php?id=<?php echo $row2[0]; ?>">
            <div class="card simple-card-product border-0" >
                <div class="card-img-fix">
                  <img class="card-img dropbtn" style="width: 100%; padding:0px" src="img/<?php echo $row2[6]; ?>" alt="Vans">
               </div>
            <div class="card-body">            
                <div class="buy product-card-price align-items-center">
                  <div class="product-name">
                    <h3><?php echo $row2[1]; ?></h3>
                    <br>
                  </div>
                  <div class="price">
                    <span><?php echo $row2[4]; ?> Dt</span>  
                    <i class="fas fa-heart ml-4 text-primary" style="float: right;"></i>
                  </div>
                </div>
            </div>
          </div>
        </a>
        </div>
        <?php
                }
             
        ?>
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