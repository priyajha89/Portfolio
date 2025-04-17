<?php
  

    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $mailFrom = $_POST['email'];
    $message = $_POST['message'];
    
    $mailTo = "support@techbuddiez.in";
    $headers = "From: ".$mailFrom;
    $txt = "Email From Techbuddies from visitor".$name.".\n\n".$message;
    
    mail($mailTo,$subject,$txt,$headers);
    header("Location: index.html?mailsend");

?>
