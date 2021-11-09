<?php
    $connection = mysqli_connect("localhost:3307","root","","usersdata");
    if (!$connection) {
    die("<script>alert('Connection Failed.')</script>");            //σύνδεση//
    }
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
    <div class="nav">
        <a href="index.php"> <h2>Αρχική</h2> </a>
        <div id="right">                                <!---μενού--->
            <a href="login.php"> <h2>Σύνδεση</h2></a>
            <a href="register.php"><h2>Εγγραφή</h2></a>
        </div>

    </div>
    <div class="result-tbl">
            <?php
                $useract = mysqli_real_escape_string($connection,$_GET['profil']);
                $useractiv = "SELECT * FROM userstable WHERE username='$useract'";      //παίρνει το profil από την cities//
                $next = mysqli_query($connection, $useractiv);                          //και διαλέγει όλα του τα στοιχεία//
                $ro = mysqli_num_rows($next);

            if ($ro > 0) {
                while ($r = mysqli_fetch_assoc($next)) {
                    echo "
                     <div class='result'>
                     <h1> Όνομα: </br>" . $r['username'] . "</h1>        <!---και εμφανίζει την κάθε γραμμή του αντίστοιχου πίνακα--->
                     <h1> Στοιχεία Επικοινωνίας: </br>" . $r['mail'] . "</h1>
                     <h1> Περιοχή: </br>" . $r['city'] . "</h1>
                     </div>";

                    echo "<img src='".$r['imagename']."' width=\"200\" height=\"200\" >";    // εμφανίζει τη φωτό του χρήστη//
                }
            }
            ?>


    </div>
    </body>
</html>