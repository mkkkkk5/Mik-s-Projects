<!DOCTYPE html>
<html>
    <head>
    <?php 
            $db = new PDO('mysql:host=localhost;dbname=db60094909','60094909','15class01');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $mountname = filter_input(INPUT_GET,"mountain");  
            $getMountain = $db -> prepare("select id,name,photo from mountain where name=:mountain");
            $getMountain->bindParam(":mountain",$mountname);
            $getMountain->execute();
            $mountain=$getMountain->fetchAll(PDO:: FETCH_OBJ);

            // $revid=filter_input(INPUT_GET,"mountain");  where mountain=:revid
            $getRev = $db -> prepare("select mountain,email,name,difficulty,comments from review");
            // $getRev->bindParam(":revid",$mountain->'1');
            $getRev->execute();
            $review=$getRev->fetchAll(PDO::FETCH_OBJ);

        ?>
        <title>ClimbAdvice Mountain Details Page</title>
        <link rel="stylesheet" href="style.css">
        <style>
            #boxRev{
                width: 90%;
                margin: 5px auto;
                background-color: #c6d6e2;
                text:black;
                border: 1px solid #1C2353;
                padding: 10px;
            }
            #boxRev img{
                
                border-radius: 50%;
                float: right;
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
                    <li ><a  href="category.php">Category</a></li>
                    <li ><a  class="active" href="mountain.php">Mountain</a></li>
                    <li ><a  href="images.php">Images</a></li>
                    <li ><a  href="form.php">Form</a></li>
                </ul>
            </div>

            <div id="box">
                <h1>Mounatian: <?php echo "$mountname"?></h1>
                <br>
                
                <?php 
                    foreach($mountain as $mount){
                        echo"<img src='../images/$mount->photo' ><br> ";
                        
                    }  
                ?>
                
                <br>
                <p>Mount Kilimanjaro or just Kilimanjaro, with its three volcanic cones, Kibo, Mawenzi, and Shira, is a dormant volcano in Tanzania.</p><br>
                Elevation: 5,895 m<br>
                Location: Tanzania<br>

                
                <h1>Reviews</h1>
                <?php 
                    foreach($review as $reve){
                        if($reve->mountain == "1"){
                            echo"<div id='boxRev'>
                            <img src='../images/av.jpg' style='width: 70px;
                                height:70px;'>
                                Name: $reve->name<br>
                                Email: $reve->email<br>
                                Difficulty: $reve->difficulty<br>
                                Comment: $reve->comments<br>
                                </div>
                            ";
                        }
                        
                    }  
                ?>
                

                <a style="float: right;" href="mountain.php">Go back to Mountain Page</a>
                <br>
                <a style="float: right;" href="form.php">Leave a review</a>
            </div>
        </div>
    </body>
</html>