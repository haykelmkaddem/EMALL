<?php
session_start();

if(!isset($_SESSION['id'])){header("location: inscription.php");
}else{
  $id=$_SESSION['id'];
}




$servername="localhost";
  $username="root";
  $password="1234";
  $dbname="emall";
  $conn=mysqli_connect($servername,$username,$password,$dbname);

  $userinfo="SELECT * FROM membre where id = '$id'";
  $info=mysqli_query($conn,$userinfo);
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
      <div class="container-fluid">
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
        <?php while ($row = mysqli_fetch_array($info)):?>

        <div class="profile-content container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar card-profile-shodow text-primary">
                    <table>
                        <tr>
                            <td>
                                <div class="img-div">
                                    <img src="img/<?php echo $row[6]; ?>" alt=""  class="rounded-avatar">
                                </div>
                            </td>

                        </tr>
                        <tr>
                          <td>
                                <div class="text-div">
                                    <h5><?php echo $row[1].' '.$row[2]; ?></h5>
                                    <span>Changer photo du profil</span>
                                </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <a href="" style="height:35px;padding:5px;margin-top:10px;" class="btn-emall-top-left-rounded">
                            <i class="fas fa-comment-dots"></i> Message
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <a href="" class="text-secondary">
                            <i class="fab fa-facebook-f"> </i> Facebook
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <a href="" class="text-secondary">
                            <i class="fab fa-instagram"> </i> Instagram
                            </a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <a href="" class="text-secondary">
                            <i class="fab fa-twitter"> </i> Twitter
                            </a>
                          </td>
                        </tr>
                    </table>
                    </div>
                </div>
                <?php endwhile; ?>

                <div class="col-md-6">
                  <div class="card-profile-shodow">
                    <div class="card profile-card ">
                      <img src="img/profile.jpg" alt="">

                    </div>
                    <div class="profile-info">
                        <h3>Changer les coordonnées personnel</h3>
                        
                        <form action="update_profile.php" method="post">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" name="pwdi" placeholder="Mot de passe" class="form-control emall-input">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" name="pwd" placeholder="Nouveau Mot de passe" class="form-control emall-input">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" name="pwd" placeholder="Confirmer nouveau mot de passe" class="form-control emall-input">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mt-5">
                                        <input type="submit" name="updatemdp" value="mettre a jour" class="btn-emall-top-left-rounded">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                <div class="col-md-3">
                  <div class="card-profile-shodow">
                      <a href="profile.php?id=<?php echo  $id; ?>">Parametres du comte</a><br><br>
                      <a href="wishlist.php">Liste d'envie</a><br><br>
                      <a href="mdp.php">Mot de passe et sécurité</a>
                  </div>
                  <div class="card-profile-shodow">
                      <div class="row" style="margin-bottom:20px;">
                        <div style="width:33%;">
                          <img src="img/20170904_163306.jpg" class="rounded-avatar" style="height:50px; width:50px;" alt="">
                        </div>
                        <div style="width:66%;text-align:center;padding-left:10px;">
                          <table>
                            <tr>
                              <td><h6>
                                Nom Prénom
                              </h6></td>
                            </tr>
                            <tr>
                              <td><span class="text-secondary">
                                ajouter ce client
                              </span></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:20px;">
                        <div style="width:33%;">
                          <img src="img/20170904_163306.jpg" class="rounded-avatar" style="height:50px; width:50px;" alt="">
                        </div>
                        <div style="width:66%;text-align:center;padding-left:10px;">
                          <table>
                            <tr>
                              <td><h6>
                                Nom Prénom
                              </h6></td>
                            </tr>
                            <tr>
                              <td><span class="text-secondary">
                                ajouter ce client
                              </span></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                  </div>
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

