<?php
$connection = mysqli_connect("localhost:3307","root","","usersdata");   //κάνω σύνδεση με την database//
if (!$connection) {
    die("<script>alert('Connection Failed.')</script>");
}
session_start();

 $cities = $_POST['search'] ?? "";
 $city = "SELECT * FROM userstable WHERE city='$cities'";
 $resultc = mysqli_query($connection, $city);

if ( isset($_POST["submitsrch"]) AND !$cities == "") {
    if (mysqli_num_rows($resultc) >= 1) {
        $rowc = mysqli_fetch_assoc($resultc);      //αν πατήσει το κουμπί βάζω στην session την πόλη για να την μεταφέρω στο cities//
        $_SESSION['city'] = $rowc['city'];          // χμ θα μπορούσα να το κάνω και καλώντας μία άλλη php βαζοντας μεταβλητή//
        header("Location: cities.php");         //όπως έκανα με το profil... αλλα δεν ξερω τι ειναι καλύτερο//
    } else {
        echo "<script>alert('Δεν βρέθηκε κάποιος στην περιοχή σας!')</script>"; //είπα να δοκιμάσω αυτή τη μαλακία, ετσι για πλάκα...//
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="main.css"> <!---σύνδεση με την css--->
</head>
<body>
    <div class="nav">
        <a href="index.php"> <h2>Αρχική</h2> </a>
        <div id="right">
            <a href="login.php"> <h2>Σύνδεση</h2></a>           <!---το μενού--->
            <a href="register.php"><h2>Εγγραφή</h2></a>
         </div>

    </div>

    <div class="searchform">
        <h3>Ψάξε την περιοχή</h3>
        <form autocomplete="off" method="POST" action="" class="srch">              <!---αναζήτηση--->
             <input type="text" placeholder="Περιοχή" id="search" name="search">
            <input type="submit" value="Αναζήτηση" name="submitsrch"> </br>
        </form>
    </div>
    <div class="tsodes">
        <a href="#" name="logout"><h2>Εκπληκτικό! Δείτε πως έβγαλε 1.000.000$ μόνο σε 2 ημέρες!</h2></a>    <!---μαλακίες!--->
    </div>

</body>
</html>