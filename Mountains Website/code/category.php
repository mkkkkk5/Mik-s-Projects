

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
        <title>ClimbAdvice Category Page</title>
        <link rel="stylesheet" href="style.css">
        <style>
            p{
                text-align: justify;
                font-size: 20px;
            }
            table, th, td{
                border: 1px solid black;
                border-collapse: collapse;
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

            #boxImg{
                float: left;
                width: 47%;
                height: 20%;
                margin: 12px;
                text-align: center;
                
                
            }
            img{
                width:100%;
                height: 100%;
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
                    <li ><a  href="index.php">Home Page</a></li>
                    <li ><a  class="active" href="category.php">Category</a></li>
                    <li ><a  href="mountain.php">Mountain</a></li>
                    <li ><a  href="images.php">Images</a></li>
                    <li ><a  href="form.php">Form</a></li>
                </ul>
            </div>

            <div id="box">
                <h1>Mountain Climbing Categories:</h1>
                <?php 
                    foreach($category as $cat){
                            echo "<p class='1'><a href='catcatmount.php?category=$cat->category'>$cat->category</p><br>";
                    }
                ?>
                
            </div>
        </div>
    </body>
</html>
