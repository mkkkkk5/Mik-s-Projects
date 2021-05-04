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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
		body {
		  font-family: Arial;
		}

		* {
		  box-sizing: border-box;
		}

		form.search input[type=text] {
		  padding: 10px;
		  font-size: 17px;
		  border: 1px solid grey;
		  float: left;
		  width: 80%;
		  background: #f1f1f1;
		}

		form.search button {
		  float: left;
		  width: 20%;
		  padding: 10px;
		  background: #2196F3;
		  color: white;
		  font-size: 17px;
		  border: 1px solid grey;
		  border-left: none;
		  cursor: pointer;
		}

		form.search button:hover {
		  background: #0b7dda;
		}

		form.search::after {
		  content: "";
		  clear: both;
		  display: table;
		}

    #searchDesc{
      text-align: center;
    }

    span{
      background-color: #336699;
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
      
      <div class="tm-hero-text-container">
        <div class="tm-hero-text-container-inner">
          <div id="searchDesc">
            <h1><span> Search </span></h1>
            <p> The searchbar below will direct you towards the real estates you would like to see: </p>
          </div>
      			<form class="search" action="searchresult.php" method="GET" style="margin:auto; max-width:900px; padding-bottom: 100px;">
      			  	<input type="text" placeholder="Search.." name="search" list="estates">
      			  	<button type="submit"><i class="fa fa-search"></i></button>
                <datalist id="estates">
                  <?php 
                    foreach ($house as $h) {
                      echo "<option value='$h->address'>";
                    }
                    foreach ($apartment as $a) {
                      echo "<option value='$a->address'>";
                    }
                    foreach ($island as $i) {
                      echo "<option value='$i->address'>";
                    }
                    foreach ($villa as $v) {
                      echo "<option value='$v->address'>";
                    }
                    foreach ($house as $h) {
                      echo "<option value='$h->details'>";
                    }
                    foreach ($apartment as $a) {
                      echo "<option value='$a->details'>";
                    }
                    foreach ($island as $i) {
                      echo "<option value='$i->details'>";
                    }
                    foreach ($villa as $v) {
                      echo "<option value='$v->details'>";
                    }
                  ?>
                </datalist>
      			</form>
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