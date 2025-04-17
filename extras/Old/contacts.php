<?php
  

    $mailFrom = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['Message'];
    
    $mailTo = "notify@pratimeshtiwari.com";
    $subject = "Text ".$subject;
    $headers = "From:Contact";
    $txt = "Email From ".$mailFrom." from notify me page by ".$name.".\n\n".$message;
    
    mail($mailTo,$subject,$txt,$headers);
    header("Location: index.html?thankyou");

?>
