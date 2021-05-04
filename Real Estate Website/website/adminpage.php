

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
            <h2 class="tm-hero-title">Admin</h2>
        </div>        
      </div>   
    </section>
    
    <section id="testimonials" class="tm-section-pad-top tm-parallax-2">      
      <div class="container tm-testimonials-content">
        <div class="row">
          <div class="col-lg-12 tm-content-box">
            <h2 class="text-white text-center mb-4 tm-section-title">Admin</h2>
              <p class="mx-auto tm-section-desc text-center">
                Administrative page to check list of invoices and contracts. 
              </p>
          </div>
        </div>
      </div>
      <div class="tm-bg-overlay"></div>
    </section>

    <section id="gallery" class="tm-section-pad-top">
      <div class="container tm-container-gallery">
        <div class="row">
          <div class="text-center col-12">
              <h2 class="tm-text-primary tm-section-title mb-4">Collective Lists:</h2>
              <p class="mx-auto tm-section-desc">
              </p>
          </div>            
        </div>
        <div class="row" style="margin-left:200px;">
            <div class="col-12">
                <div class="mx-auto tm-gallery-container">
                    <div class="grid tm-gallery">
                      <a href="allclient.php">
                        <figure class="effect-honey tm-gallery-item">
                          <img src="img/a.jpeg" alt="Image 1" class="img-fluid">
                          <figcaption>
                            <h2><i><span>All Clients</span></i></h2>
                          </figcaption>
                        </figure>
                      </a>
                      <a href="buyerPage.php">
                        <figure class="effect-honey tm-gallery-item">
                          <img src="img/b.jpeg" alt="Image 2" class="img-fluid">
                          <figcaption>
                            <h2><i><span>Purchase Histories</span></i></h2>
                          </figcaption>
                        </figure>
                      </a>
                      <a href="contract.php">
                        <figure class="effect-honey tm-gallery-item">
                          <img src="img/c.jpeg" alt="Image 3" class="img-fluid">
                          <figcaption>
                            <h2><i><span>Contracts</span></i></h2>
                          </figcaption>
                        </figure>
                      </a>
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