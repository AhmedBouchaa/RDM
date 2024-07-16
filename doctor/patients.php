<?php
            $serveur = "localhost"; // Adresse du serveur
            $utilisateur = "root"; // Nom d'utilisateur MySQL
            $motdepasse = ""; // Mot de passe MySQL
            $basededonnees = "cabinet"; // Nom de la base de données
session_start();

            $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

            if ($connexion->connect_error) {
                die("Échec de la connexion : " . $connexion->connect_error);
            }
            $sql = "SELECT * FROM users where post='Patient'";
            
            if(isset($_GET['s']) and !empty($_GET['s'])){
                $recherche = htmlspecialchars($_GET['s']);
                $sql = 'SELECT * FROM users where post="Patient" and prenom like "%'.$recherche.'%" or nom like "%'.$recherche.'%" and  post="Patient"  order by prenom desc';
            }
            $resultat = $connexion->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patients</title>
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
      .text-border {
        /* Couleur de la bordure */
        text-shadow: 0 0 0 #000;
        /* Largeur de la bordure */
        -webkit-text-stroke-width: 3px; /* Safari/Chrome */
        text-stroke-width: 3px; /* Standard */
        /* Style de la bordure */
        -webkit-text-stroke-color: #009b9f; /* Safari/Chrome */
        text-stroke-color: #fff; /* Standard */
      }
      body {
        background-image: url("../images/shape1.png");
        background-repeat: no-repeat;
        background-position: -200px 0px;
      }
    </style>
  </head>
  <body>
    <div class="overflow-hidden">

    <header class=" h-48">
      <div class="navbar">
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
          <li>  <form action="../profile/profile.php" method="POST" class="action_btn ">
          <input type='text' name='ID_DU_USER' value='<?php echo $_SESSION['username']?>' style='display:none;'>
          <input type="submit" value="Profile">
        </form></li>
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

      <div>
        <div class="text-white p-3 pt-0 text-center">
          <h2
            class="text-4xl font-extralight mt-10 pb-0"
            style="color: #727272"
            id="titre1"
          >
            Chercher ton
          </h2>
          <h1 id="titre2" class="mt-0 text-8xl font-black text-border">Patient:</h1>
          <form method="get">
            <input
              type="search"
              name="s"
              id="search1"
              class="max-w-80 border border-neutral-500 rounded-full px-6 mt-2 py-2 text-neutral-500"
            /><br>
           </form>
        </div>
      </div>

      <!-- patients -->
      <div id="patients" class="w-full flex justify-center items-center">
        <div id="container" class="grid grid-cols-3 grid-rows-3 px-4">

          <?php
            $nombredoct=$resultat->num_rows;

            // Vérifier s'il y a des résultats
            if ( $nombredoct> 0) {
                // Étape 3 : Récupération et affichage des données
            while($row = $resultat->fetch_assoc()) {
            echo "<form action='patient.php' method='post' style='background-color: rgba(255, 255, 255, 0.5)' class='py-8 px-2 rounded-lg'>
                      <input type='text' name='ID_DU_PATIENT' value='" . $row["username"] . "' style='display:none;'>
                      <button type='submit'>
                      <div class='flex justify-center items-center mb-10'>
                      <img src='data:image/jpeg;base64,".base64_encode($row['image'])."' class='images' style='border-radius: 100%'/>
                      </div>
                      <div class='nomprenom flex justify-center items-center  font-bold text-[#727272]'>" . $row["prenom"] . " " . $row["nom"] . " 
                      </div>
                      </button>
                      </form>";
                }
            } else {
                echo "Aucun patient trouvé.";
            }

            // Étape 4 : Fermer la connexion
            $connexion->close();
            ?>



        </div>
      </div>
    </div>
        <script>
        let x=window.innerWidth;
        document.getElementById('titre1').style.fontSize=x*2.7/100+'px';
        document.getElementById('titre2').style.fontSize=x*7/100+'px';
        document.getElementById('search1').style.width=x*1.5/6+'px';      
       
        if(x>800){
                  document.getElementsByTagName("body")[0].style.backgroundSize="140% auto, cover";
                  document.getElementById('container').classList.add('gap-10');                  
                  for (let i = 0; i < <?php echo json_encode($nombredoct); ?> ; i++) {
                    document.getElementsByClassName("nomprenom")[i].style.fontSize=20+'px';
                    document.getElementsByClassName("images")[i].style.width=200+'px';
                    document.getElementsByClassName("images")[i].style.height=200+'px';
                  }  
        }else{
                  document.getElementsByTagName("body")[0].style.backgroundSize="200% auto, cover"
                  document.getElementsByTagName("body")[0].style.backgroundAttachment="fixed"
                  document.getElementById('container').classList.add('gap-2');                  
                  for (let i = 0; i < <?php echo json_encode($nombredoct); ?> ; i++) {
                  document.getElementsByClassName("nomprenom")[i].style.fontSize=x*3/100+'px';
                  document.getElementsByClassName("images")[i].style.height=x*3/10+'px';
                  document.getElementsByClassName("images")[i].style.height=x*3/10+'px';
                  
                }
        }
    </script>
  </body>
</html>
