<title>Qatar Real Estate Company</title><?php 
  $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $getInvoices = $db->prepare("select * from Invoice");
  $getInvoices->execute();
  $invoices = $getInvoices->fetchAll(PDO::FETCH_OBJ);

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
            <h2 class="tm-hero-title">Invoices</h2>
        </div>        
      </div>   
    </section>
    
    <section id="testimonials" class="tm-section-pad-top tm-parallax-2">      
      <div class="container tm-testimonials-content">
        <div class="row">
          <div class="col-lg-12 tm-content-box">
            <h2 class="text-white text-center mb-4 tm-section-title">About This Page</h2>
              <p class="mx-auto tm-section-desc text-center">
                Each transaction made with QREC is strored as an invoice. 
                This page will show all real estate bought from QREC.
              </p>
              <div class="row">
              <table style="width:100%; color:white;">
                <tr>
                    <th>Client Full Name</th>
                    <th>Purchase Description</th>
                    <th>Amount</th>
                    <th>Amount In Words</th>
                    <th>Date of Transaction</th>
                    <th>Payment Method</th>
                </tr>
                <?php
                foreach ($invoices as $inv) {
                  foreach ($client as $c) {
                    if ($c->client_id == $inv->client_id) {
                      foreach ($person as $p) {
                        if ($p->person_id == $c->person_id) {
                          echo "
                            <tr>
                              <td>$p->first_name $p->last_name</td>
                              <td>$inv->purchase_description</td>
                              <td>$inv->amount</td>
                              <td>$inv->amount_in_words</td>
                              <td>$inv->date_of_transaction</td>
                              <td>$inv->payment_method</td>
                            </tr>
                          ";
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
      <div class="tm-bg-overlay"></div>
      <footer class="text-center small tm-footer">
          <p class="mb-0">
            Copyright &copy; 2020 Qatar Real Estate Company 
          </p>
        </footer>
    </section>
  </body>
</html>