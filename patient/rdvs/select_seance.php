<!DOCTYPE html>
<html>

<head>
    <title>Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .columns{
    display: flex;
    flex-wrap: wrap;
}

.columns input[type='radio'] {
    flex: 1 1 calc(33.3333% - 10px); 
    margin: 8px;
}
.columns label{
    flex: 1 1 calc(66.666% - 100px); 
    margin: 10px;
}
#success_message{
    background-color: rgba(0, 0, 255, 0.6);
    z-index: 100;
    display: flex;
    justify-content:center;
    align-items: center;
    padding: 10px;
    border-radius: 10px;
    color: white;
    font-size: large;
  }
  #error_message{
    background-color: rgba(255, 0, 0, 0.6);
    z-index: 100;
    display: flex;
    justify-content:center;
    align-items: center;
    padding: 10px;
    border-radius: 10px;
    color: white;
    font-size: large;
  }
        .text-border {
            color: #fff;
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-width:1px;
            -webkit-text-stroke-color: #009B9F;
        }

        .flatpickr-calendar {
            background-color: #fff;
            border: 5px solid #009B9F;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            outline: none;
            position: absolute;
            margin-left: 13%;
            top: 700px;
            left: 2;
            transform: translateX(-10%);
            transform: translateY(70%);
        }
        .flatpickr-day.selected {
         background-color: #009B9F; 
         border:1px solid #009B9F;
}

        #selectedDateTime {
            position: absolute;
            top: 750px; /* Ajustez selon vos préférences */
            left: 50%;
            transform: translateX(-50%);
            font-size: 20px;
            color: black;
            font-weight: bold;
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
          <div style="width:100%;display:flex;flex-direction: column;justify-content: center;z-index: 100;position: absolute;top: 100px;padding: 2%;max-width:405px;gap: 10px;">
        <?php
        session_start();
        // Vérifiez si le paramètre 'message' est présent dans l'URL
        if(isset($_GET['message'])) {
            // Récupérez la valeur de 'message'
            $message = $_GET['message'];
            // Affichez le message dans une balise div avec un identifiant unique
            echo "<div id='success_message' style='opacity: 1; transition: opacity 0.5s ease;'>$message</div>";
        }
        ?>
        <script>
        // Sélectionnez l'élément contenant le message de succès
        var successMessage = document.getElementById('success_message');

        // Vérifiez si l'élément existe
        if(successMessage) {
            // Utilisez setTimeout pour supprimer l'élément après 3 secondes (3000 millisecondes)
            setTimeout(function() {
                // Appliquez une transition pour faire disparaître en douceur
                successMessage.style.opacity = '0';
                // Attendez la fin de la transition avant de supprimer l'élément
                setTimeout(function() {
                    successMessage.remove();
                }, 500); // Attendre la fin de la transition (0.5s) avant de supprimer l'élément
            }, 3000);
        }
        </script>

        <?php
        // Vérifiez si le paramètre 'error' est présent dans l'URL
        if(isset($_GET['error'])) {
            // Récupérez la valeur de 'error'
            $error = $_GET['error'];
            
            // Affichez le message d'erreur dans une balise div avec un identifiant unique
            echo "<div id='error_message'>$error</div>";
        }
        ?>
        <script>
        // Sélectionnez l'élément contenant le message d'erreur
        var errorMessage = document.getElementById('error_message');

        // Vérifiez si l'élément existe
        if(errorMessage) {
            // Utilisez setTimeout pour supprimer l'élément après 3 secondes (3000 millisecondes)
            setTimeout(function() {
                          // Appliquez une transition pour faire disparaître en douceur
                errorMessage.style.opacity = '0';
                // Attendez la fin de la transition avant de supprimer l'élément
                setTimeout(function() {
                    errorMessage.remove();
                }, 500); // Attendre la fin de la transition (0.5s) avant de supprimer l'élément
            }, 3000);
        }
        </script>
      </div>



    <div style="background-color:#fff;height:400px;width:100%;margin-top:0px;border-radius:0% 0% 5% 5%;position: fixed;top:0px;left:0px;">
        <form action="select_date.php" method='post' style='position:relative;top:29px;left:14px;'>
            <input type='text' name='ID_DU_Doctor' value="<?php echo $_POST["ID_DU_Doctor"]?>" style='display:none;'>
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
            <div style="display:flex;justify-content:center;align-items:center;text-align:center">
                <div class="text-white p-3 pt-0 text-center">
                <h2
                    class="text-4xl font-extralight mt-10 pb-0"
                    style="color: #727272"
                >
                    Piquer maintenant la séance
                </h2>
                <h1 class="mt-0 text-8xl font-black text-border">Rendez-vous</h1>
                </div>
            </div>
                      <?php
            // Vérifier si la date a été sélectionnée
            if (isset($_POST['date'])) {
                // Récupérer la date sélectionnée
                $date = $_POST['date'];
                echo "<p>Date sélectionnée : $date</p>";
                // Connexion à la base de données avec PDO
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "cabinet";
                    if (!empty($date) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                        $today = new DateTime('today');
                        $day = new DateTime($date);
                        if ($day >= $today){
                            try {
                                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $dayFormatted = $day->format('Y-m-d');
                                $checkStmt = $conn->prepare("SELECT COUNT(*) FROM conge WHERE date = :day and doctor=:doctor");
                                $checkStmt->bindParam(':day', $dayFormatted);
                                $checkStmt->bindParam(':doctor', $_POST["ID_DU_Doctor"]);
                                $checkStmt->execute();
                                $dateExists = $checkStmt->fetchColumn();
                                if ($dateExists == 0) {
                                    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $stmt = $conn->prepare("SELECT num_seance FROM RDVs WHERE doctor = :doctor and date = :date ");
                                    $stmt->bindParam(':date', $date);
                                    $stmt->bindParam(':doctor', $_POST["ID_DU_Doctor"]);
                                    $stmt->execute();
                                    $seances_occupees = $stmt->fetchAll(PDO::FETCH_COLUMN);

                                    $toutes_les_seances = range(1, 16);
                
                                    $seances_disponibles = array_diff($toutes_les_seances, $seances_occupees);
                                    $tab_se = array(
                                        1 => "08:00-08:30",
                                        2 => "08:30-09:00",
                                        3 => "09:00-09:30",
                                        4 => "09:30-10:00",
                                        5 => "10:00-10:30",
                                        6 => "10:30-11:00",
                                        7 => "11:00-11:30",
                                        8 => "11:30-12:00",
                                        9 => "14:00-14:30",
                                        10 => "14:30-15:00",
                                        11 => "15:00-15:30",
                                        12 => "15:30-16:00",
                                        13 => "16:00-16:30",
                                        14 => "16:30-17:00",
                                        15 => "17:00-17:30",
                                        16 => "17:30-18:00"
                                    );
                                    echo "<form action='submit_rdv.php' method='post' style='background-color:white;margin-top:20px;padding:40px;border-radius: 30px; border: 1px #009B9F solid;'>";
                                    echo "<input type='text' style='display:none;' name='ID_DU_Doctor' value='".$_POST["ID_DU_Doctor"]."'>";
                                    echo "<input type='hidden' name='date' value='$date'>";
                                    echo "<label for='seance'>Sélectionner une séance :</label>";
                                    echo "<div class='columns'>";
                                    
                                        if ($day == $today)
                                        {
                                            date_default_timezone_set('Africa/Tunis');
                                            $heure_actuelle = date('H:i');
                                            foreach ($seances_disponibles as $seance) {
                                                $heure_a_comparer = substr($tab_se[$seance],0,4);
                                                if ($heure_actuelle < $heure_a_comparer) {
                                                    echo "<div class='column-item'>";
                                                    echo "<input type='radio' id='seance_$seance' value='$seance' name='seance'>";
                                                    echo "<label for='seance_$seance'>$tab_se[$seance]</label>";
                                                    echo "</div>";
                                                } 
                                            }
                                        }
                                        else{                                            
                                            foreach ($seances_disponibles as $seance) {
                                                echo "<div class='column-item'>";
                                                echo "<input type='radio' id='seance_$seance' value='$seance' name='seance'>";
                                                echo "<label for='seance_$seance'>$tab_se[$seance]</label>";
                                                echo "</div>";
                                            }
                                         }

                                    echo "</div>";
                                }
                                else
                                {
                                    echo "le docteur est en conge le $date";
                                }
                            } catch (PDOException $e) {
                                echo "Erreur : " . $e->getMessage();
                            }
                        }else{
                            echo '<p style="color:red;padding-left:50px;font-weight: bold;font-size: 1.2em;">la date est invalide.</p>';
                        }
                    }
                $conn = null;
            } else {
                echo "<p>La date n'a pas été sélectionnée.</p>";
            }
        ?>
        <br>
        </div>
                        <input value='Prendre un rendez-vous' type='submit' style="margin-left:15%;margin-top:20%;padding:10px;border-radius: 100px;text-align: center; color: #009B9F; background-color:white;border:none; font-size: 25px; font-family: Inter; font-weight: 900; line-height: 18px; letter-spacing: 1.25px; word-wrap: break-word;"><br />
                    </form>
    </div>
</body>

</html>





