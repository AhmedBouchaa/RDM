<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patients</title>
    <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="styles\NavStyle.css" />
            <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <style>
        .overflow-wrap-break-word {
            overflow-wrap: break-word;
            }
        .title{
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
  </head>

    <header class=" h-48">
      <div class="navbar">
        <a href="patients.php" class="action_btn1 rounded-full w-16 h-16 flex justify-center items-center"><img src="..\images\retourb.png" alt="" class="w-12 h-12"></a>
        <a href="#" class="imag  p-2.5 rounded-[100px] border-4 border-[#009b9f] justify-center items-center" ></a>
      </div>
    </header>


    <?php
        // Vérifier si l'ID_DU_PATIENT a été envoyé via POST
    if (isset($_POST["ID_DU_PATIENT"])) {
        // Récupérer l'ID du patient
        $id_patient = $_POST["ID_DU_PATIENT"];

        // Établir la connexion à la base de données
        $serveur = "localhost";
        $utilisateur = "root";
        $motdepasse = "";
        $basededonnees = "cabinet";

        $connexion = new mysqli($serveur, $utilisateur, $motdepasse, $basededonnees);

        // Vérifier la connexion
        if ($connexion->connect_error) {
            die("Échec de la connexion : " . $connexion->connect_error);
        }

        // Échapper les données pour éviter les injections SQL
        $id_patient_echappe = $connexion->real_escape_string($id_patient);

        // Exécuter la requête SQL pour récupérer les détails du patient spécifique
        $sql = "SELECT *, image FROM users WHERE username = '$id_patient_echappe'";
        $resultat = $connexion->query($sql);

        // Vérifier s'il y a des résultats
        if ($resultat->num_rows > 0) {
            // Récupérer les données du patient
            $row = $resultat->fetch_assoc();
            $prenom = $row["prenom"];
            $nom = $row["nom"];
            $date_naissance = $row["date_naissance"];
            $sexe = $row["sexe"];
            $telephone = $row["telephone"];
            $image_encodee = base64_encode($row["image"]);
            $user_name = $row['username'];

            // Utiliser les données récupérées pour remplir les sections de la page HTML
            echo "<div class='flex justify-center items-center w-full mt-20'>
                    <div id='case' class='w-[90%] rounded-3xl ' style='border: 1px solid #727272;'>
                        <div class='flex flex-col justify-center items-center'>
                            <div class='flex justify-center items-center' style='position: relative;top: -200px;'>
                            <img src='data:image/jpeg;base64,$image_encodee' class='imag' style='border-radius: 100%'/>
                            </div>
                            <div class='flex justify-center items-center w-1/4' style='position: relative;top: -200px;'>
                                <h1 id='nomprenom' class=' font-black text-border text-white text-center'>". $row["prenom"] . " " . $row["nom"] ."</h1>
                            </div>               
                        </div>
                        <div  class='mx-1 mt-4' style='position: relative;top: -200px;'>
                            <fieldset class='flex justify-center items-center rounded-2xl' style='border: 1px solid #727272;border-raduis:100px;'>
                                <legend class='ml-10' style='color:#727272'>Données Personel</legend>
                                <div class='w-11/12 mt-4 mb-5 columns-3 columns-2xs'>
                                    <div>
                                        <div class='title'>
                                            Prenom :
                                        </div>
                                        <div class='info'>
                                            $prenom
                                        </div>
                                    </div>    
                                    <div>
                                        <div class='title'>
                                            Nom :
                                        </div>
                                        <div class='info'>
                                            $nom
                                        </div>
                                    </div> 
                                    <div>
                                        <div class='title'>
                                            Date de naissance :
                                        </div>
                                        <div class='info'>"
                                        .substr($date_naissance,8,2)."/".substr($date_naissance,5,2)."/".substr($date_naissance,0,4) ."
                                        </div>
                                    </div>
                                    <div>
                                        <div class='title'>
                                            Sexe:
                                        </div>
                                        <div class='info'>
                                            $sexe

                                        </div>
                                    </div> 
                                    <div>
                                        <div class='title'>
                                            Telephone :
                                        </div>
                                        <div class='info'>
                                            $telephone
                                        </div>
                                    </div> 
                                </div>
                            </fieldset>
                        </div>";
        }
    }
?>    
    <div  class='mx-1 mt-4' style='position: relative;top: -200px;'>
        <fieldset class='flex justify-center items-center rounded-2xl' style='border: 1px solid #727272;border-raduis:100px;'>
            <legend class='ml-10' style='color:#727272'>Dossier Medical</legend>
                <div class='w-[90%] mt-4 mb-5' style="">
                    <?php
                            // Connexion à la base de données
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "cabinet";
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Vérifier la connexion
                            if ($conn->connect_error) {
                                die("La connexion a échoué : " . $conn->connect_error);
                            }
                            // Nom d'utilisateur à utiliser pour la sélection des dossiers médicaux
                            // Supposons que vous le récupérez depuis l'URL
                            // Requête SQL pour récupérer les dossiers médicaux pour un nom d'utilisateur donné
                            $sql = "SELECT * FROM doss_m WHERE username='$user_name'";
                            $result = $conn->query($sql);
                            $nombredoss=$result->num_rows ;
                            $i = 0;
                            if ($nombredoss> 0) {
                                 while($row = $result->fetch_assoc()) {
                                     $lien=substr($row["File"],3);
                                        $i++;
                                     echo "
                                             <fieldset class='flex justify-center items-center rounded-2xl' style='border: 1px solid #727272;border-raduis:100px;''>
                                                 <legend class='ml-10' style='color:#727272;'>Dossier $i</legend>
                                                 <div class='w-11/12 mt-4 mb-5 columns-2 columns-2xs'>
                                                     <div>
                                                         <div class='title1'>
                                                             ". $row["titre"]."
                                                         </div>
                                                         <div >

                                                                <div class='title1 ml-2'>
                                                                date :". $row["date"]."
                                                                </div>
                                                                <div class='info' style='max-height: 200px;max-width:100%;overflow: auto;' class='overflow-wrap-break-word'>    
                                                                    ".$row["descr"]."
                                                                </div>
                                                                <div style='max-height: 300px;max-width:100%;display:flex;justify-content:center'>
                                                                    <img src='". $lien."' class='imagdoss'/>
                                                                </div>
                                                         </div>
                                                     </div> 

                                                 </div>
                                              </fieldset>
                                             ";  
                                 }
                            } else {
                                echo "Aucun dossier médical trouvé pour cet utilisateur.";
                            }

                            // Fermer la connexion à la base de données
                            $conn->close();
                    ?>
            </div>
        </fieldset>
    </div>




</div>
</div>



<script>
                                x = window.innerWidth ;
                                if(x>=1110){
                                    document.getElementsByClassName("imag")[0].style.width=100+'px' ;
                                    document.getElementsByClassName("imag")[0].style.height=100+'px' ;  
                                    document.getElementsByClassName("imag")[1].style.width=250+'px' ;  
                                    document.getElementsByClassName("imag")[1].style.height=250+'px' ;  
                                    document.getElementById('nomprenom').classList.add('text-5xl');     
                                    for (let i = 0; i <=4; i++) {
                                        document.getElementsByClassName("title")[i].style.fontSize='x-large' ;  
                                        document.getElementsByClassName("info")[i].style.fontSize='large' ;  
                                    }             
                                    for (let i = 0; i <= <?php echo $nombredoss ?>; i++) {
                                        document.getElementsByClassName("info")[i+5].style.fontSize='large' ;  
                                        document.getElementsByClassName("title1")[i].style.fontSize='x-large' ;  
                                        document.getElementsByClassName("imagdoss")[i].style.width=200+'px' ;  
                                        document.getElementsByClassName("imagdoss")[i].style.height=200+'px' ;  
                                    }               
                                }else{
                                    document.getElementById("nomprenom").style.fontSize=x/20+'px' ;
                                    document.getElementsByClassName("imag")[0].style.width=80+'px' ;
                                    document.getElementsByClassName("imag")[1].style.width=120+'px' ;  
                                    document.getElementsByClassName("imag")[1].style.height=120+'px' ;  
                                    document.getElementsByClassName("imag")[0].style.height=80+'px' ;
                                    for (let i = 0; i <=4; i++) {
                                        document.getElementsByClassName("title")[i].style.fontSize='large' ;  
                                        document.getElementsByClassName("info")[i].style.fontSize='small' ;  
                                    }    
                                    for (let i = 0; i <= <?php echo $nombredoss ?>; i++) {
                                        document.getElementsByClassName("info")[i+5].style.fontSize='small' ;  
                                        document.getElementsByClassName("title1")[i].style.fontSize='large' ;  
                                        document.getElementsByClassName("imagdoss")[i].style.width=200+'px' ;  
                                        document.getElementsByClassName("imagdoss")[i].style.height=200+'px' ;  
                                    }
                                }
  
</script>
</body>
</html>