<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patients</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="../styles\NavStyle.css" />
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
    <div class="overflow-hidden ">

    <header class=" h-48">
      <div class="navbar">
        <div class="w-28 h-28 p-2.5 rounded-[100px] border-4 border-[#009b9f] flex justify-center items-center logo"><img src="../../images/logo.png" alt=""></div>
        <ul class="links flex flex-row items-center">
          <li class="flex items-center"><a href="../index.php">RDVs</a></li>
          <li class="flex items-center"><a href="../patients.php">Patients</a></li>
          <li class="flex items-center"><a href="../note/note.php">Note</a></li>
          <li class="flex items-center"><a href="abscence.php">Abscence</a></li>
        </ul>
        <form action="../../profile/profile.php" method="POST" class="action_btn rounded-full w-28 h-28 flex justify-center items-center">
          <input type='text' name='ID_DU_USER' value='<?php echo $_SESSION['username']?>' style='display:none;'>
          <button type="submit">
            <img src=<?php echo "'" . $_SESSION["userimage"] . "'";?> alt="" class="w-28 h-28" style="border-radius:100%;border: 0px #727272 solid ;">
          </button>
        </form>
        <div class="toggle_btn"><i class="fa-solid fa-bars" style="color:#727272"></i></div>
      </div>
      <div class="dropdown_menu ">
          <li class="flex items-center"><a href="../index.php">RDVs</a></li>
          <li class="flex items-center"><a href="../patients.php">Patients</a></li>
          <li class="flex items-center"><a href="../note/note.php">Note</a></li>
          <li class="flex items-center"><a href="abscence.php">Abscence</a></li>
          <li><form action="../../profile/profile.php" method="POST" class="action_btn ">
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

      <div class="flex  justify-center items-center w-full">

        <div id="bigcasier" class="rounded-3xl" style="border: 1px solid #727272;">
            <form class="" action="submit_con.php" method="get">
                <fieldset class="flex flex-col  rounded-3xl" style="border: 1px solid #727272;">
                    <legend class="ml-10">Congé</legend>

                    <div class="flex flex-row">

                        <fieldset class="littlecasier flex flex-col justify-center items-center rounded-xl" style="border: 1px solid #727272;border-raduis:100px;">
                          <h1 class="font-black text-border text-white 2chiff ">DE</h1>
                          <div class="relative max-w-sm mt-8">
                              <input  type="date" name="de" class="dateinput bg-gray-50 border border-gray-300 text-gray-900 rounded-full focus:ring-myblue focus:border-myblue block w-full  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-#009b9f dark:focus:border-#009b9f" placeholder="Select date">
                          </div>

                        </fieldset>   
                        
                        
                        
                        
                        <fieldset class="littlecasier flex flex-col justify-center items-center rounded-xl" style="border: 1px solid #727272;border-raduis:100px;">
                          <h1 class="font-black text-border text-white 2chiff">A</h1>

                          <div class="relative max-w-sm mt-8">
                              <input type="date" name="vers" class="dateinput  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-myblue focus:border-myblue block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-#009b9f dark:focus:border-#009b9f" placeholder="Select date">
                          </div>
                          
                        </fieldset> 
                    </div>
                    <br>
                    <div class="flex justify-center items-center">
                      <input type="submit"  class="action_btn text-white font-bold rounded-full btnvalider" style="background-color:#009b9f" value="Valider" name="" id="">
                    </div>
                    
                </fieldset>
            </form>


            <form class="" action="submit_abs.php" method="get">
                <fieldset class="flex flex-row justify-center align-items rounded-2xl" style="border: 1px solid #727272;border-raduis:100px;">
                    <legend class="ml-10">Abscence</legend>

                    <div class="relative max-w-sm  flex justify-center items-center  h-20 w-2/3">

                              <input type="date" name="day" class="dateinput bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-myblue focus:border-myblue block w-full  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-#009b9f dark:focus:border-#009b9f" placeholder="Select date">
                    </div>                         

                    <div class="btn flex justify-center items-center">
                      <input type="submit" class="action_btn text-white font-bold rounded-full btnvalider" style="background-color:#009b9f" value="Valider" name="" id="">
                    </div>
                    
                </fieldset>
            </form>            
        </div>

      </div>
    </div>

    
                                <script>
                                   let x=window.innerWidth;

                                    
                                    


                                    if(x>=1110){
                                        document.getElementsByClassName('2chiff')[0].style.fontSize=x*7/100+'px';   
                                        document.getElementsByClassName('2chiff')[1].style.fontSize=x*7/100+'px';                                     
                                        document.getElementsByClassName('btnvalider')[0].style.fontSize=x*2/100+'px';   
                                        document.getElementsByClassName('btnvalider')[1].style.fontSize=x*2/100+'px'; 

                                        document.getElementsByClassName("btnvalider")[0].classList.add("px-2");
                                        document.getElementsByClassName("btnvalider")[0].classList.add("mb-4");
                                        document.getElementsByClassName("btnvalider")[1].classList.add("px-2");
                                        document.getElementsByClassName("btnvalider")[1].classList.add("mr-4");
                                        document.getElementById("bigcasier").classList.add("w-[55%]");
                                        document.getElementById("bigcasier").classList.add("p-[2%]");

                                        document.getElementsByClassName("littlecasier")[0].classList.add("p-6");
                                        document.getElementsByClassName("littlecasier")[1].classList.add("p-6");                                       
                                        document.getElementsByClassName("littlecasier")[0].classList.add("ml-[10%]");
                                        document.getElementsByClassName("littlecasier")[1].classList.add("ml-[6%]");

                                        document.getElementsByClassName("dateinput")[0].style.width=x*15/100+'px'; 
                                        document.getElementsByClassName("dateinput")[1].style.width=x*15/100+'px'; 
                                        document.getElementsByClassName("dateinput")[2].style.width=x*20/100+'px'; 




                                    }else{
                                        document.getElementsByClassName('2chiff')[0].style.fontSize=x*15/100+'px';   
                                        document.getElementsByClassName('2chiff')[1].style.fontSize=x*15/100+'px';                                     
                                        document.getElementsByClassName('btnvalider')[0].style.fontSize=x*7/100+'px';   
                                        document.getElementsByClassName('btnvalider')[1].style.fontSize=x*7/100+'px'; 

                                        document.getElementsByClassName("btnvalider")[0].classList.add("px-2");
                                        document.getElementsByClassName("btnvalider")[0].classList.add("mb-4");
                                        document.getElementsByClassName("btnvalider")[1].classList.add("px-2");
                                        document.getElementsByClassName("btnvalider")[1].classList.add("mr-4");
                                        document.getElementById("bigcasier").classList.add("w-[90%]");
                                        document.getElementById("bigcasier").classList.add("px-[5%]");
                                        document.getElementsByClassName("littlecasier")[0].classList.add("p-1");
                                        document.getElementsByClassName("littlecasier")[1].classList.add("p-1");                                       
                                        document.getElementsByClassName("littlecasier")[0].classList.add("m-4");
                                        document.getElementsByClassName("littlecasier")[1].classList.add("m-4");

                                        document.getElementsByClassName("dateinput")[0].style.width=x*30/100+'px'; 
                                        document.getElementsByClassName("dateinput")[1].style.width=x*30/100+'px'; 
                                        document.getElementsByClassName("dateinput")[2].style.width=x*30/100+'px'; 
                                        

                                        
 

                                    }
                                    // document.getElementsByClassName('btn')[0].style.width=x*7/100+'px';   
                                    // document.getElementsByClassName('btn')[1].style.width=x*7/100+'px'; 


                                    // document.getElementsByClassName('petitcasier')[1].style.width=x*7/100+'px';
                                    // document.getElementsByClassName('petitcasier')[2].style.width=x*7/100+'px'; 




                                    // document.getElementsByClassName('petitcasier1')[0].style.width=x+'px'; 
                                    // document.getElementsByClassName('petitcasier1')[1].style.width=x+'px';

                                    // document.getElementsByClassName('petitcasierinput')[0].style.width=x*7/100+'px';
                                    // document.getElementsByClassName('petitcasierinput')[1].style.width=x*7/100+'px'; 
                                    // document.getElementsByClassName('petitcasierinput')[2].style.width=x*7/100+'px'; 
                                    
                                    


                                    // document.getElementsByClassName('action_btn')[0].style.fontSize=x*7/100+'px';                                     
                                    // document.getElementsByClassName('action_btn')[1].style.fontSize=x*7/100+'px';    

                                  </script>
  </body>
</html>
