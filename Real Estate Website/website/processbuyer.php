<?php 
      $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

      $approval = filter_input(INPUT_POST, "approval");
      $terms = filter_input(INPUT_POST, "terms");
      $startDate = filter_input(INPUT_POST, "startdate");
      $endDate = filter_input(INPUT_POST, "enddate");
      $realEstate = filter_input(INPUT_POST, "loc");
      $client = filter_input(INPUT_POST, "client");
      $agent = filter_input(INPUT_POST, "agent");
      $finance = filter_input(INPUT_POST, "finance");
      $appointment = filter_input(INPUT_POST, "app");

      $insert = "insert into Contract (approval_status, terms_of_contract, date_of_production, date_of_expiration, finance_id, re_id, agent_id, client_id, appointment_id) values('$approval', '$terms', '$startDate', '$endDate', $finance, $realEstate, $agent, $client, $appointment)";
      $sendDb = $db->prepare($insert);
      $sendDb->execute();

      header('Location:buyercontract.php')
?>