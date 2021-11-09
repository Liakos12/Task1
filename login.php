<?php
$connection = mysqli_connect("localhost:3307","root","","usersdata");
if (!$connection) {                                  //παλι σύνδεση.. θα μπορούσα να το κάνω με include αλλά βαριόμουν...//
    die("<script>alert('Connection Failed.')</script>");
}

session_start();

    if ( isset($_POST["submit"])) {
        $mail = $_POST['mail'];
        $password = md5($_POST['password']);

        $sqll = "SELECT * FROM userstable WHERE mail='$mail' AND password='$password'"; // εισάγει στις μεταβλητές τα δεδομένα του χρήστη//
        $resultl = mysqli_query($connection, $sqll);
            if (mysqli_num_rows($resultl) >= 1 ) {
                $rowl = mysqli_fetch_assoc($resultl);
                $_SESSION['username'] = $rowl['username'];  //αν υπάρχουν καλώ την into.php//
                header("Location: into.php");
            } else {
                echo "<script>alert('Λάθος Email!')</script>"; //αλλιώς πάλι αυτο.. ξερω δεν είναι ωραίο..//
            }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="nav">
    <a href="index.php"> <h2>Αρχική</h2> </a>
    <div id="right">
        <a href="login.php"> <h2>Σύνδεση</h2></a>           <!---μενού--->
        <a href="register.php"><h2>Εγγραφή</h2></a>
    </div>

</div>

<div class=welcome>
    <h3>Σύνδεση</h3>
    <form method="POST" action="" class="log">
        <input type="text" placeholder="Email" name="mail" required> </br>
        <input type="password" placeholder="Κωδικός" name="password" required> </br>        <!--- η φόρμα για το login--->
        <input type="submit" value="Σύνδεση" name="submit" id="btn"> </br>
        <p> Έχετε λογαριασμό: <a href="register.php"> Εγγραφή </p>      <!---σε πετάει στο register--->
    </form>
</div>
</body>
</html>

