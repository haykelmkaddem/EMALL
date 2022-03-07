<?php
session_start();
$servername="localhost";
$username="root";
$password="1234";
$dbname="emall";
$conn=mysqli_connect($servername,$username,$password,$dbname);
$id = $_GET['id'];

$produit="SELECT * FROM produit where id = '$id'";
$produitImgs="SELECT * FROM produit_img where id_produit = '$id'";




$produitInfo = mysqli_query($conn,$produit);
$produitImgsList = mysqli_query($conn,$produitImgs);
$produitImgsList2 = mysqli_query($conn,$produitImgs);

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

    <!-- modal2 -->
<form action="ajouterproduitimgs.php" method="POST" enctype='multipart/form-data'>
  <div class="modal fade" id="modalajouterimgsForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Ajouter images</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <input type="file" name="file[]" class="form-control emall-input" multiple class="form-control emall-input validate">
        </div>

        <div class="md-form mb-4">
          <input type="hidden" name="prductId" value="<?php echo $_GET['id']; ?>" class="form-control emall-input validate">
        </div>
        
      </div>

     

      <div class="modal-footer d-flex justify-content-center">
        <input type="submit" name="ajouterImgsBtn" value="ajouter" class="btn btn-emall-top-left-rounded">
      </div>
    </div>
  </div>
</div>
</form>

  <!-- modal2 -->
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
    <?php while ($row = mysqli_fetch_array($produitInfo)){ ?>
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
                    <div class="preview col-md-1">
                        <ul class="preview-thumbnail nav ">
                            <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="img/<?php echo $row[6]; ?>" /></a></li>
                            <?php
                            $i=1;
                            while ($row1 = mysqli_fetch_array($produitImgsList)){ $i++;?>

                              <li><a data-target="#pic-<?php echo $i; ?>" data-toggle="tab"><img src="img/<?php echo $row1[1]; ?>" /></a></li>
                            <?php } ?>
                         <!--   <li><a data-target="#pic-3" data-toggle="tab"><img src="img/dress3.jpg" /></a></li>
                            <li><a data-target="#pic-4" data-toggle="tab"><img src="img/dress1.jpg" /></a></li>
                            <li><a data-target="#pic-5" data-toggle="tab"><img src="img/dress1.jpg" /></a></li>-->
                            <?php
                            if(isset($_SESSION['boutique'])){
                                if ($row[7] == $_SESSION['boutique'] ) {
                            ?>
                            <a href=""  data-toggle="modal" data-target="#modalajouterimgsForm"><li><img src="img/add.png" /></li></a>

                            
                            <?php
                                }
                              }
                            ?>
                          </ul>
                    </div>
					<div class="preview col-md-5">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="img/<?php echo $row[6]; ?>" /></div>
            <?php $j=1;  while ($row2 = mysqli_fetch_array($produitImgsList2)){ $j++;?>
						  <div class="tab-pane" id="pic-<?php echo $j; ?>"><img src="img/<?php echo $row2[1]; ?>" /></div>
            <?php } ?>
              <!--
						  <div class="tab-pane" id="pic-3"><img src="img/dress3.jpg" /></div>
						  <div class="tab-pane" id="pic-4"><img src="img/dress1.jpg" /></div>
						  <div class="tab-pane" id="pic-5"><img src="img/dress1.jpg" /></div>-->
						</div>
						
						
					</div>
					<div class="details col-md-6">
                        <h3 class="product-title"><?php echo $row[1]; ?></h3>
                        <h4 class="price"><?php echo $row[4]; ?> Dt<span>50Dt</span></h4>
						<!--<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
                        </div>-->
                        <h5 class="product-detail-label">disponibilité:
							
							<span> En stock</span>
						</h5>
                        <h5 class="product-detail-label">marque:
							
							<span> shine</span>
						</h5>
                        <h5 class="product-detail-label">Description:</h5>
						<p class="product-description"><?php echo $row[5]; ?></p>
						
					
						<h5 class="product-detail-label">sizes:
							<span class="size" data-toggle="tooltip" title="small">s</span>
							<span class="size" data-toggle="tooltip" title="medium">m</span>
							<span class="size" data-toggle="tooltip" title="large">l</span>
							<span class="size" data-toggle="tooltip" title="xtra large">xl</span>
						</h5>
						<h5 class="product-detail-label">colors:
							<span class="color orange" data-toggle="tooltip" title="Not In store"></span>
							<span class="color green"></span>
							<span class="color blue"></span>
                        </h5>
                        <p class="product-detail-qty-label">
                            Qty:</p><input type="number" width="30%" name="" id="" class="form-control product-detail-qty">
                            <br>
						<a href="add-to-cart.php?id=<?php echo $id; ?>" >
              <button class="btn-emall" type="button" style="width:100%;">add to cart</button>
              </a>
							<!--<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>-->
					</div>
				</div>
			</div>
		</div>
  </div>
          <?php } ?>
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
