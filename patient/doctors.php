<?php
            $serveur = "localhost"; // Adresse du serveur
            $utilisateur = "root"; // Nom d'utilisateur MySQL
            $motdepasse = ""; // Mot de passe MySQL
            $basededonnees = "cabinet"; // Nom de la base de données

            $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

            if ($connexion->connect_error) {
                die("Échec de la connexion : " . $connexion->connect_error);
            }
            $sql = "SELECT * FROM users where post='Doctor'";
            
            if(isset($_GET['s']) and !empty($_GET['s'])){
                $recherche = htmlspecialchars($_GET['s']);
                $sql = 'SELECT * FROM users where post="Doctor" and  prenom like "%'.$recherche.'%" or nom like "%'.$recherche.'%" and post="Doctor" order by prenom desc';
            }
            $resultat = $connexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
      .text-border {
            color: #009B9F;
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-width:1px;
            -webkit-text-stroke-color: white;
        }
      #doctors{
        width: 90%;
        height: 100%;
        margin: 5% auto;
        position: relative;
        top: 100px;
      }
      button{
        border: none;
        background-color: rgba(0, 0, 0, 0);
      }
      .elem{
        background-color: rgba(250, 250, 250, 0.5);
        padding: 10px;
        border-radius: 10%;
        width: 120%;
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
              margin-left: 10px;
              margin-right: 10px;
              margin-top: 200px;
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
      <a href="index.php" style='position:relative;top:30px;left:20px;z-index: 10;'><img src="../images/retour.png" style="width:50px;heigth:50px;"></a>
      <form action="../profile/profile.php" method="POST" class="action_btn rounded-full flex justify-center items-center" style="width: 70px; height: 70px;border-radius: 100%; display:flex;justify-content:center;align-items:center;position:relative;bottom:22px;left:75%;">
            <input type='text' name='ID_DU_USER' value='<?php echo $_SESSION['username']?>' style='display:none;'>
            <button type="submit" >
            <img src=<?php echo "'" . $_SESSION["userimage"] . "'";?> alt=""  style="width:70px;height:70px;border-radius:100%;border: 2px #F5F5F5 solid ;">
            </button>
          </form>
    </div>




    <div id="doctors">
      <div style="display:flex;justify-content:center;align-items:center;text-align:center">
        <div class="text-white p-3 pt-0 text-center">
          <h2
            class="text-4xl font-extralight mt-10 pb-0"
            style="color: #727272"
          >
          choisir le docteur pour 
          </h2>
          <h1 class="mt-0 text-8xl font-black text-border">            
          <?php
            switch($_GET['operation']){
            case 'rdvs':
              echo 'un Rendez-vous';
                break;
            case 'note':
              echo 'une Note';
              break;
              }
                          ?>
              </h1>
          <form method="get">
            <input
              type="search"
              name="s"
              style="border-radius:10px;"
              class="w-80 border border-neutral-500 rounded-full px-6 py-2 text-neutral-500"
            />
            <button type="submit"><img style="width:25px;heigth:25px;background-color:rgba(250,250,250,0);position:relative;top:8px;transform: scaleX(-1);" src="..\images\loupe.png" alt=""></button>
            <br>
           </form>
        </div>
      </div>
      <div style="display:grid;grid-template-columns: repeat(3, 1fr);gap: 20px;margin-top:60px;">
        <?php
            if ($resultat->num_rows > 0) {
              while($row = $resultat->fetch_assoc()) {
                switch($_GET['operation']){
                  case 'rdvs':
                    echo "<form action='rdvs/select_date.php'  method='post' style='width:100px;'>
                        <input type='text' name='ID_DU_Doctor' value='" . $row["username"] . "' style='display:none;'>
                        <button type='submit' class='elem'>
                          <div class='flex justify-center items-center mb-10'>
                            <img src='data:image/jpeg;base64,".base64_encode($row['image'])."' style='width:100%;height:100px;border-radius: 100%'/>
                          </div>
                          <div class='flex justify-center items-center text-xl font-bold text-[#727272]'>" . $row["prenom"] . " " . $row["nom"] . "</div>
                        </button>
                    </form>";
                      break;
                  case 'note':
                      echo "<form action='note/note.php'  method='post' style='width:100px;'>
                        <input type='text' name='ID_DU_Doctor' value='" . $row["username"] . "' style='display:none;'>
                        <button type='submit' class='elem'>
                          <div class='flex justify-center items-center mb-10'>
                            <img src='data:image/jpeg;base64,".base64_encode($row['image'])."' style='width:100%;height:100px;border-radius: 100%'/>
                          </div>
                          <div class='flex justify-center items-center text-xl font-bold text-[#727272]'>" . $row["prenom"] . " " . $row["nom"] . "</div>
                        </button>
                    </form>";
                    break;
                    }
                  }
            } else {
                echo "Aucun docteurs trouvé.";
            }
            $connexion->close();
            ?>

      </div>
    </div>



</body>
</html>
