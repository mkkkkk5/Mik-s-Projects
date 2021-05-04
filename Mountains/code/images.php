<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ClimbAdvice Images Page</title>
        <link rel="stylesheet" href="style.css">
        <style>

            #boxImg{
                float: left;
                width: 47%;
                height: 20%;
                margin: 12px;
                text-align: center;
                
                
            }
            
            #header{
                max-width: 90%;
                height: 5%;
                margin: auto;
            }

            #header img {
                height: 46px;
                width: 100px;
                float: right;
            }

            #box{
                width: 90%;
                height: 90%;
                margin: auto;
            }

            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #1C2353;
            }
            
            li {
                float: left;
                border-right:1px solid #bbb;
            }
            
            li:last-child {
                border-right: none;
            }
            
            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }
            
            li a:hover:not(.active) {
                background-color: #111;
            }
            
            .active {
                background-color: #EC9601;
                color: black;
            }

            * {box-sizing: border-box}
                body {font-family: Verdana, sans-serif; margin:0}
                .mySlides {display: none}
                img {vertical-align: middle;}

                /* Slideshow container */
                .slideshow-container {
                max-width: 1000px;
                position: relative;
                margin: auto;
                }

                /* Next & previous buttons */
                .prev, .next {
                cursor: pointer;
                position: absolute;
                top: 50%;
                width: auto;
                padding: 16px;
                margin-top: -22px;
                color: white;
                font-weight: bold;
                font-size: 18px;
                transition: 0.6s ease;
                border-radius: 0 3px 3px 0;
                user-select: none;
                }

                /* Position the "next button" to the right */
                .next {
                right: 0;
                border-radius: 3px 0 0 3px;
                }

                /* On hover, add a black background color with a little bit see-through */
                .prev:hover, .next:hover {
                background-color: rgba(0,0,0,0.8);
                }

                /* Caption text */
                .text {
                color: #f2f2f2;
                font-size: 15px;
                padding: 8px 12px;
                position: absolute;
                bottom: 8px;
                width: 100%;
                text-align: center;
                }

                /* Number text (1/3 etc) */
                .numbertext {
                color: #f2f2f2;
                font-size: 12px;
                padding: 8px 12px;
                position: absolute;
                top: 0;
                }

                /* The dots/bullets/indicators */
                .dot {
                cursor: pointer;
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbb;
                border-radius: 50%;
                display: inline-block;
                transition: background-color 0.6s ease;
                }

                .active, .dot:hover {
                background-color: #717171;
                }

                /* Fading animation */
                .fade {
                -webkit-animation-name: fade;
                -webkit-animation-duration: 1.5s;
                animation-name: fade;
                animation-duration: 1.5s;
                }

                @-webkit-keyframes fade {
                from {opacity: .4} 
                to {opacity: 1}
                }

                @keyframes fade {
                from {opacity: .4} 
                to {opacity: 1}
                }

                /* On smaller screens, decrease text size */
                @media only screen and (max-width: 300px) {
                .prev, .next,.text {font-size: 11px}
                }
        </style>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <a href="index.php"><img src='../images/logo.png'></a>
                <ul>
                    <li ><a  href="index.php">Home Page</a></li>
                    <li ><a  href="category.php">Category</a></li>
                    <li ><a  href="mountain.php">Mountain</a></li>
                    <li ><a  class="active" href="images.php">Images</a></li>
                    <li ><a  href="form.php">Form</a></li>
                </ul>
            </div>

            <div id="box">
                <h1>Images</h1>
                <div class="slideshow-container">

                        <div class="mySlides fade">
                          <div class="numbertext">1 / 3</div>
                          <img src="../images/pic1.jpg" style="width:100%; height:500px;">
                          <div class="text">Mt. Elps 21/01/2018</div>
                        </div>
                        
                        <div class="mySlides fade">
                          <div class="numbertext">2 / 3</div>
                          <img src="../images/pic2.jpeg" style="width:100%; height:500px;">
                          <div class="text">Mt. Bleps 22/05/2019</div>
                        </div>
                        
                        <div class="mySlides fade">
                          <div class="numbertext">3 / 3</div>
                          <img src="../images/pic3.png" style="width:100%; height:500px;">
                          <div class="text">Mt. Elf 03/12/2018</div>
                        </div>
                        
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        
                    </div>
                        <br>
                        
                        <div style="text-align:center">
                          <span class="dot" onclick="currentSlide(1)"></span> 
                          <span class="dot" onclick="currentSlide(2)"></span> 
                          <span class="dot" onclick="currentSlide(3)"></span> 
                        </div>
                <h1>Mountain Climbing Categories:</h1>
            
                <div id="boxImg">
                    <img src="../images/trad.jpg" style="width:400px; height: 220px;">
                    Traditional
                </div>
                <div id="boxImg">
                    <img src="../images/mounteen.jpg" style="width:400px; height: 220px;">
                    Mountaineering
                </div>
                <div id="boxImg">
                    <img src="../images/Scramb.jpg" style="width:400px; height: 220px;">
                    Scrambling
                </div>
                <div id="boxImg">
                    <img src="../images/ice.jpg" style="width:400px; height: 220px;">
                    Ice Climbing
                </div>


            </div>  
        </div>

<script>
        var slideIndex = 1;
        showSlides(slideIndex);
        
        function plusSlides(n) {
          showSlides(slideIndex += n);
        }
        
        function currentSlide(n) {
          showSlides(slideIndex = n);
        }
        
        function showSlides(n) {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("dot");
          if (n > slides.length) {slideIndex = 1}    
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";  
          }
          for (i = 0; i < dots.length; i++) {
              dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex-1].style.display = "block";  
          dots[slideIndex-1].className += " active";
        }
        </script>
    </body>
</html>