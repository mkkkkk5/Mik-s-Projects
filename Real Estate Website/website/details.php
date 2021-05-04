<?php 
  $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


  $reID = filter_input(INPUT_GET,"id");
  $getEstate = $db->prepare("select * from Real_Estate where re_id=:check");
  $getEstate->bindParam(":check", $reID);
  $getEstate->execute();
  $estate = $getEstate->fetch(PDO::FETCH_OBJ);

  if($estate->type == "Compound"){
    $getDetails = $db->prepare("select * from Compound_Villa where re_id='{$estate->re_id}'");
    $getDetails->execute();
    $detail = $getDetails->fetch(PDO::FETCH_OBJ);
  }
  else if($estate->type == "Apartment"){
    $getDetails = $db->prepare("select * from Apartment where re_id='{$estate->re_id}'");
    $getDetails->execute();
    $detail = $getDetails->fetch(PDO::FETCH_OBJ);
  }
  else if($estate->type == "Island"){
    $getDetails = $db->prepare("select * from Island where re_id='{$estate->re_id}'");
    $getDetails->execute();
    $detail = $getDetails->fetch(PDO::FETCH_OBJ);
  }
  else if($estate->type == "House"){
    $getDetails = $db->prepare("select * from House where re_id='{$estate->re_id}'");
    $getDetails->execute();
    $detail = $getDetails->fetch(PDO::FETCH_OBJ);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Qatar Real Estate Company</title>
    <link rel="stylesheet" href="fontawesome-5.5/css/all.min.css" />
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
    <link rel="stylesheet" href="magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/tooplate-infinite-loop.css" />

  </head>
  <body>    
    <!-- Hero section -->
    <section id="infinite" class="text-white tm-font-big tm-parallax">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-md tm-navbar" id="tmNav">              
        <div class="container">   
          <div class="tm-next">
              <a href="homepage.php" class="navbar-brand">QREC</a>
          </div>             
            
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars navbar-toggler-icon"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="homepage.php">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="allseller.php">All Sellers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link tm-nav-link" href="search.php">Search</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="realEstateListing.php">Available Estates</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="soldEstateListing.php">Sold Estates</a>
              </li>   
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="about.php">About</a>
              </li>                 
            </ul>
          </div>        
        </div>
      </nav>
      
      <div class="text-center tm-hero-text-container">
        <div class="tm-hero-text-container-inner">
            <h2 class="tm-hero-title">Details of Selected Estate:</h2>
        </div>        
      </div>     
    </section>
    
    <section id="gallery" class="tm-section-pad-top">
      <div class="container tm-container-gallery">
        <div class="row">
            <div class="col-12">
                <div class="mx-auto tm-gallery-container">
                    <div class="grid tm-gallery">
                      <?php
                        echo "<table>
                                <tr>
                                  <th>Address:</th>
                                  <td>$detail->address</td> 
                                </tr>
                                <tr>
                                  <th>Rent Per Month:</th>
                                  <td>$detail->rent_per_month</td>
                                </tr>
                                <tr>
                                  <th>Selling Price:</th>
                                  <td>$detail->selling_price</td>
                                </tr>
                                <tr>
                                  <th>Details</th>
                                  <td>$detail->details</td>
                                </tr>
                              </table>"
                      ?>
                    </div>
                </div>                
            </div>        
          </div>
      </div>
    </section>

    <section id="testimonials" class="tm-section-pad-top tm-parallax-2">      
      <footer class="text-center small tm-footer">
          <p class="mb-0">
            Copyright &copy; 2020 Qatar Real Estate Company 
          </p>
        </footer>
    </section>
  </body>
</html>