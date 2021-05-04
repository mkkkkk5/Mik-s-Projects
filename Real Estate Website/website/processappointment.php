<?php 
      $db = new PDO('mysql:host=localhost;dbname=db60095680','60095680','peb9cnyt');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

      $getLoc = filter_input(INPUT_POST, "loc");
      $date = filter_input(INPUT_POST, "appdate");
      $time = filter_input(INPUT_POST, "apptime");
      $status = filter_input(INPUT_POST, "status");
      $client = filter_input(INPUT_POST, "client");
      $agent = filter_input(INPUT_POST, "agent");

      $insert = "insert into Appointment (location, date, time, status , client_id, agent_id) values('$getLoc', '$date', '$time', '$status', $client, $agent)";
      $sendDb = $db->prepare($insert);
      $sendDb->execute();

      header('Location:bookappointment.php')
?>