<?php
session_start();

// Vérifiez si le patient est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Changez cela si nécessaire
$password = ""; // Changez cela si nécessaire
$dbname = "cabinet";

// Créez la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifiez si une note a été soumise
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['note'])) {
    $note = $conn->real_escape_string($_POST['note']);
    $username = $_SESSION['username'];
    $doctor = $_POST['ID_DU_Doctor'];
    $sql = "INSERT INTO note (text, username,doctor) VALUES ('$note', '$username','$doctor')";

    if ($conn->query($sql) === TRUE) {
        $message = "Nouvelle note enregistrée avec succès";
    } else {
        $error = "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .text-border {
            color: white;
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: #009B9F;
            width: 300px;
            height: 81px;
            left: 70px;
            top: 130px;
            position: absolute;
            font-size: 40px;
            font-family: Inter;
            font-weight: 900;
        }
        .casier{
        width: 90%;
        height: 100%;
        margin: 5% auto;
        position: relative;
        top: 60px;
      }
                button{
      background-color:rgba(0, 0, 0, 0);
      border:none;
    }
    </style>
</head>

<body style="background-color:#009B9F;">


    <div style="background-color:#fff;height:400px;width:100%;margin-top:0px;border-radius:0% 0% 5% 5%;position: fixed;top:0px;left:0px;">


                <form action="../doctors.php" style='position:relative;top:29px;left:14px;'>
            <input type="text" value="note" name="operation" style='display:none;'>
            <button type="submit" style="background-color:rgba(0,0,0,0);border:none">
              <img src="../../images/retourb.png" style="width:50px;heigth:50px;">
            </button>
          </form>



          <form action="../../profile/profile.php" method="POST" class="action_btn rounded-full w-16 h-16 flex justify-center items-center" style="width: 70px; height: 70px;border-radius: 100%; display:flex;justify-content:center;align-items:center;position:relative;bottom:24px;left:75%;">
          <input type='text' name='ID_DU_USER' value='<?php echo $_SESSION['username']?>' style='display:none;'>
          <button type="submit" >
            <img src=<?php echo "'" . $_SESSION["userimage"] . "'";?> alt=""  style="width:70px;height:70px;border-radius:100%;border: 2px #009B9F solid ;">
          </button>
        </form>    
    </div>
    <div class="casier">

        <h1 style="position:relative;top:10px;left:0px;bottom:0px;text-align:center;width:100%" class="text-border">Ecrire une note a <?php echo $_POST['ID_DU_Doctor'];?></h1>

          <form method="POST" action="note.php" style='padding:40px;background: white; border-radius: 30px; border: 1px #009B9F solid;'>
                <input type='text' name='ID_DU_Doctor' value="<?php echo $_POST["ID_DU_Doctor"]?>" style='display:none;'>
                <label for="note">Écrire une note :</label><br>
                <textarea id="note" name="note" rows="5" cols="40" required></textarea><br><br>
                <input type="submit" value="Enregistrer">
          </form>


            <!-- Affichage des notes existantes -->
            <h3 >Notes existantes :</h3>
            <div style="overflow-y: scroll;">
                <?php
                $username = $_SESSION['username'];
                $doctor = $_POST['ID_DU_Doctor'];
                $sql = "SELECT * FROM note WHERE username='$username' and doctor='$doctor'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div style='border-bottom: 1px solid #ccc; padding: 10px;'>";
                        echo "<h2 style='margin-right:0px;color:#ccc;'>".$row['doctor'].":</h2><p>" . $row['text'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "Aucune note trouvée.";
                }
                ?>
            </div>

    </div>


</body>
</html>
