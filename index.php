<?php
session_start();

?>
<?php
$servername="localhost";
$username="root";
$password="1234";
$dbname="emall";
$conn=mysqli_connect($servername,$username,$password,$dbname);

$produits="SELECT * FROM produit";
$boutiqueOr="SELECT * FROM boutique where pack='or'";
$boutiqueArgent="SELECT * FROM boutique where pack='argent'";
$boutiqueBronze="SELECT * FROM boutique where pack='bronze'";

$produitsFemme="SELECT * FROM produit where  pour ='femme'";
$produitsEnfant="SELECT * FROM produit where  pour ='enfant'";
$produitsHomme="SELECT * FROM produit where  pour ='homme'";

$collectionFemme = "SELECT * FROM collection WHERE pour ='femme'";
$collectionFemmeList=mysqli_query($conn,$collectionFemme);

$collectionHomme = "SELECT * FROM collection WHERE pour ='homme'";
$collectionHommeList=mysqli_query($conn,$collectionHomme);

$collectionEnfant = "SELECT * FROM collection WHERE pour ='enfant'";
$collectionEnfantList=mysqli_query($conn,$collectionEnfant);


$produitsFemmeList=mysqli_query($conn,$produitsFemme);
$produitsEnfantList=mysqli_query($conn,$produitsEnfant);
$produitsHommeList=mysqli_query($conn,$produitsHomme);

$boutiquesOr=mysqli_query($conn,$boutiqueOr);
$boutiquesArgent=mysqli_query($conn,$boutiqueArgent);
$boutiquesBronze=mysqli_query($conn,$boutiqueBronze);

$produitsList=mysqli_query($conn,$produits);

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
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">

              <img src="img/slide 2.jpg" class="d-block" alt="...">
              <div class="carousel-caption d-none d-md-block " style="height:350px;">
                <h1 style="font-size:3.5em;margin-left:120px;" >Un mall qui vous suit où vous êtes</h1>
                <?php if(!isset($_SESSION['id'])) {?>
                <a href="inscription.php" class="btn-emall-top-left-rounded" style="margin-top:80px;margin-left:120px;">Commencez</a>
                <?php } ?>
              </div>
            </div>
            <div class="carousel-item">
              <img src="img/unnamed.jpg" class="d-block" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h1>VENDEZ SUR EMALL ET GAGNEZ <br> DE L'ARGENT</h1>
                <?php if(!isset($_SESSION['id'])) {?>
                <a href="inscription.php" class="btn-emall-top-left-rounded" >Commencez</a>
                <?php } ?>
              </div>
            </div>
            
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        
        
        <h3 class="text-primary">Les meilleurs Boutiques </h3>
        <hr class="col-md-2 w-25 bg-danger m-0 mb-3">
        <div class="row">
<div class="myscrollable-list">
        <?php while ($row = mysqli_fetch_array($boutiquesOr)){ ?>
            <div class="col-md-4 mb-5" style="display: inline-block;">
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
        <div class="row">
<div class="myscrollable-list">
        <?php while ($row = mysqli_fetch_array($boutiquesArgent)){ ?>
            <div class="col-md-4 mb-5" style="display: inline-block;">
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
        <div class="row">
<div class="myscrollable-list">
        <?php while ($row = mysqli_fetch_array($boutiquesBronze)){ ?>
            <div class="col-md-4 mb-5" style="display: inline-block;">
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
          
        <h3 class="text-primary">Les meilleurs Produits </h3>
        <hr class="col-md-2 w-25 bg-danger m-0 mb-3">

        
      <div class="row">

      <div class="myscrollable-list mb-5">
      <div class="col-md-3 mb-5 " style="display: inline-block;" >
          <div class="card card-product"  style="height:450px; border:none;">
          <h2 style="text-align:center;z-index:20000;position:absolute;bottom:100px; color:white;width:50%;margin-left:25%;margin-left:25%;">
          Nouvelle <br> Collection

          </h2>
          <button class="btn btn-emall-top-left-rounded" style="z-index:20000;position:absolute;bottom:50px;width:50%;margin-left:25%;margin-left:25%;" >Acheter</button>

          <img class="emall-img" src="img/12.png"  style="height:100%;width:100%;z-index:10000; position:absolute;top:0;left:0;border-top-left-radius:50px;border-bottom-right-radius:50px;" alt="Vans">

            <div class="product-card-price">
              <span class="current-price">50Dt</span>
              <span class="real-price">120Dt</span>
            </div>
            <div class="dropdown" style="height:450px;">
              <div class="card-img-fix" style="height:250px;">
                <img class="card-img dropbtn emall-" src="img/<?php echo $row[6]; ?>" style="height:250px;" alt="Vans">
             </div>
 
            </div>
            <div class="card-body">            
              <div class="buy d-flex justify-content-between align-items-center">
                <h5 class="product-detail-label" >
                Nouvelle Collection

                </h5>
              </div>

              </div>
            </div>
          </div>
      <?php while ($row = mysqli_fetch_array($collectionFemmeList)){ ?>
      <div class="col-md-3 mb-5 " style="display: inline-block;" >
          <div class="card card-product"  style="height:450px;">
            <div class="product-card-price">
              <span class="current-price">50Dt</span>
              <span class="real-price">120Dt</span>
            </div>
            <div class="dropdown" style="height:450px;">
              <div class="card-img-fix" style="height:250px;">
                <img class="card-img dropbtn emall-" src="img/<?php echo $row[2]; ?>" style="height:250px;" alt="Vans">
             </div>
             <div class="preview dropdown-content">
              <ul class="preview-thumbnail nav ">
          <?php
          $id_produit = $row[0];
              $query1 = "select p.id,p.img,c.id_produit,c.id_collection from produit p, collection_produits c where p.id=c.id_produit and c.id_collection='$id_produit'"; 
              $produitFemmeList=mysqli_query($conn,$query1);

        while ($rowfemme = mysqli_fetch_array($produitFemmeList)){
        ?>
            <li><a href="product.php?id=<?php echo $rowfemme['id']; ?>"><img src="img/<?php echo $rowfemme['img']; ?>" /></a></li>
        <?php } ?>
                </ul>
            </div>
            </div>
            <div class="card-body">            
              <div class="buy d-flex justify-content-between align-items-center">
                <h5 class="product-detail-label">
                  <span class="color orange"></span>
                  <span class="color green"></span>
                  <span class="color blue"></span>
                </h5>
                <div class="price text-primary"><i class="fas fa-heart ml-4"></i></div>
              </div>

              </div>
            </div>
          </div>
      <?php } ?>
      </div>

    
      </div>


<div class="row">

<div class="myscrollable-list mb-5">
<div class="col-md-3 mb-5 " style="display: inline-block;" >
    <div class="card card-product"  style="height:450px; border:none;">
    <h2 style="text-align:center;z-index:20000;position:absolute;bottom:100px; color:white;width:50%;margin-left:25%;margin-left:25%;">
    Nouvelle <br> Collection

    </h2>
    <button class="btn btn-emall-top-left-rounded" style="z-index:20000;position:absolute;bottom:50px;width:50%;margin-left:25%;margin-left:25%;" >Acheter</button>

    <img class="emall-img" src="img/boutique17.png"  style="height:100%;width:100%;z-index:10000; position:absolute;top:0;left:0;border-top-left-radius:50px;border-bottom-right-radius:50px;" alt="Vans">

      <div class="product-card-price">
        <span class="current-price">50Dt</span>
        <span class="real-price">120Dt</span>
      </div>
      <div class="dropdown" style="height:450px;">
        <div class="card-img-fix" style="height:250px;">
          <img class="card-img dropbtn emall-" src="img/" style="height:250px;" alt="Vans">
       </div>

      </div>
      <div class="card-body">            
        <div class="buy d-flex justify-content-between align-items-center">
          <h5 class="product-detail-label" >
          Nouvelle Collection

          </h5>
        </div>

        </div>
      </div>
    </div>
<?php while ($row1 = mysqli_fetch_array($collectionHommeList)){ ?>
<div class="col-md-3 mb-5 " style="display: inline-block;" >
    <div class="card card-product"  style="height:450px;">
      <div class="product-card-price">
        <span class="current-price">50Dt</span>
        <span class="real-price">120Dt</span>
      </div>
      <div class="dropdown" style="height:450px;">
        <div class="card-img-fix" style="height:250px;">
          <img class="card-img dropbtn emall-" src="img/<?php echo $row1[2]; ?>" style="height:250px;" alt="Vans">
       </div>
       <div class="preview dropdown-content">
        <ul class="preview-thumbnail nav ">
        <?php
          $id_produit = $row1[0];
              $query2 = "select p.id,p.img,c.id_produit,c.id_collection from produit p, collection_produits c where p.id=c.id_produit and c.id_collection='$id_produit'"; 
              $produitHommeList=mysqli_query($conn,$query2);

        while ($rowHomme = mysqli_fetch_array($produitHommeList)){
        ?>
            <li><a href="product.php?id=<?php echo $rowHomme['id']; ?>"><img src="img/<?php echo $rowHomme['img']; ?>" /></a></li>
        <?php } ?> 
         </ul>
      </div>
      </div>
      <div class="card-body">            
        <div class="buy d-flex justify-content-between align-items-center">
          <h5 class="product-detail-label">
            <span class="color orange"></span>
            <span class="color green"></span>
            <span class="color blue"></span>
          </h5>
          <div class="price text-primary"><i class="fas fa-heart ml-4"></i></div>
        </div>

        </div>
      </div>
    </div>
<?php } ?>
</div>


</div>


<div class="row">

<div class="myscrollable-list mb-5">
<div class="col-md-3 mb-5 " style="display: inline-block;" >
    <div class="card card-product"  style="height:450px; border:none;">
    <h2 style="text-align:center;z-index:20000;position:absolute;bottom:100px; color:white;width:50%;margin-left:25%;margin-left:25%;">
    Nouvelle <br> Collection

    </h2>
    <button class="btn btn-emall-top-left-rounded" style="z-index:20000;position:absolute;bottom:50px;width:50%;margin-left:25%;margin-left:25%;" >Acheter</button>

    <img class="emall-img" src="img/123.png"  style="height:100%;width:100%;z-index:10000; position:absolute;top:0;left:0;border-top-left-radius:50px;border-bottom-right-radius:50px;" alt="Vans">

      <div class="product-card-price">
        <span class="current-price">50Dt</span>
        <span class="real-price">120Dt</span>
      </div>
      <div class="dropdown" style="height:450px;">
        <div class="card-img-fix" style="height:250px;">
          <img class="card-img dropbtn emall-" src="img/" style="height:250px;" alt="Vans">
       </div>

      </div>
      <div class="card-body">            
        <div class="buy d-flex justify-content-between align-items-center">
          <h5 class="product-detail-label" >
          Nouvelle Collection

          </h5>
        </div>

        </div>
      </div>
    </div>
<?php while ($row2 = mysqli_fetch_array($collectionEnfantList)){ ?>
<div class="col-md-3 mb-5 " style="display: inline-block;" >
    <div class="card card-product"  style="height:450px;">
      <div class="product-card-price">
        <span class="current-price">50Dt</span>
        <span class="real-price">120Dt</span>
      </div>
      <div class="dropdown" style="height:450px;">
        <div class="card-img-fix" style="height:250px;">
          <img class="card-img dropbtn emall-" src="img/<?php echo $row2[2]; ?>" style="height:250px;" alt="Vans">
       </div>
       <div class="preview dropdown-content">
        <ul class="preview-thumbnail nav ">
        <?php
          $id_produit = $row2[0];
              $query3 = "select p.id,p.img,c.id_produit,c.id_collection from produit p, collection_produits c where p.id=c.id_produit and c.id_collection='$id_produit'"; 
              $produitEnfantList=mysqli_query($conn,$query2);

        while ($rowEnfant = mysqli_fetch_array($produitEnfantList)){
        ?>
            <li><a href="product.php?id=<?php echo $rowEnfant['id']; ?>"><img src="img/<?php echo $rowEnfant['img']; ?>" /></a></li>
        <?php } ?> 
          </ul>
      </div>
      </div>
      <div class="card-body">            
        <div class="buy d-flex justify-content-between align-items-center">
          <h5 class="product-detail-label">
            <span class="color orange"></span>
            <span class="color green"></span>
            <span class="color blue"></span>
          </h5>
          <div class="price text-primary"><i class="fas fa-heart ml-4"></i></div>
        </div>

        </div>
      </div>
    </div>
<?php } ?>
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