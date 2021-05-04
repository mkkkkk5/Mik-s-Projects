<title>Qatar Real Estate Company</title><?php 
  $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $getHouse = $db->prepare("select * from House");
  $getHouse->execute();
  $house = $getHouse->fetchAll(PDO::FETCH_OBJ);

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
    		padding-left: 200px;
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
            <h2 class="tm-hero-title">Book an Appointment: </h2>
            <p class="tm-hero-subtitle">
              Did you see something you like? Why not see it in person!
            </p>
        </div>        
      </div>      
    </section>

    <section id="contact" class="tm-section-pad-top tm-parallax-2">
    
      <div class="container tm-container-contact">
        <div class="row">
        	<div class="text-center col-12">
                <h2 class="tm-section-title mb-4">Appointment Form:</h2>
            </div>
        </div>
        <div id="appform">
	        <div class="row">
	            <div class="col-sm-12 col-md-6">
	              <form action="processappointment.php" method="post">
	              	<label for="loc">Choose a Real Estate location:</label>
					  <select name="loc" id="loc">
					    <?php 
		                    foreach ($house as $h) {
		                      echo "<option value='$h->address'>$h->address</option>";
		                    }
		                    foreach ($apartment as $a) {
		                      echo "<option value='$a->address'>$a->address</option>";
		                    }
		                    foreach ($island as $i) {
		                      echo "<option value='$i->address'>$i->address</option>";
		                    }
		                    foreach ($villa as $v) {
		                      echo "<option value='$v->address'>$v->address</option>";
		                    }
	                	?>
					  </select>
					<br>
					<label for="appdate">Select a date:</label>
	  					<input type="date" id="appdate" name="appdate">
	  				<br>
					<label for="apptime">Select a time:</label>
					  	<input type="time" id="apptime" name="apptime">
					<br>
					<label for="status">Status:</label>
						<select name="status" id="status">
						  <option value="Pending">Pending</option>
						</select>
					<br>
					<label for="client">Client Name:</label>
					  <select name="client" id="client">
					  	<?php
			                foreach ($person as $pA) {
			                  foreach ($client as $c) {
			                    if ($pA->person_id == $c->person_id) {
			                      echo "<option value='$c->client_id'>$pA->first_name $pA->last_name</option>";
			                    }
			                  }
			                }
			            ?>
					  </select>
					<br>
					<label for="agent">Choose an Agent:</label>
					  <select name="agent" id="agent">
					    <?php 
		                    foreach ($person as $pA) {
			                  foreach ($agent as $a) {
			                    if ($pA->person_id == $a->person_id) {
			                      echo "<option value='$a->agent_id'>$pA->first_name $pA->last_name</option>";
			                    }
			                  }
			                }
	                	?>
					  </select>
	                <button type="submit" class="btn tm-btn-submit">Submit</button>
	              </form>
	            </div>
	            
	            <div class="col-sm-12 col-md-6">
	                
	                <div class="contact-item">
	                  <a rel="nofollow" href="about.php" class="item-link">
	                      <i class="far fa-2x fa-envelope mr-4"></i>
	                      <span class="mb-0">About Us</span>
	                  </a>              
	                </div>
	                
	                <div class="contact-item">
	                  <a rel="nofollow" href="https://www.google.com/maps" class="item-link">
	                      <i class="fas fa-2x fa-map-marker-alt mr-4"></i>
	                      <span class="mb-0">Our Location</span>
	                  </a>              
	                </div>
	                
	                <div class="contact-item">
	                  <a rel="nofollow" href="tel:0100200340" class="item-link">
	                      <i class="fas fa-2x fa-phone-square mr-4"></i>
	                      <span class="mb-0">255-662-5566</span>
	                  </a>              
	                </div>
	                
	                <div class="contact-item">&nbsp;</div>
	            
	            </div>
	            
	            
	        </div>
	    </div>
      </div>

      	<footer class="text-center small tm-footer">
          <p class="mb-0">
            Copyright &copy; 2020 Qatar Real Estate Company 
          </p>
        </footer>

    </section>
  </body>
</html>