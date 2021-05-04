<title>Qatar Real Estate Company</title><?php 
  $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $getSeller = $db->prepare("select * from Seller");
  $getSeller->execute();
  $seller = $getSeller->fetchAll(PDO::FETCH_OBJ);

  $getApartment = $db->prepare("select * from Apartment");
  $getApartment->execute();
  $apartment = $getApartment->fetchAll(PDO::FETCH_OBJ);

  $getVilla = $db->prepare("select * from Compound_Villa");
  $getVilla->execute();
  $villa = $getVilla->fetchAll(PDO::FETCH_OBJ);

  $getIsland = $db->prepare("select * from Island");
  $getIsland->execute();
  $island = $getIsland->fetchAll(PDO::FETCH_OBJ);

  $getAgent = $db->prepare("select * from Agent");
  $getAgent->execute();
  $agent = $getAgent->fetchAll(PDO::FETCH_OBJ);

  $getClient = $db->prepare("select * from Client");
  $getClient->execute();
  $client = $getClient->fetchAll(PDO::FETCH_OBJ);

  $getPerson = $db->prepare("select * from Person");
  $getPerson->execute();
  $person = $getPerson->fetchAll(PDO::FETCH_OBJ);
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
    	#appform{
    		padding-top: 100px;
    		padding-left: 360px;
        text-align: center;
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
            <h2 class="tm-hero-title">Sell Property: </h2>
            <p class="tm-hero-subtitle">
              Are you interested in renting or selling your property? This is where we can make that happen!
            </p>
        </div>        
      </div>      
    </section>

    <section id="contact" class="tm-section-pad-top tm-parallax-2">
    
      <div class="container tm-container-contact">
        <div class="row">
        	<div class="text-center col-12">
                <h2 class="tm-section-title mb-4">Sell Your Estate:</h2>
            </div>
        </div>
        <div id="appform">
	        <div class="row">
	            <div class="col-sm-12 col-md-6">
	              <form action="processseller.php" method="post">
                  <label for="seller">Seller Name:</label>
                        <select name="seller" id="seller">
                          <?php
                                  foreach ($person as $pA) {
                                    foreach ($seller as $s) {
                                      if ($pA->person_id == $s->person_id) {
                                        echo "1";
                                        echo "<option value='$s->seller_id'>$pA->first_name $pA->last_name</option>";
                                      }
                                    }
                                  }
                              ?>
                        </select>
                      <br>
	              	<label for="hometype">Type:</label>
            					 <select name="hometype" id="hometype">
                        <option value="Apartment">Apartment</option>
                        <option value="Compound">Compound</option>
                        <option value="Island">Island</option>
                        <option value="House">House</option>
            					 </select>
            					<br>
                      <label for="dbtype">Type (Abbreviated):</label>
                       <select name="dbtype" id="dbtype">
                        <option value="10">A</option>
                        <option value="7">C</option>
                        <option value="8">I</option>
                        <option value="9">H</option>
                       </select>
                      <br>
            					<label for="loc">Location:</label>
                        <input type="text" id="loc" name="loc">
                      <br>
            					<label for="addr">Address:</label>
                        <input type="text" id="addr" name="addr">
                      <br>
                      <label for="rent">Rent Per Month:</label>
                        <input type="number" id="rent" name="rent">
                      <br>
                      <label for="price">Selling Price:</label>
                        <input type="number" id="price" name="price">
                      <br>
                      <label for="details">Estate Details:</label>
                        <textarea id="details" name="details" rows="3" cols="28">
                        </textarea>
                      <br>
	                <button type="submit" class="btn tm-btn-submit">Submit</button>
	              </form>
	            </div>
	        </div>
	    </div>
      </div>

      	<footer class="text-center small tm-footer">
          <footer class="text-center small tm-footer">
          <p class="mb-0">
            Copyright &copy; 2020 Qatar Real Estate Company 
          </p>
        </footer>

    </section>
  </body>
</html>