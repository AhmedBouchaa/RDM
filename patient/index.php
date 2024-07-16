<html>

<head>
<title>Patient</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    

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
  a{
    text-decoration: none;
  }
    footer {
      border-top-left-radius: 20px;
      border-top-right-radius : 20px;
        background-color: #009B9F;box-shadow: -20.399999618530273px 20.399999618530273px 20.399999618530273px rgba(255, 255, 255, 0.10) inset;
        color: white;
        padding: 2px;
        width:425px;
        height:30px;
        flex-shrink: 0;

    }
    .icon {
        display: flex;
        align-items: center;   
    }

    .icon i {
        font-size: 24px;
        margin-right: 10px;
    }
    .text-border {
      color: rgba(255, 255, 255, 0);
        /* Couleur de la bordure */
        text-shadow: #009B9F;
        /* Largeur de la bordure */
        -webkit-text-stroke-width: 2px; /* Safari/Chrome */
        text-stroke-width: 3px; /* Standard */
        /* Style de la bordure */
        -webkit-text-stroke-color: #009B9F; /* Safari/Chrome */
        text-stroke-color: #009B9F; /* Standard */
      }
    #divi{
      text-align:center;
      position:relative;
      top:120px;
    }
    .MyButton{
      background-color: #009B9F;
      border-radius: 100px;
      margin: 10% auto;
      width:300px;
      text-align: center;
      color: white;
    }
    input[type='submit']{
      border: none;
      background-color: rgba(0, 0, 0, 0);
      height: 10%;
      width: 100%;
      color: white;
      font-size: 20px;
    }
    button{
      background-color:rgba(0, 0, 0, 0);
      border:none;
    }
</style>
</head>


    <body> 

    <!-- ceci est le cas de message ou erreur -->

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





<!-- le cas de message ou erreur -->

<div style="background-image: url('../images/calendrier.jpeg');height:300px;width:100%;margin-top:0px;border-radius:0% 0% 5% 5%;position:fixed;top:0px;left:0px;box-shadow: -10.566666603088379px 10.566666603088379px 10.566666603088379px rgba(255, 255, 255, 0.10) inset;">
    <div style="backdrop-filter: blur(10px);height:100%;width:100%;border-radius:0% 0% 5% 5%">
    <form action="../profile/profile.php" method="POST" class="action_btn rounded-full w-16 h-16 flex justify-center items-center" style="width: 70px; height: 70px;border-radius: 100%; display:flex;justify-content:center;align-items:center;position:relative;top:30px;left:75%;">
          <input type='text' name='ID_DU_USER' value='<?php echo $_SESSION['username']?>' style='display:none;'>
          <button type="submit" >
            <img src=<?php echo "'" . $_SESSION["userimage"] . "'";?> alt=""  style="width:70px;height:70px;border-radius:100%;border: 2px #009B9F solid ;">
          </button>
        </form>
    </div>
</div>

<div>
<div id="divi">
    <h1 style="color: #555555;word-wrap: break-word">Bienvenu ! </h1>
    <h1 class="text-border"><?php echo  $_SESSION['username']?> </h1>
</div>
<div style="position:relative;top:160px">
  <div class="MyButton">
    <form action="doctors.php">
      <input type="text" value="rdvs" name="operation" style='display:none;'>
      <input type="submit" value="Rendez-vous">
    </form>
  </div>

    <div class="MyButton">
    <form action="doctors.php">
      <input type="text" value="note" name="operation" style='display:none;'>
      <input type="submit" value="Note du docteur">
    </form>
  </div>

  <div class="MyButton">
    <form action="doss_m/choisirdoss_m.php">
      <input type="submit" value="Dossier medical">
    </form>
  </div>


</div>
</div>
</body>
</html>