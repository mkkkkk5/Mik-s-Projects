<title>Qatar Real Estate Company</title><?php 
  $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


  $desc = filter_input(INPUT_GET,"search");
  $getHouse = $db->prepare("select * from House where details like '%{$desc}%' or address like '%{$desc}%'");
  $getHouse->execute();
  $house = $getHouse->fetchAll(PDO::FETCH_OBJ);

  $getApartment = $db->prepare("select * from Apartment where details like '%{$desc}%'");
  $getApartment->execute();
  $apartment = $getApartment->fetchAll(PDO::FETCH_OBJ);

  $getVilla = $db->prepare("select * from Compound_Villa where details like '%{$desc}%'");
  $getVilla->execute();
  $villa = $getVilla->fetchAll(PDO::FETCH_OBJ);

  $getIsland = $db->prepare("select * from Island where details like '%{$desc}%'");
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

    <style >
      #tables{
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
            <h2 class="tm-hero-title">Your Search Results</h2>
        </div>        
      </div>     
    </section>
    
    <section id="gallery" class="tm-section-pad-top">
      <div class="container tm-container-gallery">
        <div class="row">
          <div class="text-center col-12">
              <h2 class="tm-text-primary tm-section-title mb-4">Real Estates Found:</h2>
          </div>            
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mx-auto tm-gallery-container">
                    <div class="grid tm-gallery">
                      <div id="tables">
                        <?php 
                          foreach ($house as $h) {
                            echo "<table>
                                    <tr>
                                      <th>Address:</th>
                                      <td>$h->address</td> 
                                    </tr>
                                    <tr>
                                      <th>Rent Per Month:</th>
                                      <td>$h->rent_per_month</td>
                                    </tr>
                                    <tr>
                                      <th>Selling Price:</th>
                                      <td>$h->selling_price</td>
                                    </tr>
                                    <tr>
                                      <th>Details</th>
                                      <td>$h->details</td>
                                    </tr>
                                    <tr>
                                      <td><a href='details.php?id=$h->re_id'>Show Details</a></td>
                                    </tr>
                                  </table> 
                                  </br>";
                          }
                          foreach ($apartment as $a) {
                            echo "<table>
                                    <tr>
                                      <th>Address:</th>
                                      <td>$a->address</td> 
                                    </tr>
                                    <tr>
                                      <th>Rent Per Month:</th>
                                      <td>$a->rent_per_month</td>
                                    </tr>
                                    <tr>
                                      <th>Selling Price:</th>
                                      <td>$a->selling_price</td>
                                    </tr>
                                    <tr>
                                      <th>Details</th>
                                      <td>$a->details</td>
                                    </tr>
                                    <tr>
                                      <td><a href='details.php?id=$a->re_id'>Show Details</a></td>
                                    </tr>
                                  </table> 
                                  </br>";
                          }
                          foreach ($island as $i) {
                            echo "<table>
                                    <tr>
                                      <th>Address:</th>
                                      <td>$i->address</td> 
                                    </tr>
                                    <tr>
                                      <th>Rent Per Month:</th>
                                      <td>$i->rent_per_month</td>
                                    </tr>
                                    <tr>
                                      <th>Selling Price:</th>
                                      <td>$i->selling_price</td>
                                    </tr>
                                    <tr>
                                      <th>Details</th>
                                      <td>$i->details</td>
                                    </tr>
                                    <tr>
                                      <td><a href='details.php?id=$i->re_id'>Show Details</a></td>
                                    </tr>
                                  </table> 
                                  </br>";
                          }
                          foreach ($villa as $v) {
                            echo "<table>
                                    <tr>
                                      <th>Address:</th>
                                      <td>$v->address</td> 
                                    </tr>
                                    <tr>
                                      <th>Rent Per Month:</th>
                                      <td>$v->rent_per_month</td>
                                    </tr>
                                    <tr>
                                      <th>Selling Price:</th>
                                      <td>$v->selling_price</td>
                                    </tr>
                                    <tr>
                                      <th>Details</th>
                                      <td>$v->details</td>
                                    </tr>
                                    <tr>
                                      <td><a href='details.php?id=$v->re_id'>Show Details</a></td>
                                    </tr>
                                  </table> 
                                  </br>";
                          }
                        ?> 
                      </div>
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