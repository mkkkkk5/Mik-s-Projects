<!DOCTYPE html>
<html>
    <head>
        <?php 
            $db = new PDO('mysql:host=localhost;dbname=db60094909','60094909','15class01');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            $getCategory = $db -> prepare("select distinct category from mount_category");
            // $getCategory->bindParam(":category", $category);
            $getCategory->execute();
            $category = $getCategory->fetchAll(PDO:: FETCH_OBJ);
        ?>
        <title>ClimbAdvice Home Page</title>
        <link rel="stylesheet" href="style.css">
        <style>
            p{
                text-align: justify;
                font-size: 20px;
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

            #box img{
                width:900px;
                height: 500px;
            }

            #categoryBox{
                background-color: rgba(239, 206, 116, 0.29);
                width: 90%;
                margin:auto;
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

            ul.list {
                text-align: center;
                font-size: 30px;
            }
            li.listing{
                text-align: center;
                font-size: 30px;
            }
            li.1{
                text-align: center;
                color: black;
            }

        </style>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <a href="index.php"><img src='../images/logo.png'></a>
                <ul>
                    <li ><a  class="active" href="index.php">Home Page</a></li>
                    <li ><a  href="category.php">Category</a></li>
                    <li ><a  href="mountain.php">Mountain</a></li>
                    <li ><a  href="images.php">Images</a></li>
                    <li ><a  href="form.php">Form</a></li>
                </ul>
            </div>

            <div id="box">
                <h1>CLIMBADVICE MOUNTENEERING</h1>
                <h2>MOUNTENEERING ACTIVITIES • MAPS • INFORMATION & CLIMBING FANATIC FORUM</h2>
                
                <img src="../images/pic3.png" >

                <h1>Purpose</h1>

                <p>This site is used by people who are looking to explore mountaineering. 
                    It allows you to select a category of mountain climbing activities and we will suggest different mountains for each catergories.
                </p>
                <p>   
                    Users of this website are allowed to leave their reviews of the mountains they have visited for other people to read.
                    
                    So pack your hiking rucksack and be ready for an exciting hiking experience.
                </p>
                <br>
            
                <h1>Mountain Climbing Categories:</h1><br>
                    
                    <?php 
                        foreach($category as $cat){
                            echo "<p class='1'><a href='catcatmount.php?category=$cat->category'>$cat->category</p><br>";
                       }
                    ?>
                
            </div>
        </div>
    </body>
</html>