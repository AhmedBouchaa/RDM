<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Main</title>
    <link rel="stylesheet" href="style.css" />
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


      
    <div class="main">
      <input type="checkbox" id="chk" aria-hidden="true" />
      <div class="login">
        <form action="login.php" method="POST">
          <!-- <label for="chk" aria-hidden="true">Log in</label>
          <input type="text" name="txt" placeholder="User name" />
          <input type="password" name="pswd" placeholder="Password" /> -->
          <label for="chk" aria-hidden="true">Log in</label>

          <div class="detailsl">
            <div class="champ">
              <label for="username">Nom d'utilisateur</label>
              <input
                type="text"
                class="text"
                name="username"
                placeholder="Entrez votre nom d'utilisateur"
                value=<?php if (isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>
              />
            </div>
            <div class="champ">
              <label for="mot_de_passe">Mot de passe</label>
              <input
                type="password"
                class="text"
                name="password"
                placeholder="Entrez votre mot de passe"
                value=<?php if (isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>
              />
            </div>
            <div style="display: flex; align-items: center; margin-left: 80px">
              <input
                type="checkbox"
                id="souviens_toi_de_moi"
                name="souviens_toi_de_moi"
              />
              <label for="souviens_toi_de_moi" style="margin-left: 5px"
                >Se souvenir de moi</label
              >
            </div>
            <div
              style="
                display: flex;
                justify-content: center;
                align-items: center;
                width: 215px;
                margin-left: 80px;
              "
            >
              <a href="#" class="lien" style="font-size: x-small"
                >Mot de passe oublié ?</a
              >
              <button type="submit" id="blogin" style="width: 90px">
                Log In
              </button>
            </div>
          </div>
        </form>
      </div>
      <div class="signup">
        <form action="register.php" method="POST"  enctype="multipart/form-data" required>
          <!-- <label for="chk" aria-hidden="true">Log In</label>
          <input type="text" name="txt" placeholder="User name" />
          <input type="email" name="email" placeholder="Email" />
          <input type="password" name="pswd" placeholder="Password" />
          <input type="text" name="txt" placeholder="User name" />
          <input type="email" name="email" placeholder="Email" />
          <input type="password" name="pswd" placeholder="Password" />
          <button>Log In</button> -->
          <label for="chk" aria-hidden="true">Register</label>

          <div class="detailsr">
            <label for="nom">Nom</label><br />
            <input
              type="text"
              name="nom"
              id="nom"
              placeholder="Entrer votre nom"
              required
            />
            <label for="prenom">Prénom </label><br />
            <input
              type="text"
              name="prenom"
              id="prenom"
              placeholder="Entrer votre prenom"
              required
            />

            <label for="date_naissance">Date de naissance </label><br />
            <input
              type="date"
              name="date_naissance"
              id="date_naissance"
              required
            />

            <label for="telephone">Téléphone </label><br />
            <input
              type="text"
              name="telephone"
              id="telephone"
              placeholder="Entrer votre téléphone"
              required
            />
            <label for="image">Choisir une image </label><br />
            <input type="file" name="image" id="image" required />

            <label for="sexe">Sexe</label><br />
            <div style="display: flex; width: 200px; margin-left: 80px">
              <span>Male</span>
              <input
                type="radio"
                name="sexe"
                value="Male"
                class="radio"
                checked
              />
              <span>Femelle</span>
              <input type="radio" name="sexe" value="Femelle" class="radio" />
            </div>

            <label for="post">You are ?</label><br />
            <div style="display: flex; width: 200px; margin-left: 80px">

              <span>Patient</span>
              <input type="radio" name="post" value="Patient" class="radio" checked/>
              <span>Doctor</span>
              <input
                type="radio"
                name="post"
                value="Doctor"
                class="radio"
                
              />
            </div>

            <label for="telephone">Nom d'utilisateur </label><br />
            <input
              type="text"
              name="username"
              id="username"
              placeholder="Entrer votre nom d'utlisateur"
              required
            />

            <label for="telephone">Mot de passe </label><br />
            <input
              type="password"
              name="password1"
              id="password1"
              placeholder="Entrer votre mot de passe"
              required
            />

            <label for="telephone">Confirmer votre mot de passe</label><br />
            <input
              type="password"
              name="password2"
              id="password"
              placeholder="confirmer votre mot de passe"
              required
            />

            <button type="submit" id="bregister" style="width: 100px">
              Register
            </button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
