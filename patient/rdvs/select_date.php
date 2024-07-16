<!DOCTYPE html>
<html>

<head>
    <title>Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        
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
            color: #009B9F;
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-width:1px;
            -webkit-text-stroke-color: white;
        }

        .flatpickr-calendar {
            background-color: #fff;
            border: 5px solid #009B9F;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            outline: none;
            width: 115%;
            margin-left: -7%;

        }
        .flatpickr-day.selected {
         background-color: #009B9F; 
         border:1px solid #009B9F;
}

        #date {
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

<body>
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

    <div style="background-color:#009b9f;height:400px;width:100%;margin-top:0px;border-radius:0% 0% 5% 5%;position: fixed;top:0px;left:0px;">

          <form action="../doctors.php" style='position:relative;top:29px;left:14px;'>
            <input type="text" value="rdvs" name="operation" style='display:none;'>
            <button type="submit" style="background-color:rgba(0,0,0,0);border:none">
              <img src="../../images/retour.png" style="width:50px;heigth:50px;">
            </button>
          </form>
          <form action="../../profile/profile.php" method="POST" class="action_btn rounded-full w-16 h-16 flex justify-center items-center" style="width: 70px; height: 70px;border-radius: 100%; display:flex;justify-content:center;align-items:center;position:relative;bottom:24px;left:75%;">
          <input type='text' name='ID_DU_USER' value='<?php echo $_SESSION['username']?>' style='display:none;'>
          <button type="submit" >
            <img src=<?php echo "'" . $_SESSION["userimage"] . "'";?> alt=""  style="width:70px;height:70px;border-radius:100%;border: 2px #F5F5F5 solid ;">
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
            Prenez votre
          </h2>
          <h1 class="mt-0 text-8xl font-black text-border">Rendez-vous</h1>
        </div>
      </div>
      <?php
      if (isset($_POST['ID_DU_Doctor'])) {
        // Récupérer la date sélectionnée
        $doct = $_POST['ID_DU_Doctor'];
        echo "<p>Docteur sélectionnée : $doct</p>";
      }
                      ?>
        
<form action="select_seance.php" method="post" style="background-color:white;margin-top:10px;padding:40px;background: white; border-radius: 30px; border: 1px #009B9F solid;">
    <input type='text' name='ID_DU_Doctor' value="<?php echo $_POST["ID_DU_Doctor"]?>" style='display:none;'>
    <!-- Affichage de la date  -->
 <input type="hidden" name="date" required id="date">
    <!-- Calendrier inline -->
    <div id="datePicker" class="flatpickr-calendar"></div>

    <input type="submit" value="Continuer" style="width:50%;margin-left:25%;margin-top:10px;padding:10px;border-radius: 100px;text-align: center; color: white; background-color:#009B9F;border:none; font-size: 25px; font-family: Inter; font-weight: 900; line-height: 18px; letter-spacing: 1.25px; word-wrap: break-word;"><br />





  
</form>

</div>




    <script>
        flatpickr("#datePicker", {
            inline: true,
            dateFormat: "Y-m-d", // Format de la date uniquement
            onChange: function(selectedDates, dateStr, instance) {
                var selectedDate = selectedDates[0];
                var formattedDateTime = formatDate(selectedDate);
                document.getElementById('date').value = formattedDateTime;
            }
        });

        function formatDate(date) {
            var year = date.getFullYear();
            var month = padZero(date.getMonth() + 1);
            var day = padZero(date.getDate());
            return year + '-' + month + '-' + day;
        }

        function padZero(value) {
            return value < 10 ? '0' + value : value;
        }
    </script>

</body>
</html>
