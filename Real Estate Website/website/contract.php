<title>Qatar Real Estate Company</title><?php 
  $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  $getContract = $db->prepare("select * from Contract");
  $getContract->execute();
  $contracts = $getContract->fetchAll(PDO::FETCH_OBJ);

  $getClient = $db->prepare("select * from Client");
  $getClient->execute();
  $client = $getClient->fetchAll(PDO::FETCH_OBJ);

  $getPerson = $db->prepare("select * from Person");
  $getPerson->execute();
  $person = $getPerson->fetchAll(PDO::FETCH_OBJ);

  $getAgent = $db->prepare("select * from Agent");
  $getAgent->execute();
  $agent = $getAgent->fetchAll(PDO::FETCH_OBJ);
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
            <h2 class="tm-hero-title">Contracts</h2>
        </div>        
      </div>   
    </section>
    
    <section id="testimonials" class="tm-section-pad-top tm-parallax-2">      
      <div class="container tm-testimonials-content">
        <div class="row">
          <div class="col-lg-12 tm-content-box">
            <h2 class="text-white text-center mb-4 tm-section-title">About This Page</h2>
              <p class="mx-auto tm-section-desc text-center">
              
                Each transaction of QREC is legally bind through a document between at least two parties that defines and governs the 
                rights and duties of the parties to an agreement. A contract is legally enforceable because it meets the requirements 
                and approval of the law. It is the ensure that both parties will attain the agreed conditions.
              </p>
              <div class="row">
              <table style="width:100%; color:white;">
                <tr>
                    <th>Contract Id</th>
                    <th>Handler</th>
                    <th>Client Name</th>
                    <th>Approval Status</th>
                    <th>Terms of Contract</th>
                    <th>Date of Production</th>
                    <th>Date of Expiration</th>
                    <th>Finance ID</th>
                    <th>Real Estate ID</th>
                </tr>
                <?php
                foreach ($contracts as $contract) {
                  foreach ($client as $c) {
                    if ($c->client_id == $contract->client_id) {
                      foreach ($agent as $a) {
                        if ($a->agent_id == $contract->agent_id) {
                          foreach ($person as $pC) {
                            if ($pC->person_id == $c->person_id) {
                              foreach ($person as $pA) {
                                if ($pA->person_id == $a->person_id) {
                                  echo "
                                    <tr>
                                        <td>$contract->contract_id</td>
                                        <td>$pA->first_name $pA->last_name</td>
                                        <td>$pC->first_name $pC->last_name</td>
                                        <td>$contract->approval_status</td>
                                        <td>$contract->terms_of_contract</td>
                                        <td>$contract->date_of_production</td>
                                        <td>$contract->date_of_expiration</td>
                                        <td>$contract->finance_id</td>
                                        <td>$contract->re_id</td>
                                    </tr>
                                  ";
                                } 
                              }
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
      <div class="tm-bg-overlay"></div>
      <footer class="text-center small tm-footer">
          <p class="mb-0">
            Copyright &copy; 2020 Qatar Real Estate Company 
          </p>
        </footer>
    </section>
  </body>
</html>