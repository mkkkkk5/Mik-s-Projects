<!DOCTYPE html>
<html>
    <head>
    <?php 
            $db = new PDO('mysql:host=localhost;dbname=db60094909','60094909','15class01');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            
            $getMountain = $db -> prepare("select name,photo from mountain");
           
            $getMountain->execute();
            $mountain=$getMountain->fetchAll(PDO:: FETCH_OBJ);
            
            
        ?>

        <title>ClimbAdvice Home 
        <title>ClimbAdvice Mountain Page</title>
        <link rel="stylesheet" href="style.css">
        <style>
            #boxImg{
                float: left;
                width: 47%;
                height: 20%;
                margin: 12px;
                text-align: center;
            }

            img{
                width: 400px;
                height: 250px;
            }
            select,option{
                font-size: 20px;
            }
            p{
                text-align: left;
                font-size: 30px;
            }
            
            #list li{
                font-size: 20px;
                float: none;
                background-color: rgb(169, 199, 222);
                list-style-type: circle ;
                overflow: auto;
                border: 0;
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

            

        </style>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <a href="index.php"><img src='../images/logo.png'></a>
                <ul>
                    <li ><a  href="index.php">Home Page</a></li>
                    <li ><a  href="category.php">Category</a></li>
                    <li ><a  class="active" href="mountain.php">Mountain</a></li>
                    <li ><a  href="images.php">Images</a></li>
                    <li ><a  href="form.php">Form</a></li>
                </ul>
            </div>

            <div id="box">
                <h1>Mountain Category</h1>
                
                <?php 
                    foreach($mountain as $mount){
                        echo "<div id='boxImg'>
                        <a href='$mount->name.php?mountain=$mount->name'>
                            <img src='../images/$mount->photo'>
                            </a><br>
                        $mount->name
                    </div> ";
                    }
                ?>
              
                
            </div>
        </div>
    </body>
</html>