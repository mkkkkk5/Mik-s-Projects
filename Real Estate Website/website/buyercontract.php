<title>Qatar Real Estate Company</title><?php 
  $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $getHouse = $db->prepare("select * from Contract");
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

  $getFinance = $db->prepare("select * from Finance");
  $getFinance->execute();
  $finance = $getFinance->fetchAll(PDO::FETCH_OBJ);

  $getClient = $db->prepare("select * from Client");
  $getClient->execute();
  $client = $getClient->fetchAll(PDO::FETCH_OBJ);

  $getPerson = $db->prepare("select * from Person");
  $getPerson->execute();
  $person = $getPerson->fetchAll(PDO::FETCH_OBJ);

  $getAppointment = $db->prepare("select * from Appointment");
  $getAppointment->execute();
  $appointment = $getAppointment->fetchAll(PDO::FETCH_OBJ);
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
    		padding-left: 300px;
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
            <h2 class="tm-hero-title">Buy an Estate: </h2>
            <p class="tm-hero-subtitle">
              Negotiate the terms of your contract now!
            </p>
        </div>        
      </div>      
    </section>

    <section id="contact" class="tm-section-pad-top tm-parallax-2">
    
      <div class="container tm-container-contact">
        <div class="row">
        	<div class="text-center col-12">
                <h2 class="tm-section-title mb-4">Contract Form:</h2>
            </div>
        </div>
        <div id="appform">
	        <div class="row">
	            <div class="col-sm-12 col-md-6">
	              <form action="processbuyer.php" method="post">
                  <label for="approval">Approval Status:</label>
                    <input type="text" id="approval" name="approval">
                    <br>
                  <label for="terms">Terms of Contract:</label>
                    <textarea id="terms" name="terms" rows="7" cols="35">
                    </textarea>
                  <br>
                  <label for="startdate">Start date:</label>
                    <input type="date" id="startdate" name="startdate">
                  <br>
                  <label for="enddate">End date:</label>
                    <input type="date" id="enddate" name="enddate">
                  <br>
	              	<label for="loc">Choose a Real Estate:</label>
            					  <select name="loc" id="loc">
            					    <?php 
            		                    foreach ($house as $h) {
            		                      echo "<option value='$h->re_id'>$h->address</option>";
            		                    }
            		                    foreach ($apartment as $a) {
            		                      echo "<option value='$a->re_id'>$a->address</option>";
            		                    }
            		                    foreach ($island as $i) {
            		                      echo "<option value='$i->re_id'>$i->address</option>";
            		                    }
            		                    foreach ($villa as $v) {
            		                      echo "<option value='$v->re_id'>$v->address</option>";
            		                    }
            	                	?>
            					  </select>
            					<br>
            					<label for="client">Client Name:</label>
            					  <select name="client" id="client">
            					  	<?php
            			                foreach ($person as $pA) {
            			                  foreach ($client as $c) {
            			                    if ($pA->person_id == $c->person_id) {
            			                    	echo "1";
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
                        <br>
                      <label for="finance">Choose a Finance Department:</label>
                        <select name="finance" id="finance">
                          <?php 
                                    foreach ($person as $pA) {
                                    foreach ($finance as $f) {
                                      if ($pA->person_id == $f->person_id) {
                                        echo "<option value='$f->finance_id'>$pA->first_name $pA->last_name</option>";
                                      }
                                    }
                                  }
                                ?>
                        </select>
                        <br>
                      <label for="app">Choose your Appointment ID:</label>
                        <select name="app" id="app">
                          <?php 
                            foreach ($appointment as $app) {
                              echo "<option value='$app->appointment_id'>$app->appointment_id</option>";
                            }
                          ?>
                        </select>
                        <br>
	                <button type="submit" class="btn tm-btn-submit">Submit</button>
	              </form>
	            </div>
	        </div>
	    </div>
      </div>

      	<footer class="text-center small tm-footer">
          <p class="mb-0">
          Copyright &copy; 2020 Company Name 
          
          . <a rel="nofollow" href="https://www.tooplate.com" title="HTML templates">Designed by TOOPLATE</a></p>
        </footer>

    </section>
  </body>
</html>