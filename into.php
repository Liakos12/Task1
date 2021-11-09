<?php
$connection = mysqli_connect("localhost:3307","root","","usersdata");
if (!$connection) {                                         //σύνδεση//
    die("<script>alert('Connection Failed.')</script>");
}
session_start();

if ( isset($_POST["logout"])) {
    unset($_SESSION["name"]);       //κάνει logout//
    header("Location:login.php");
}

?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="nav">
        <a href="into.php"> <h2>Αρχική</h2> </a>
        <div id="right">                                <!---μενού--->
            <a href="login.php"> <h2>Αποσύνδεση</h2></a>
        </div>
    </div>
    <div class="well">
        <?php echo "<h1>Καλωσήρθες ψηλέ/η μου, " . $_SESSION['username'] . " !!</h1>"; ?>   <!---παίρνει το όνομα από το login--->
    </div>
    <div class="upload">
        <p>Πάτησε το κουμπί για να ανεβάσεις τη φωτό:</p>           <!---φόρμα για να ανεβάσει φωτό--->
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="file" name="image">
            <input type="submit" name="up" value="Upload">
        </form>
    </div>
    <div class="apot">
        <p>
            <?php
           $statusMsg = '';
            $u = $_SESSION['username'];
            if(isset($_POST["up"])){        //αν πατήσει το κουμπί//

                if(!empty($_FILES["image"]["name"])) {
                    $dir = "upload/";
                    $fileName = $dir.basename($_FILES["image"]["name"]);    //ονομα//
                    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);       //τύπος//


                    $allowTypes = array('jpg','png','jpeg');
                    if(in_array($fileType, $allowTypes)){           //τσεκάρω να είναι εικόνες//
                        $image = $_FILES['image']['tmp_name'];
                        $imgContent = addslashes(file_get_contents($image));

                        $de =  "UPDATE userstable SET image='$imgContent' WHERE username= '$u'";    //βάζω την εικόνα στον αντίστοιχο user//
                        $fn =  "UPDATE userstable SET imagename='$fileName' WHERE username= '$u'"; //και βάζω και δίπλα το όνομα της εικόνας//
                        $next = mysqli_query($connection, $de);                                     // δεν ήξερα τι είναι προτιμότερο και έτσι και ανέβασα την εικόνα και το όνομα..//
                        $next = mysqli_query($connection, $fn);
                        if($next){
                            move_uploaded_file($_FILES["image"]["tmp_name"], "$fileName");  //αν γίνε//
                            $statusMsg = "Έλα ρεεε!"; //εμφανίζω μνμ!//
                        }else{
                            $statusMsg = "Λυπάμαι γλυκιά μου..";
                        }
                    }else{
                        $statusMsg = 'Εικόνα ρε..';
                    }
                }else{
                    $statusMsg = 'Διάλεξε μια εικόνα να ανεβάσεις.';
                }
            }

            echo $statusMsg;
            ?>

        </p>
    </div>


</body>
</html>