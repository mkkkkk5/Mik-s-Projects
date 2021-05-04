<title>Qatar Real Estate Company</title><?php 
  $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $getPerson = $db->prepare("select * from Person");
  $getPerson->execute();
  $person = $getPerson->fetchAll(PDO::FETCH_OBJ);

  $getSeller = $db->prepare("select * from Seller");
  $getSeller->execute();
  $seller = $getSeller->fetchAll(PDO::FETCH_OBJ);

  $contracts = $db->prepare("select * from Contract");
  $contracts->execute();
  $contract = $contracts->fetchAll(PDO::FETCH_OBJ);

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
    <title>Qatar Real Estate Company</title>
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
      height: 500px; 
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
            <h2 class="tm-hero-title">Sold Estates</h2>
        </div>        
      </div>   
    </section>
    
    <section id="testimonials" class="tm-section-pad-top tm-parallax-2">      
      <div class="container tm-testimonials-content">
        <div class="row">
          <div class="col-lg-12 tm-content-box">
            <h2 class="text-white text-center mb-4 tm-section-title">Sold Estates</h2>
              <p class="mx-auto tm-section-desc text-center">
                Given below are all the real estates that have been contracted in qatar. They are in different locations and are currently unavailable.
              </p>
              <div class="row">
              <table style="width:100%">
                <tr>
                    <th>Real Estate ID</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Seller Name</th>

                </tr>
                <?php
                foreach($contract as $con){
                	foreach($res as $re){
                		if($con->re_id == $re->re_id){
                			foreach($seller as $s){
		                      if($s->seller_id == $re->seller_id){
		                        foreach($person as $p){
		                          if($s->person_id == $p->person_id){
		                            echo "
		                              <tr>
		                                <td>$re->re_id</td>
		                                <td>$re->type</td>
		                                <td>$re->location</td>
		                                <td>$p->first_name $p->last_name</td>
		                              </tr>
		                            ";
		                          }
		                        }
		                      }
		                    }
                		}
                	}
                }    
                ?>
            </table>
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
                Given below are all the Apartments in qatar that are contracted and unavailable. 
              </p>
              <div class="row">
              
                <?php
                foreach ($apartments as $app) {
                  foreach ($contract as $con){
                    if($app->re_id == $con->re_id){
	                    echo "<div class='column'>
	                        <img src='img/apartment.jpg' width='200' height='150'> 
	                        <blockquote>Apartment Information: </blockquote>
	                        <blockquote>Address - $app->address </blockquote>
	                        <blockquote>Rent Per Month - $app->rent_per_month </blockquote>
	                        <blockquote>Selling Price - $app->selling_price </blockquote>
	                        <blockquote>Details - $app->details </blockquote>
	                        <blockquote>Real Estate Id - $app->re_id </blockquote>
	                    </div>";
	                }
                  }
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
                Given below are all the Houses in qatar that are contracted and unavailable.
              </p>
              <div class="row">

                <?php
                foreach ($houses as $hou) {
                  $check = 0;
                  foreach ($contract as $con){
                    if($hou->re_id == $con->re_id){
	                    echo "<div class='column'>
	                        <img src='img/house.jpg' width='200' height='150'> 
	                        <blockquote>House Information: </blockquote>
	                        <blockquote>Address - $hou->address </blockquote>
	                        <blockquote>Rent Per Month - $hou->rent_per_month </blockquote>
	                        <blockquote>Selling Price - $hou->selling_price </blockquote>
	                        <blockquote>Details - $hou->details </blockquote>
	                        <blockquote>Real Estate Id - $hou->re_id </blockquote>
	                    </div>";
	                }
                  }
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
                Given below are all the Compound Villas in qatar that are contracted and unavailable.
              </p>
              <div class="row">
                <?php
                foreach ($compounds as $com) {
                  $check = 0;
                  foreach ($contract as $con){
                    if($com->re_id == $con->re_id){
	                    echo "<div class='column'>
	                        <img src='img/cov.jpeg' width='200' height='150'> 
	                        <blockquote>Compound Villa Information: </blockquote>
	                        <blockquote>Address - $com->address </blockquote>
	                        <blockquote>Rent Per Month - $com->rent_per_month </blockquote>
	                        <blockquote>Selling Price - $com->selling_price </blockquote>
	                        <blockquote>Details - $com->details </blockquote>
	                        <blockquote>Real Estate Id - $com->re_id </blockquote>
	                    </div>";
                	}
                  }
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
                Given below are all the Islands in qatar that are contracted and unavailable.
              </p>
              <div class="row" height="700">
              
                <?php
                foreach ($islands as $is) {
                  $check = 0;
                  foreach ($contract as $con){
                    if($is->re_id == $con->re_id){
	                    echo "<div class='column'>
	                        <img src='img/island.jpg' width='200' height='150' > 
	                        <blockquote>Island Information: </blockquote>
	                        <blockquote>Address - $is->address </blockquote>
	                        <blockquote>Rent Per Month - $is->rent_per_month </blockquote>
	                        <blockquote>Selling Price - $is->selling_price </blockquote>
	                        <blockquote>Details - $is->details </blockquote>
	                        <blockquote>Real Estate Id - $is->re_id </blockquote>
	                    </div>";
	                }
                  }
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