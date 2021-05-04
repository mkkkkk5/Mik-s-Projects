<?php 
      $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

      $homeType = filter_input(INPUT_POST, "hometype");
      $seller = filter_input(INPUT_POST, "seller");
      $dbType = filter_input(INPUT_POST, "dbtype");
      $getLoc = filter_input(INPUT_POST, "loc");
      $address = filter_input(INPUT_POST, "addr");
      $rpm = filter_input(INPUT_POST, "rent");
      $sellingPrice = filter_input(INPUT_POST, "price");
      $details = filter_input(INPUT_POST, "details");

      $insert = "insert into Real_Estate (type, location, db_id, seller_id) values('$homeType', '$getLoc', $dbType, $seller)";
      $sendDb = $db->prepare($insert);
      $sendDb->execute();

      $getEstate = $db->prepare("select * from Real_Estate where type='{$homeType}' and location='{$getLoc}' and db_id='{$dbType}' and seller_id='{$seller}'");
      $getEstate->execute();
      $estate = $getEstate->fetch(PDO::FETCH_OBJ);
      $e = $estate->re_id;

      if($homeType == "Compound"){
            $insert = "insert into Compound_Villa (address, rent_per_month, selling_price, details, re_id) values('$address', $rpm, $sellingPrice, '$details', $e)";
            $sendDb = $db->prepare($insert);
            $sendDb->execute();
      }
      if($homeType == "Apartment"){
            $insert = "insert into Apartment (address, rent_per_month, selling_price, details, re_id) values('$address', $rpm, $sellingPrice, '$details', $e)";
            $sendDb = $db->prepare($insert);
            $sendDb->execute();
      }
      if($homeType == "Island"){
            $insert = "insert into Island (address, rent_per_month, selling_price, details, re_id) values('$address', $rpm, $sellingPrice, '$details', $e)";
            $sendDb = $db->prepare($insert);
            $sendDb->execute();
      }
      if($homeType == "House"){
            $insert = "insert into House (address, rent_per_month, selling_price, details, re_id) values('$address', $rpm, $sellingPrice, '$details', $e)";
            $sendDb = $db->prepare($insert);
            $sendDb->execute();
      }
      
      header('Location:sellercontract.php')
?>