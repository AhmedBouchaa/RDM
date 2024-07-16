<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Main</title>
    <link rel="stylesheet" href="styles\NavStyle.css" />
    <script src="https://cdn.tailwindcss.com"></script>
        <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    
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
        /* Couleur de la bordure */
        text-shadow: 0 0 0 #000;
        /* Largeur de la bordure */
        -webkit-text-stroke-width: 3px; /* Safari/Chrome */
        text-stroke-width: 3px; /* Standard */
        /* Style de la bordure */
        -webkit-text-stroke-color: #727272; /* Safari/Chrome */
        text-stroke-color: #fff; /* Standard */
      }
      .text-borderb{
        /* Couleur de la bordure */
        text-shadow: 0 0 0 #000;
        /* Largeur de la bordure */
        -webkit-text-stroke-width: 3px; /* Safari/Chrome */
        text-stroke-width: 3px; /* Standard */
        /* Style de la bordure */
        -webkit-text-stroke-color: #009b9f; /* Safari/Chrome */
        text-stroke-color: #fff; /* Standard */
      }
    </style>
  </head>
  <body>
    <!-- ceci est le cas de message ou erreur -->

      <div style="width:100%;display:flex;flex-direction: column;justify-content: center;z-index: 100;position: absolute;top: 100px;padding: 2%;gap: 10px;">
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


    <header class=" h-48 ">
      <div class="navbar " >
      <div class="w-28 h-28 p-2.5 rounded-[100px] border-4 border-[#009b9f] flex justify-center items-center logo"><img src="../images/logo.png" alt=""></div>
        <ul class="links flex flex-row items-center">
          <li class="flex items-center"><a href="index.php">RDVs</a></li>
          <li class="flex items-center"><a href="patients.php">Patients</a></li>
          <li class="flex items-center"><a href="note/note.php">Note</a></li>
          <li class="flex items-center"><a href="abscence/abscence.php">Abscence</a></li>
        </ul>
        <form action="../profile/profile.php" method="POST" class="action_btn rounded-full w-28 h-28 flex justify-center items-center">
          <input type='text' name='ID_DU_USER' value='<?php echo $_SESSION['username']?>' style='display:none;'>
          <button type="submit">
            <img src=<?php echo "'" . $_SESSION["userimage"] . "'";?> alt="" class="w-28 h-28" style="border-radius:100%;border: 0px #727272 solid ;">
          </button>
        </form>
        <div class="toggle_btn"><i class="fa-solid fa-bars" style="color:#727272"></i></div>
      </div>
      <div class="dropdown_menu ">
          <li class="flex items-center"><a href="index.php">RDVs</a></li>
          <li class="flex items-center"><a href="patients.php">Patients</a></li>
          <li class="flex items-center"><a href="note/note.php">Note</a></li>
          <li class="flex items-center"><a href="abscence/abscence.php">Abscence</a></li>
          <li><form action="../profile/profile.php" method="POST" class="action_btn ">
                <input type='text' name='ID_DU_USER' value='<?php echo $_SESSION['username']?>' style='display:none;'>
                <input type="submit" value="Profile">
              </form>
          </li>
      </div>
    </header>
    <script>
      const toggleBtn =document.querySelector('.toggle_btn');
      const toggleBtnIcon =document.querySelector('.toggle_btn i');
      const dropDownMenu =document.querySelector('.dropdown_menu');
      toggleBtn.onclick=function(params){
        dropDownMenu.classList.toggle('open')
        const isOpen=dropDownMenu.classList.contains('open')
        toggleBtnIcon.classList = isOpen
        ?'fa-solid fa-xmark'
        :'fa-solid fa-bars'
      }
    </script>


    <div class="mt-10">
      <div class="text-white p-3 pt-0 text-center">
        <h2 class="text-4xl font-extralight titre1" style="color: #009b9f">
          Vos Rendez-Vous d'aujourd'hui
        </h2>
        <h1 class="mt-2 text-8xl font-black text-border titre2"   >le: <?php echo date("d-m-Y");?></h1>
      </div>
      <!-- Matin -->
      <?php
            // Informations de connexion à la base de données
            $serveur = "localhost"; // ou l'adresse de votre serveur de base de données
            $nom_utilisateur = "root"; // ou le nom d'utilisateur de votre base de données
            $mot_de_passe = ""; // ou le mot de passe de votre base de données
            $nom_base_de_donnees = "cabinet"; // ou le nom de votre base de données

            try {
                // Connexion à la base de données avec PDO
                $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $nom_utilisateur, $mot_de_passe);

                // Configuration de PDO pour afficher les erreurs de requête SQL
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Requête SQL pour récupérer les rendez-vous d'aujourd'hui
                $requete = $connexion->prepare("SELECT num_seance, username FROM rdvs WHERE doctor=:doct and date = CURDATE()");
                $requete->bindParam(':doct',$_SESSION['username'] );
                $requete->execute();

                // Récupération des résultats dans un tableau
                $rdvs = $requete->fetchAll(PDO::FETCH_ASSOC);

                // Fermeture de la connexion à la base de données
                $connexion = null;

                // Tableaux pour stocker les numéros de séance et les noms d'utilisateur
                $seances = array();
                $users = array();

                // Boucle pour récupérer les données dans les tableaux
                foreach ($rdvs as $rdv) {
                    $seances[] = $rdv["num_seance"];
                    $users[] = $rdv["username"];
                }
            } catch(PDOException $e) {
                // En cas d'erreur, afficher le message d'erreur
                echo "Erreur de connexion à la base de données : " . $e->getMessage();
            }
      ?>

      <div
        class="elem  mt-8 w-full py-1 flex flex-col  justify-center align-middle"
      >
        <div
          class="titre3   font-bold text-neutral-500 w-full flex justify-center items-center"
        >
          Matin
        </div>
        <table class="table table-bordered table-striped w-full">
          <tr style="background-color: #009b9f; color: white" class="">
            <td class="text-center titre4 border border-9 border-solid border-white">
              08:00-08:30
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              08:30-09:00
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              09:00-09:30
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              09:30-10:00
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              10:00-10:30
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              10:30-11:00
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              11:00-11:30
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              11:30-12:00
            </td>
          </tr>
          <tr class="">

          <?php
            for ($i = 1; $i <= 8; $i++) {
              $position = array_search($i, $seances);
              if ($position !== false) {
                  $serveur = "localhost"; // ou l'adresse de votre serveur de base de données
                  $nom_utilisateur = "root"; // ou le nom d'utilisateur de votre base de données
                  $mot_de_passe = ""; // ou le mot de passe de votre base de données
                  $nom_base_de_donnees = "cabinet"; // ou le nom de votre base de données
              
                  try {
                    // Connexion à la base de données avec PDO
                    $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $nom_utilisateur, $mot_de_passe);

                    // Configuration de PDO pour afficher les erreurs de requête SQL
                    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $username = $users[$position];
                    $requete = $connexion->prepare("SELECT * FROM users WHERE username = :username");
                    $requete->bindParam(':username', $username);
                    $requete->execute();
                    // Récupération du résultat (uniquement la première ligne, car le nom d'utilisateur doit être unique)
                    $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

                    echo "<td class='text-center border border-9 border-solid py-[3%]'style='border-color: #009b9f'>
                            <form action='patient.php' method='post' style='background-color: rgba(255, 255, 255, 0.5)' class='rounded-lg'>
                              <input type='text' name='ID_DU_PATIENT' value='" . $utilisateur["username"] . "' style='display:none;'>
                              <button type='submit'>
                                        <div class=''>
                                          <div class='flex justify-center items-center'>
                                            <img
                                            class='images'
                                            src='data:image/jpeg;base64," . base64_encode($utilisateur['image']) . "'
                                              style='border-radius: 100%'
                                            />
                                          </div>
                                          <div
                                            class='nomprenom flex justify-center items-center font-bold text-neutral-500'
                                          >
                                            " . $utilisateur["prenom"] . " " . $utilisateur["nom"] . "
                                          </div>
                                        </div>
                                </button>
                            </form>
                          </td>";
                  } catch (PDOException $e) {
                    // En cas d'erreur, afficher le message d'erreur
                    echo "Erreur de connexion à la base de données : " . $e->getMessage();
                  }





              }else{
              echo "<td class='text-center border border-9 border-solid py-[3%]' style='border-color: #009b9f'>
                      <div>
                        <div class='flex justify-center items-center'>
                          <img
                            class='images'
                            src='../images/interdit.png'
                            style='border-radius: 100%'
                          />
                        </div>
                        <div
                          class='nomprenom flex justify-center items-center font-bold '
                        ></div>
                      </div>
                    </td>";
              }
            }
          ?>
          </tr>
        </table>
      </div>






      <!-- apresmidi -->
      <div
        class="elem  mt-8 w-full py-1  flex flex-col  justify-center align-middle"
      >
        <div
          class="titre3 font-bold text-neutral-500 w-full flex justify-center items-center"
        >
          Après-midi
        </div>
        <table>
          <tr style="background-color: #009b9f; color: white" class="">
            <td class="text-center titre4 border border-9 border-solid border-white">
              14:00-14:30
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              14:30-15:00
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              15:00-15:30
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              15:30-16:00
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              16:00-16:30
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              16:30-17:00
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              17:00-17:30
            </td>
            <td class="text-center titre4 border border-9 border-solid border-white">
              17:30-18:00
            </td>
          </tr>
          <tr class="">
              <?php
                for ($i = 9; $i <= 16; $i++) {
                  $position = array_search($i, $seances);
                  if ($position !== false) {

                      $serveur = "localhost"; // ou l'adresse de votre serveur de base de données
                      $nom_utilisateur = "root"; // ou le nom d'utilisateur de votre base de données
                      $mot_de_passe = ""; // ou le mot de passe de votre base de données
                      $nom_base_de_donnees = "cabinet"; // ou le nom de votre base de données
                  
                      try {
                        // Connexion à la base de données avec PDO
                        $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base_de_donnees", $nom_utilisateur, $mot_de_passe);

                        // Configuration de PDO pour afficher les erreurs de requête SQL
                        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $username = $users[$position];
                        $requete = $connexion->prepare("SELECT * FROM users WHERE username = :username");
                        $requete->bindParam(':username', $username);
                        $requete->execute();
                        // Récupération du résultat (uniquement la première ligne, car le nom d'utilisateur doit être unique)
                        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

                        echo "<td class='text-center border border-9 border-solid py-[3%]'style='border-color: #009b9f'>
                                <form action='patient.php' method='post' style='background-color: rgba(255, 255, 255, 0.5)' class='rounded-lg'>
                                  <input type='text' name='ID_DU_PATIENT' value='" . $utilisateur["username"] . "' style='display:none;'>
                                  <button type='submit'>
                                            <div class=''>
                                              <div class='flex justify-center items-center'>
                                                <img
                                                class='images'
                                                src='data:image/jpeg;base64," . base64_encode($utilisateur['image']) . "'
                                                  style='border-radius: 100%;'
                                                />
                                              </div>
                                              <div
                                                class='nomprenom flex justify-center items-center  font-bold text-neutral-500'
                                              >
                                                " . $utilisateur["prenom"] . " " . $utilisateur["nom"] . "
                                              </div>
                                            </div>
                                    </button>
                                </form>
                              </td>";
                      } catch (PDOException $e) {
                        // En cas d'erreur, afficher le message d'erreur
                        echo "Erreur de connexion à la base de données : " . $e->getMessage();
                      }





                  }else{
                  echo "<td class='text-center border border-9 border-solid py-[3%]' style='border-color: #009b9f'>
                          <div>
                            <div class='flex justify-center items-center'>
                              <img
                              class='images'
                                src='../images/interdit.png'
                                style='border-radius: 100%'
                              />
                            </div>
                            <div
                              class='nomprenom flex justify-center items-center text-xl font-bold '
                            ></div>
                          </div>
                        </td>";
                  }
                }
          ?>
          </tr>
        </table>
      </div>
    </div>

    <div class="mt-20 mx-10">
            <form method="GET">
                <fieldset class="flex flex-col justify-center items-center rounded-2xl p-2" style="border: 1px solid #727272;border-raduis:100px;">

                    <legend class="ml-10">choisir un jour</legend>

                    <div class="flex justify-center items-center  flex-col w-full">
                      <input type="date" name="day" class="bg-gray-50 h-16 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-myblue focus:border-myblue block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-#009b9f dark:focus:border-#009b9f" placeholder="Select date">
                     
                      <div class="flex justify-center items-center relative max-w-sm   h-20 w-2/3">
                        <input type="submit" class="titre3 action_btn w-40 py-2 text-white text-3xl font-bold rounded-full" style="background-color:#009b9f" value="chercher" name="" id="">
                      </div>  

                    </div>  



                      <div class="text-white p-3 pt-0 text-center">
                        <h2 class="text-4xl font-extralight titre1" style="color: #009b9f">
                          <?php if (isset($_GET['day']) && !empty($_GET['day'])) {
                            echo "les rendez-vous de :";}?>
                        </h2>
                        <h1 class="mt-2 text-8xl font-black text-border titre2"> <?php if (isset($_GET['day']) && !empty($_GET['day'])) {echo htmlspecialchars($_GET['day']);}?></h1>
                      </div>



                                         

                    <div class="flex justify-center items-center w-2/3 h-20 mt-16 mb-20 ">                    
                        <?php
                            $serveur = "localhost"; // Adresse du serveur
                            $utilisateur = "root"; // Nom d'utilisateur MySQL
                            $motdepasse = ""; // Mot de passe MySQL
                            $basededonnees = "cabinet"; 

                            try {
                                $connexion = new PDO("mysql:host=$serveur;dbname=$basededonnees", $utilisateur, $motdepasse);
                                // Set the PDO error mode to exception
                                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                
                                $sql = ""; // Initialize the $sql variable

                                if (isset($_GET['day']) && !empty($_GET['day'])) {
                                    $recherche = htmlspecialchars($_GET['day']);
                                    $sql = 'SELECT * FROM rdvs WHERE doctor=:doct and date = :date ORDER BY date DESC';
                                    
                                    $stmt = $connexion->prepare($sql);
                                    $stmt->bindParam(':doct',$_SESSION['username'] );
                                    $stmt->bindParam(':date', $recherche);
                                    $stmt->execute();

                                    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $tab_se = array(
                                        1 => "8:00-8:30",
                                        2 => "8:30-9:00",
                                        3 => "9:00-9:30",
                                        4 => "9:30-10:00",
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
                                    if (count($resultats) > 0) {
                                        echo "<table class='table table-bordered table-striped w-full'>
                                                  <tr style='background-color: #009b9f; color: white' class=''>";
                                        foreach ($resultats as $rdv) {
                                          echo "<td class='text-center border border-9 border-solid border-white'>".$tab_se[$rdv['num_seance']]."</td>";
                                        }
                                        echo "</tr><tr>";
                                        foreach ($resultats as $rdv) {
                                            $username = $rdv['username'];
                                            $requete = $connexion->prepare("SELECT * FROM users WHERE username = :username");
                                            $requete->bindParam(':username', $username);
                                            $requete->execute();
                                            $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
                                            echo '<td class="text-center border border-9 border-solid py-[3%]"style="border-color: #009b9f">
                                                    <div class="flex flex-col">
                                                      <form action="patient.php" method="POST" style="background-color: rgba(255, 255, 255, 0.5)" class=" rounded-lg">
                                                        <input type="text" name="ID_DU_PATIENT" value="' . $utilisateur["username"] . '" style="display:none;"> 
                                                        <button type="submit" >
                                                                  <div class="">
                                                                    <div class="flex justify-center items-center">
                                                                      <img
                                                                      class="images"
                                                                      src="data:image/jpeg;base64,' . base64_encode($utilisateur["image"]) . '"
                                                                        style="border-radius: 100%"
                                                                      />
                                                                    </div>
                                                                    <div
                                                                      class="nomprenom flex justify-center items-center  font-bold text-neutral-500"
                                                                    >
                                                                      ' . $utilisateur["prenom"] . ' ' . $utilisateur["nom"] . '
                                                                    </div>
                                                                  </div>
                                                          </button>
                                                      </form>
                                                    </div>
                                                </td>';
                                        }
                                        echo "</tr></table>";
                                        }
                                    } else {
                                      if(isset($_GET['day']) && !empty($_GET['day'])){
                                        echo "Aucun rendez-vous trouvé pour la date : " . htmlspecialchars($recherche);}
                                    }
                            } catch(PDOException $e) {
                                echo "Erreur de connexion : " . $e->getMessage();
                            }
                            $connexion = null; 
                        ?>
                    </fieldset>
                </form>
              </div>




              <script>
                let x=window.innerWidth;
      
                document.getElementsByClassName('titre1')[0].style.fontSize=x*2.7/100+'px';
                document.getElementsByClassName('titre1')[1].style.fontSize=x*2.7/100+'px';
                document.getElementsByClassName('titre2')[0].style.fontSize=x*7/100+'px';
                document.getElementsByClassName('titre2')[1].style.fontSize=x*7/100+'px';
                document.getElementsByClassName('titre3')[0].style.fontSize=x*2/100+'px';
                document.getElementsByClassName('titre3')[1].style.fontSize=x*2/100+'px';
                document.getElementsByClassName('titre3')[2].style.fontSize=x*2/100+'px';

                for (let i = 0; i <= 15 ; i++) {
                  document.getElementsByClassName("titre4")[i].style.fontSize=x*1.5/100+'px';
                }
                if(x>=1110){
                  document.getElementsByClassName("elem")[0].classList.add("px-10");
                  document.getElementsByClassName("elem")[1].classList.add("px-10");
                  for (let i = 0; i < 31 ; i++) {
                    document.getElementsByClassName("nomprenom")[i].style.fontSize=15+'px';
                    document.getElementsByClassName("images")[i].style.width=100+'px';
                    document.getElementsByClassName("images")[i].style.height=100+'px';
                  }                  
                }else{
                  document.getElementsByClassName('titre3')[2].style.fontSize=x*5/100+'px';
                  for (let i = 0; i < 31 ; i++) {
                    document.getElementsByClassName("nomprenom")[i].style.fontSize=x/100+'px';
                    document.getElementsByClassName("images")[i].style.width=x*7/100+'px';
                    document.getElementsByClassName("images")[i].style.height=x*7/100+'px';
                }
                }


              </script>
  </body>
</html>