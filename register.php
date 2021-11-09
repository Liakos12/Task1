<?php
$connection = mysqli_connect("localhost:3307","root","","usersdata");
if (!$connection) {
    die("<script>alert('Connection Failed.')</script>");
}

session_start();
    $username = $_POST['username'] ?? "";
    if ( isset($_POST["submit"]) AND !$username == "") {

         $fullname = $_POST['fullname'];                //αν πατήσεις το κουμπί και τα έχεις βάλει όλα...//
         $mail = $_POST['mail'];
         $city = $_POST['city'];
         $password = md5($_POST['password']);

         $sqlm = "SELECT * FROM userstable WHERE mail='$mail'";
         $resultm = mysqli_query($connection, $sqlm);
            if (mysqli_num_rows($resultm) >= 1 ) {
                 echo "<script>alert('Woops! Email is Wrong.')</script>";
             } else {
                $sqlm = "INSERT INTO userstable (username, fullname, mail, password, city) VALUES ('$username', '$fullname', '$mail', '$password' , '$city')";
                $resultm = mysqli_query($connection, $sqlm);  //.. προσθέτει στην database//
             }

    }

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="main.css">
  </head>
  <body>
  <div class="nav">
      <a href="index.php"> <h2>Αρχική</h2> </a>
      <div id="right">                                  <!---μενού--->
          <a href="login.php"> <h2>Σύνδεση</h2></a>
          <a href="register.php"><h2>Εγγραφή</h2></a>
      </div>

  </div>
    <div class=welcome>
      <h3>Εγγραφή</h3>
      <form method="POST" action="" class="log">
        <input type="text" placeholder="Όνομα Χρήστη-τριας" name="username" required> </br>
          <input type="text" placeholder="Oνοματεπώνυμο" name="fullname" required> </br>
        <input type="password" placeholder="Κωδικός" name="password" required> </br>        <!---φόρμα registe--->
        <input type="text" placeholder="Email" name="mail" required> </br>
        <input type="text" placeholder="Περιοχή" name="city" required> </br>
          <input type="submit" value="Εγγραφή" name="submit" id="btn"> </br>
        <p> Έχετε λογαριασμό <a href="login.php"> Σύνδεση </p>              <!---σε πετάει στο login--->
      </form>
    </div>
  </body>
</html>
