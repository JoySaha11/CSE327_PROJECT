<?php

/**
     * cse327_project connected the database in localhost.
     *
     * mysqli_connect_errno show in cannot connect
     * otherwise show connnect
 */

$conn = new mysqli("localhost", "root", "", "cse327_project");

if (mysqli_connect_errno()) {
     echo "cannot connect";
} else {
     echo "connected";

     /**
     * variable declare for contact us page.
     *
     * insert the value from contact_us table.
     * 
     */

     if (isset($_POST['submit1'])) {
        $user_name = $_POST['name1'];
        $user_email = $_POST['email1'];
        $user_message = $_POST['message1'];

        $sql ="INSERT INTO `contact_us`(`name`, `email`, `message`) VALUES (' $user_name','$user_email','$user_message')";

        if ($conn->query($sql) === TRUE) {
            echo "Your message has been sent successfully.";
            
       } else {
            echo "ERROR: Could not able to execute . ";
            exit();
       }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style/contactstyle.css">
    
  </head>
  <body>

<div class="contact-section">
<h1>Contact Us</h1>
  <div class="border"></div>
  <form class="contact-form" method="post">
<h2 class = "name"> Name </h2>
    <input type="text" class="contact-form-text"  name = "name1">
<h2 class = "email"> Email </h2>
    <input type="email" class="contact-form-text" name = "email1">
   <h2 class = "message"> Message </h2> 
    <textarea class="contact-form-text" name = "message1"> </textarea>
    <input type="submit" class="contact-form-btn" name="submit1" value="Send">
  </form>

</div>

  </body>
</html>