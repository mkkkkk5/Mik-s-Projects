<?php
    $mountain = filter_input(INPUT_POST,"mountain");
    $name = filter_input(INPUT_POST,"name");
    $email = filter_input(INPUT_POST,"email");
    $difficulty = filter_input(INPUT_POST,"difficulty");
    $comment = filter_input(INPUT_POST,"comment");

    $db = new PDO('mysql:host=localhost;dbname=db60094909','60094909','15class01');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $sql = "insert into review (mountain,email,name,difficulty,comments) values($mountain, '$email', '$name', '$difficulty', '$comment')";
    $getSD = $db->prepare($sql);
    $getSD->execute();

    header('Location:form.php');
?>