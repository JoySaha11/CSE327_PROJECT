<?php
// error_reporting(0);

/**
*Connect Sql file with database
**/
$conn = new mysqli("localhost", "root", "", "CSE327_project");

if (mysqli_connect_errno()) {
     echo "cannot connect";
} else {
     echo "connected";
}

/***
*Variable decleration for sign up page
 */


if (isset($_POST['Signup'])) {
     $first_name = mysqli_real_escape_string($conn, $_REQUEST["First_Name"]);
     $last_name = mysqli_real_escape_string($conn, $_REQUEST['Last_Name']);
     $user_email = mysqli_real_escape_string($conn, $_REQUEST['email']);
     $user_phone = mysqli_real_escape_string($conn, $_REQUEST['number01']);
     $usr_date_of_b = mysqli_real_escape_string($conn, $_REQUEST['birthdate1']);
     $user_country = mysqli_real_escape_string($conn, $_REQUEST['country1']);
     $user_join_date = mysqli_real_escape_string($conn, $_REQUEST['joindate1']);
     $user_password = mysqli_real_escape_string($conn, $_REQUEST['pass_word']);

 /*
     * Insert the value in registration table
*/
     $sql = "INSERT INTO `registration`(`Firstname`, `Lastname`, `Email`, `PhoneNumber`, `DateOfBirth`, `Country`, `JoiningDate`, `Password`) VALUES
                    (' $frist_name','$last_name',' $user_email','$user_phone','$user_date_o_fb','$user_country',' $user_join_date','$user_password')";

               

     if ($conn->query($sql) === TRUE) {
          echo "Records added successfully.";
          //header("Location:login.php")
     } else {
          echo "ERROR: Could not able to execute . ";
          exit();
     }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <link rel="stylesheet" href="style_sign_up.css">
     <title>Sign Up page</title>
</head>

<body>

     <div class="sign_up">
          <h1>SIGN-UP FORM</h1>
     </div>
     <form method="POST">
          <div class="main">


               <h2 class="name">Name</h2>
               <input class="Firstname" type="text" name="First_Name" placeholder="Enter Your First Name">
               <input class="Lastname" type="text" name="Last_Name" placeholder="Enter Your Last Name">

               <h2 class="name">Email</h2>
               <input class="email" type="text" name="email" placeholder="Enter Valid Email Address">

               <h2 class="name">Phone_Number</h2>
               <input class="number" type="num" name="number01" placeholder="Enter Valid Phone Number">

               <h2 class="name">Date_Of_Birth</h2>
               <input class="birthdate" type="date" name="birthdate1">
               <h2 class="name">Country</h2>
               <input class="country" type="text" name="country1" placeholder="Select Country">

               <h2 class="name">Joining_Date</h2>
               <input class="joindate" type="date" name="joindate1">
               <h2 class="name">Password</h2>
               <input class="password" type="text" name="pass_word" placeholder="Enter Passwprd">
               <!-- <input class="repassword" type="text" name="re_password" placeholder="Re Enter Your Password">-->
               <button type="submit" name="Signup">Submit</button><br><br><br>

          </div>
     </form>
     </div>
</body>

</html>

