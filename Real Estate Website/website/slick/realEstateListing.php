<?php 
  $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $getRE = $db->prepare("select * from Real_Estate");
  $getRE->execute();
  $res = $getRE->fetchAll(PDO::FETCH_OBJ);

  $getApartment = $db->prepare("select * from Apartment");
  $getApartment->execute();
  $apartments = $getApartment->fetchAll(PDO::FETCH_OBJ);

  $getHouse = $db->prepare("select * from House");
  $getHouse->execute();
  $houses = $getHouse->fetchAll(PDO::FETCH_OBJ);

  $getCompound = $db->prepare("select * from Compound_Villa");
  $getCompound->execute();
  $compounds = $getCompound->fetchAll(PDO::FETCH_OBJ);

  $getIsland = $db->prepare("select * from Island");
  $getIsland->execute();
  $islands = $getIsland->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Infinite Loop - Bootstrap 4.0 HTML Template</title>
    <link rel="stylesheet" href="fontawesome-5.5/css/all.min.css" />
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
    <link rel="stylesheet" href="magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/tooplate-infinite-loop.css" />

  <style>
    * {
      box-sizing: border-box;
    }

    .column {
      float: left;
      font-size: 12px;
      margin: 5px;
      width: 18%;
      padding: 10px;
      height: 250px; 
      word-wrap: break-word;
      border: 1px solid black;
      background: #afc2cf;
      color: #182932;
      box-shadow: 3px 5px;
    }

    .row{
      padding-left: 20px;
    }

    .row:after {
      content: "";
      display: table;
      clear: both;
    }
  </style>
  </head>
  <body>    
    <!-- Hero section -->
    <section id="infinite" class="text-white tm-font-big tm-parallax">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-md tm-navbar" id="tmNav">              
        <div class="container">   
          <div class="tm-next">
              <a href="#infinite" class="navbar-brand">Infinite Loop</a>
          </div>             
            
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars navbar-toggler-icon"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="#infinite">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="#whatwedo">What We Do</a>
              </li>
              <li class="nav-item">
                <a class="nav-link tm-nav-link" href="#testimonials">Testimonials</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="#gallery">Gallery</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link tm-nav-link" href="#contact">Contact</a>
              </li>                    
            </ul>
          </div>        
        </div>
      </nav> 

      <div class="text-center tm-hero-text-container">
        <div class="tm-hero-text-container-inner">
            <h2 class="tm-hero-title">Real Estate Listing</h2>
        </div>        
      </div>   
    </section>
    
    <section id="testimonials" class="tm-section-pad-top tm-parallax-2">      
      <div class="container tm-testimonials-content">
        <div class="row">
          <div class="col-lg-12 tm-content-box">
            <h2 class="text-white text-center mb-4 tm-section-title">Real Estates</h2>
              <p class="mx-auto tm-section-desc text-center">
                Given below are all the real estates available in qatar. They are of different loctions.
              </p>
              <div class="row">
              
                <?php
                foreach ($res as $re) {
                    echo "<div class='column'>
                        <h2>$re->re_id $re->type</h2>
                        <blockquote>Real Estate Information: </blockquote>
                        <blockquote>Location - $re->location </blockquote>
                        <blockquote>SellerID - $re->seller_id </blockquote>
                    </div>";
                }
                ?>
              </div>
          </div>
        </div>
      </div>
      <div class="tm-bg-overlay"></div>
    </section>

    <section id="testimonials" class="tm-section-pad-top tm-parallax-2">      
      <div class="container tm-testimonials-content">
        <div class="row">
          <div class="col-lg-12 tm-content-box">
            <h2 class="text-white text-center mb-4 tm-section-title">Apartments</h2>
              <p class="mx-auto tm-section-desc text-center">
                Given below are all the Apartments available in qatar. They are of different loctions.
              </p>
              <div class="row">
              
                <?php
                foreach ($apartments as $app) {
                    echo "<div class='column'>
                        <h2>$app->apt_id</h2>
                        <img src="img/apartment.jpg" width="200" height="150"\> </img>
                        <blockquote>Apartment Information: </blockquote>
                        <blockquote>Addres - $app->address </blockquote>
                        <blockquote>Rent Per Month - $app->rent_per_month </blockquote>
                        <blockquote>Selling Price - $app->selling_price </blockquote>
                        <blockquote>Details - $app->details </blockquote>
                        <blockquote>Real Estate Id - $app->re_id </blockquote>
                    </div>";
                }
                ?>
              </div>
          </div>
        </div>
      </div>
      <div class="tm-bg-overlay"></div>
    </section>

    <section id="testimonials" class="tm-section-pad-top tm-parallax-2">      
      <div class="container tm-testimonials-content">
        <div class="row">
          <div class="col-lg-12 tm-content-box">
            <h2 class="text-white text-center mb-4 tm-section-title">House</h2>
              <p class="mx-auto tm-section-desc text-center">
                Given below are all the Houses available in qatar. They are of different loctions.
              </p>
              <div class="row">
              
                <?php
                foreach ($houses as $hou) {
                    echo "<div class='column'>
                        <h2>$hou->hou_id</h2>
                        <img src='img/house.jpg' width="200" height="150"\> </img>
                        <blockquote>Apartment Information: </blockquote>
                        <blockquote>Addres - $hou->address </blockquote>
                        <blockquote>Rent Per Month - $hou->rent_per_month </blockquote>
                        <blockquote>Selling Price - $hou->selling_price </blockquote>
                        <blockquote>Details - $hou->details </blockquote>
                        <blockquote>Real Estate Id - $hou->re_id </blockquote>
                    </div>";
                }
                ?>
              </div>
          </div>
        </div>
      </div>
      <div class="tm-bg-overlay"></div>
    </section>

    <section id="testimonials" class="tm-section-pad-top tm-parallax-2">      
      <div class="container tm-testimonials-content">
        <div class="row">
          <div class="col-lg-12 tm-content-box">
            <h2 class="text-white text-center mb-4 tm-section-title">Compound Villa</h2>
              <p class="mx-auto tm-section-desc text-center">
                Given below are all the Compound Villas available in qatar. They are of different loctions.
              </p>
              <div class="row">
              
                <?php
                foreach ($compounds as $com) {
                    echo "<div class='column'>
                        <h2>$com->cov_id</h2>
                        <img src='img/cov.jpeg' width="200" height="150"\> </img>
                        <blockquote>Apartment Information: </blockquote>
                        <blockquote>Addres - $com->address </blockquote>
                        <blockquote>Rent Per Month - $com->rent_per_month </blockquote>
                        <blockquote>Selling Price - $com->selling_price </blockquote>
                        <blockquote>Details - $com->details </blockquote>
                        <blockquote>Real Estate Id - $com->re_id </blockquote>
                    </div>";
                }
                ?>
              </div>
          </div>
        </div>
      </div>
      <div class="tm-bg-overlay"></div>
    </section>

    <section id="testimonials" class="tm-section-pad-top tm-parallax-2">      
      <div class="container tm-testimonials-content">
        <div class="row">
          <div class="col-lg-12 tm-content-box">
            <h2 class="text-white text-center mb-4 tm-section-title">Islands</h2>
              <p class="mx-auto tm-section-desc text-center">
                Given below are all the Islands available in qatar. They are of different loctions.
              </p>
              <div class="row">
              
                <?php
                foreach ($islands as $is) {
                    echo "<div class='column'>
                        <h2>$is->isl_id</h2>
                        <img src='img/island.jpg' width="200" height="150"\> </img>
                        <blockquote>Apartment Information: </blockquote>
                        <blockquote>Addres - $is->address </blockquote>
                        <blockquote>Rent Per Month - $is->rent_per_month </blockquote>
                        <blockquote>Selling Price - $is->selling_price </blockquote>
                        <blockquote>Details - $is->details </blockquote>
                        <blockquote>Real Estate Id - $is->re_id </blockquote>
                    </div>";
                }
                ?>
              </div>
          </div>
        </div>
      </div>
      <div class="tm-bg-overlay"></div>
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