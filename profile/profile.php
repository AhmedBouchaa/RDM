    <?php
    session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patients</title>
    <script src="https://cdn.tailwindcss.com"></script>

        <link rel="stylesheet" href="../doctor/styles\NavStyle.css" />
            <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
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

label {
  display: block;
  width: 100%;
  margin-top: 2%;
  padding-left: 40px;



}
  .bregister,#bregisters {


  background-color: #009b9f;
  color: white;
  border: 1px solid white;
  border-radius: 5px;
  margin-top: 10px;
  margin-bottom: 20px;
}

.bregister:hover {
  background-color: white;
  color: #009b9f;
  border: 1px solid gray;
  border-radius: 5px;
}
#bregisters:hover{
  background-color: rgba(100, 0, 0, 1);
  color: gray;
  border: 1px solid gray;
  border-radius: 5px;
}
input[type="text"],
input[type="date"],input[type="file"],input[type='password'] {
  width: 60%;
  padding: 10px;
  border: 1px solid #009b9f;
  border-radius: 5px;
  background-color: #fff;
  min-width:250px;

}

.detailsr {
  padding-top: 10px;
  overflow: auto;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
}

button {
  width: 60%;
  height: 40px;
  margin: 10px auto;
  justify-content: center;
  display: block;
  color: #fff;
  background: #573b8a;
  font-size: 1em;
  font-weight: bold;
  margin-top: 20px;
  outline: none;
  border: none;
  border-radius: 5px;
  transition: 0.2s ease-in;
  cursor: pointer;
}
button:hover {
  background: #6d44b8;
}
        .overflow-wrap-break-word {
            overflow-wrap: break-word;
            }
        .title{
            font-size: ;
            color: #fff;
            /* Couleur de la bordure */
            text-shadow: 0 0 0 #000;
            /* Largeur de la bordure */
            -webkit-text-stroke-width: 1px; /* Safari/Chrome */
            text-stroke-width: 1px; /* Standard */
            /* Style de la bordure */
            -webkit-text-stroke-color: #009b9f; /* Safari/Chrome */
            text-stroke-color: #fff; /* Standard */
        }
        .title1{
            font-size: ;
            color: #fff;
            /* Couleur de la bordure */
            text-shadow: 0 0 0 #000;
            /* Largeur de la bordure */
            -webkit-text-stroke-width: 1px; /* Safari/Chrome */
            text-stroke-width: 1px; /* Standard */
            /* Style de la bordure */
            -webkit-text-stroke-color: #727272; /* Safari/Chrome */
            text-stroke-color: #fff; /* Standard */
        }
        .info{
            font-size:large;
            color:#555555;
            margin-left: 20px;

        }
      .text-border {
        /* Couleur de la bordure */
        text-shadow: 0 0 0 #000;
        /* Largeur de la bordure */
        -webkit-text-stroke-width: 2px; /* Safari/Chrome */     
        text-stroke-width: 2px; /* Standard */
        /* Style de la bordure */
        -webkit-text-stroke-color: #009b9f; /* Safari/Chrome */
        text-stroke-color: #fff; /* Standard */
      }
      .action_btn1 {
        color: #fff;
        /* padding: 0.5rem 1rem; */
        border: none;
        outline: none;
        /* border-radius: 20px; */
        /* font-size: 0.8rem; */
        /* font-weight: bold; */
        cursor: pointer;
        transition: scale 0.2 ease;
        }
        .action_btn1:hover {
        scale: 1.05;
        color: #fff;
        }
        .action_btn1:active {
        scale: 0.95;
        }
    </style>

        <!-- ceci est le cas de message ou erreur -->

      <div style="width:100%;display:flex;flex-direction: column;justify-content: center;z-index: 100;position: absolute;top: 100px;padding: 2%;gap: 10px;">
        <?php
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
  </head>






<!-- rounded-[100px] border-4 border-[#009b9f] -->

    <?php

    if (isset($_SESSION["username"])) {
        $id_user = $_SESSION["username"];

        $serveur = "localhost";
        $utilisateur = "root";
        $motdepasse = "";
        $basededonnees = "cabinet";

        $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

        if ($connexion->connect_error) {
            die("Échec de la connexion : " . $connexion->connect_error);
        }

        $id_user_echappe = $connexion->real_escape_string($id_user);

        $sql = "SELECT *, image FROM users WHERE username = '" .$_SESSION["username"] . "'";
        $resultat = $connexion->query($sql);

        if ($resultat->num_rows > 0) {
            $row = $resultat->fetch_assoc();
            $prenom = $row["prenom"];
            $nom = $row["nom"];
            $date_naissance = $row["date_naissance"];
            $sexe = $row["sexe"];
            $telephone = $row["telephone"];
            $image_encodee = base64_encode($row["image"]);
            $user_name = $row['username'];


            echo "<header class='h-48'>
                    <div class='navbar '>
                        <a href='
                        ";


                        if(strcmp($row['post'],"Doctor")==0)
                        {
                            echo '../doctor/index.php';
                        }else{
                            echo '../patient/index.php';
                        }
                        echo "' class='action_btn1 rounded-full  h-12 flex justify-center items-center'><img src='../images/accueil.png'  class='w-full h-full'></a>
                            <a href='../index.php' class='action_btn1 h-14  justify-center items-center logo' ><img src='../images/eteindre.png' class='w-full h-full' /></a>

                    </div>
                </header>";
            echo "<div class='flex justify-center items-center w-full mt-20' >
                    <div class='w-3/4 rounded-3xl ' id='case' style='border: 1px solid #727272;''>
                        <div class='flex flex-col justify-center items-center'>
                            <div class='flex justify-center items-center' style='position: relative;top: -200px;'>
                            <img src='data:image/jpeg;base64,$image_encodee' id='imag' style='width: 300px; border-radius: 100%;max-height: 300px;max-width: 300px;'/>
                            </div>
                            <div class='flex justify-center items-center w-1/4' style='position: relative;top: -200px;'>
                                <h1 id='nomprenom' class='text-5xl font-black text-border text-white text-center'>". $row["prenom"] . " " . $row["nom"] ."</h1>
                            </div>               
                        </div>




                        <div  class='mt-8 ' style='position: relative;top: -200px;height:70%;'>



                            <fieldset class='flex justify-center items-center rounded-2xl ' style='border: 1px solid #727272;border-raduis:100px;width:80%;margin-left:10%'>
                              <legend class='ml-10' style='color:#727272'>Données Personel</legend>



        <form action='update.php' method='POST'  enctype='multipart/form-data' required class=' w-[100%]'>

          <div class='detailsr'>
            <label for='nom'>Nom</label>
            <input
              type='text'
              name='nom'
              id='nom'
                value='$nom'
              required
            />
            <label for='prenom'>Prénom </label>
            <input
              type='text'
              name='prenom'
              id='prenom'
              value='$prenom'
              required
            />

            <label for='date_naissance'>Date de naissance </label>
            <input
              type='date'
              name='date_naissance'
              id='date_naissance'
              value='$date_naissance'
              required
            />

            <label for='telephone'>Téléphone </label>
            <input
              type='text'
              name='telephone'
              id='telephone'
              value='$telephone'
              required
            />
            <label for='image'>Choisir une image </label>
            <input type='file' value='data:image/jpeg;base64,$image_encodee' name='image' id='image' required />

            





            <button type='submit' class='bregister' >
              Mise A jour
            </button>
          </div>
        </form>











                            </fieldset>









                                                        <fieldset class='flex justify-center items-center rounded-2xl ' style='border: 1px solid #727272;border-raduis:100px;width:80%;margin-left:10%'>
                              <legend class='ml-10' style='color:#727272'>Mot de passe</legend>



        <form action='changer_mdp.php' method='POST'   required class=' w-[100%]'>

          <div class='detailsr'>
            <label for='p1'>Mot de passe actuel</label>
            <input
              type='password'
              name='p1'
              id='p1'
              required
            />            
            <label for='p2'>Nouveau mot de passe</label>
            <input
              type='password'
              name='p2'
              id='p2'
              required
            />
            <label for='p3'>Confirmer nouveau mot de passe</label>
            <input
              type='password'
              name='p3'
              id='p3'
              required
            />

            <button type='submit' class='bregister' >
              Changer 
            </button>
          </div>
        </form>
                            </fieldset>
                                                                                    <fieldset class='flex justify-center items-center rounded-2xl ' style='border: 1px solid #727272;border-raduis:100px;width:80%;margin-left:10%'>
                              <legend class='ml-10' style='color:#727272'>Supprimer ton compte</legend>



        <form action='supprimer.php' method='POST'  enctype='multipart/form-data' required class=' w-[100%]'>
        <div class='detailsr'>
            <div style='padding:20px;'>si tu va supprimer ton compte tous vos donnees seront supprimer( vos rendez-vous seront annuler, vos notes et vos dossiers medicaux seront supprimer)
            vous devez bien sur fournir le mot de passe</div>
            <label for='p1'>Mot de passe</label>
            <input
              type='password'
              name='mdp'
              id='mdp'
              required
            /> 

            <button type='submit'style='background-color:red;' id='bregisters' >
              Supprimer le compte
            </button>
          </div>
        </form>
                            </fieldset>





















                        </div>
                    </div>

                </div>";
                                    echo "<script>
                                long = document.getElementById(".'"case"'.").offsetWidth ;
                                document.getElementById(".'"imag"'.").style.width=long*1/3+'px' ;
                                document.getElementById(".'"imag"'.").style.height=long*1/3+'px' ;
                                if(long <450){
                                   document.getElementById(".'"nomprenom"'.").style.fontSize=long*1/12+'px' ;

                                }
                              </script>";
        }
    }
?>    
</body>
</html>