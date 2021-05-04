<!DOCTYPE html>
<html>
    <head>
        
        <title>ClimbAdvice Form Page</title>
        <link rel="stylesheet" href="style.css">
        <style>
            span{
                color: red;
            }
            #formBox{
                background-color: rgb(247, 247, 244);
                font-size: 20px;
                text-align: center;
                padding: 20px;
            }
            input,option,button{
                font-size: 20px;
                
            }
            select{
                font-size: 20px;
            }
            textarea{
                font-size: 20px;
                margin: 5%;
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
                    <li ><a  href="mountain.php">Mountain</a></li>
                    <li ><a  href="images.php">Images</a></li>
                    <li ><a  class="active" href="form.php">Form</a></li>
                </ul>
            </div>

            <div id="box">
                <h1>Leave a Review</h1>
                <div id="formBox">
                <form action="insertForm.php" method="POST">
                    Name: 
                    <input type="text" placeholder="Enter name" name="name" id="name">
                    <span id="nameValidity"></span><br>
                    <br>
                    Email: 
                    <input type="text" placeholder="johndoe@email.com" name="email" id="email">
                    <span id="emailValidity"></span><br>
                    <br>
                    
                    Mountain:
                    <select name="mountain" id="mountain">
                        <option value="Select" readonly >Select</option>
                        <option value="1">Kilimanjaro</option>
                        <option value="2">Everest</option>
                        <option value="3">K2</option>
                        <option value="4">Elbert</option>
                        <option value="5">Olympus</option>
                        <option value="6">Appalachian</option>
                    </select><span id="mountValidity"></span><br><br>
                    
                    Difficulty: 
                    <input type="number" placeholder="Enter 1-10, 10 most difficult" name="difficulty" id="difficulty">
                    <span id="difValidity"></span><br>
                    <br>
                  
                    Comment:<br>
                    <textarea id="comment" name="comment" style="width:90%; height:300px;">Enter your over all experience here.
                    </textarea>
                    <span id="commentValidity"></span><br><br>
                    
                    <button id="sub" disabled>Submit</button><br>
                </form>
                <br><button onclick="check()">Check</button>
            </div>
            </div>
        </div>

        <script>
            function check(){
                let errorCount = 0
        
                let name = document.getElementById("name").value
                let email = document.getElementById("email").value
                let mount = document.getElementById("mountain").value
                let diff = document.getElementById("difficulty").value
                let comment = document.getElementById("comment").value

                let testInteger = new RegExp("^[0-9]+$")
                
                
                    if(name.length <= 0){
                        document.getElementById("nameValidity").innerHTML = "Invalid. Name is reqiured."
                        errorCount += 1 
                    }else{
                        document.getElementById("nameValidity").innerHTML = ""
                    }
                    
                    if (email.includes('@') === false){
                        document.getElementById("emailValidity").innerHTML = "Invalid. Email is required to have 1 @ symbol."
                        errorCount += 1 
                    }else{
                        document.getElementById("emailValidity").innerHTML = ""
                    }

                    if(mount == "Select"){
                        document.getElementById("mountValidity").innerHTML = "Invalid. mount is reqiured."
                        errorCount += 1 
                    }else{
                        document.getElementById("mountValidity").innerHTML = ""
                    }

                    if(comment.length <= 0){
                        document.getElementById("commentValidity").innerHTML = "Invalid. Comment is reqiured."
                        errorCount += 1 
                    }else{
                        document.getElementById("commentValidity").innerHTML = ""
                    }

                    if (testInteger.test(diff)=== false){
                        document.getElementById("difValidity").innerHTML = "Invalid. Please input a number."
                        errorCount += 1 
                    }else{
                        document.getElementById("difValidity").innerHTML = ""
                    }

                if(errorCount > 0){
                    document.getElementById("sub").disabled = true
                }else{
                    document.getElementById("sub").disabled = false
                    
                    // document.getElementById("form").innerHTML = "action="insertForm.php" method="POST""
                }
            }
        </script>
    </body>
</html>