<!DOCTYPE html>
<html>
    <head>
    <?php 
            $db = new PDO('mysql:host=localhost;dbname=db60094909','60094909','15class01');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
            $catname = filter_input(INPUT_GET,"category");        
            $getCategory = $db -> prepare("select mountain from mount_category where category=:mountaineering");
            $getCategory->bindParam(":mountaineering",$catname);
            $getCategory->execute();
            $category = $getCategory->fetchAll(PDO::FETCH_OBJ);

            $sum = 0;
            $count = 0;
        ?>
        <title>Database Category Page</title>
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
                width:100%;
                height: 100%;
            }
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
                    <li ><a  href="index.php">Home Page</a></li>
                    <li ><a  class="active" href="category.php">Category</a></li>
                    <li ><a  href="mountain.php">Mountain</a></li>
                    <li ><a  href="images.php">Images</a></li>
                    <li ><a  href="form.php">Form</a></li>
                </ul>
            </div>

            <div id="box">
                <h1>Category: <?php echo "$catname"?></h1>
                <?php 
//                        yeet
                        foreach($category as $mount){
                                $getRev = $db->prepare("select difficulty from review where mountain=:revid");
                                $getRev->bindParam(":revid",$mount->mountain);
                                $getRev->execute();
                                $review = $getRev->fetchAll(PDO::FETCH_OBJ);
                                foreach ($review as $rev){
                                    $sum = $sum+ $rev->difficulty;
                                    $count = $count + 1;
                            }
                            $avg = round($sum/$count);
                                        
                                $getMountain = $db->prepare("select distinct name,photo from mountain where id=:mountid");
                                $getMountain->bindParam(":mountid",$mount->mountain);
                                $getMountain->execute();
                                $mountains = $getMountain->fetch(PDO::FETCH_OBJ);

                            echo "<div id='boxImg'><a href='$mountains->name.php?mountain=$mountains->name'><img style='width: 250px; height: 150px;' src='../images/$mountains->photo'></a><br>
                            Name: $mountains->name <br> Average difficulty: $avg
                            </div>";
                        }  
                    ?>
                    <br><br>
                <a style="float: right;" href="category.php">Go back to Mountain Category Page</a>
            </div>
        </div>
    </body>
</html>