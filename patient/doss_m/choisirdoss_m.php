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
    margin-left: 10px;
    margin-right: 10px;
    margin-top: 200px;


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
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
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
      <a href="../index.php" style='position:relative;top:30px;left:20px;'><img src="../../images/retour.png" style="width:50px;heigth:50px;"></a>
          <form action="../../profile/profile.php" method="POST" class="action_btn rounded-full w-16 h-16 flex justify-center items-center" style="width: 70px; height: 70px;border-radius: 100%; display:flex;justify-content:center;align-items:center;position:relative;bottom:22px;left:75%;">
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
                Ajoutez 
            </h2>
            <h1 class="mt-0 text-8xl font-black text-border">Dossier Medicale</h1>
            </div>
        </div>
        <form action="submit_doss.php" method="post" enctype="multipart/form-data" style="margin-top:60px;padding:40px;background: white; border-radius: 30px; border: 1px #009B9F solid;" >
            <label for="titre">titre</label>
            <br> 
            <input type="text" name="titre" id="titre" >  <br>   
            <br> 
            <label for="descr">Description</label><br> 
            <textarea name="descr" id="descr"></textarea><br> <br> 
            <input type="text" name="descrHidden" id="descrHidden" style="display:none;">

            <script>
                // Sélectionnez les éléments textarea et input
                const textarea = document.getElementById('descr');
                const hiddenInput = document.getElementById('descrHidden');

                // Ajoutez un écouteur d'événement pour écouter les frappes dans la zone de texte
                textarea.addEventListener('input', function() {
                    // Mettez à jour la valeur de l'élément input caché avec la valeur de la zone de texte
                    hiddenInput.value = textarea.value;
                });
            </script>
            <br>

            <label for="file">Sélectionnez un fichier à télécharger :</label>      
            <br><br>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Envoyer" style="width:50%;margin-left:25%;margin-top:10px;padding:10px;border-radius: 100px;text-align: center; color: white; background-color:#009B9F;border:none; font-size: 25px; font-family: Inter; font-weight: 900; line-height: 18px; letter-spacing: 1.25px; word-wrap: break-word;"><br />
        </form>


    </div>
</body>
</html>
