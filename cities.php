<?php
$connection = mysqli_connect("localhost:3307","root","","usersdata");
if (!$connection) {
    die("<script>alert('Connection Failed.')</script>");            //σύνδεση//
}
    session_start();
    $cities = $_SESSION['city'];
    $city = "SELECT username FROM userstable WHERE city='$cities'";
    $next = mysqli_query($connection, $city);
    $ro = mysqli_num_rows($next);

    ?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="main.css">
        <title>Search</title>
        <meta charset="UTF-8">
    </head>
      <body>
        <div class="nav">
            <a href="index.php"> <h2>Αρχική</h2> </a>          <!---μενού--->
            <div id="right">
                <a href="login.php"> <h2>Σύνδεση</h2></a>
                <a href="register.php"><h2>Εγγραφή</h2></a>
            </div>

        </div>
        <div class="f">
            <h3> Βρέθηκαν αυτοί-ες οι τύποι-ισσες:</h3>
        </div>
        <div class="tbl">

               <?php
                if ($ro > 0) {
                    while ($r = mysqli_fetch_assoc($next)) {
                        echo "<a href='result.php?profil=".$r['username']."'>                  <!---δείχνει τα αποτελέσματα--->
                             <div class='tbl-in'><p> Όνομα: </br>".$r['username']."</p></div>    <!---αν υπάρχει κάποιος από αυτή την πόλη σε στέλνει στο result με ματαβλητή profil= με το username--->
                              </a>";
                        }
                }
            ?>
        </div>


     </body>
    </html>

