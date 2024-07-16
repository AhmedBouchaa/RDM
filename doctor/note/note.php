<?php
session_start();

// Vérifiez si le patient est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$servername = "localhost";
$username = "root"; // Changez cela si nécessaire
$password = ""; // Changez cela si nécessaire
$dbname = "cabinet";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patients</title>
    <link rel="stylesheet" href="../styles\NavStyle.css" />
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
        background-image: url("../../images/shape1.svg");
        background-size: 140% auto, cover;
        background-repeat: no-repeat;
        background-position: -200px 0px;
      }
      .btn{
        background-color: rgba(0, 0, 0, 0);
        width: 100%;
        font-size: 20px;
      }
      .cls{
      }
    </style>
  </head>
  <body>
    <div class="">

    <header class=" h-48">
      <div class="navbar">
        <div class="w-28 h-28 p-2.5 rounded-[100px] border-4 border-[#009b9f] flex justify-center items-center logo"><img src="../../images/logo.png" alt=""></div>

        <ul class="links flex flex-row items-center">
          <li class="flex items-center"><a href="../index.php">RDVs</a></li>
          <li class="flex items-center"><a href="../patients.php">Patients</a></li>
          <li class="flex items-center"><a href="note.php">Note</a></li>
          <li class="flex items-center"><a href="../abscence/abscence.php">Abscence</a></li>
        </ul>
        <form action="../../profile.php" method="POST" class="action_btn rounded-full w-28 h-28 flex justify-center items-center">
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
          <li class="flex items-center"><a href="note/note.php">Note</a></li>
          <li class="flex items-center"><a href="../abscence/abscence.php">Abscence</a></li>
          <li><form action="../profile.php" method="POST" class="action_btn ">
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
        <div class="text-white p-3 pt-0 text-center mb-10">
          <h1 id="text1" class=" mt-0 text-8xl font-black text-border">Note</h1>
          <script>
            let x=window.innerWidth;
            document.getElementById('text1').style.fontSize=x*7/100+'px';
        </script>
        </div>
      </div>

      <!-- nptes -->
      <div id="notes" class="w-full flex justify-center items-center">
        <div class="justfy-content grid gap-10 grid-cols-1 w-full" >

          <?php
                $username = $_SESSION['username'];
                $sql = "SELECT * FROM note WHERE doctor='$username'";
                $result = $conn->query($sql);
                $nombrenote=$result->num_rows;
                if ( $nombrenote> 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div   id='div".$row['id']."'style='height:210px;width:80%;margin-left:10%;display:flex;flex-direction:row;'>";
                        $servername = "localhost";
                        $username = "root"; // Changez cela si nécessaire
                        $password = ""; // Changez cela si nécessaire
                        $dbname = "cabinet";
                        $conn1 = new mysqli($servername, $username, $password, $dbname);

                        $usernow = $row['username'];

                        $sql = "SELECT image FROM users WHERE username='$usernow'";

                        $image = $conn1->query($sql);
                        $row_image = $image->fetch_assoc();

                        $imageData = $row_image['image']; 
                        $base64Image = base64_encode($imageData);

                        echo "<img src='data:image/jpeg;base64," . $base64Image . "' class='images' style='width: 20%; border-radius: 100% ;'/>";
                        echo "<div id='sousdiv".$row['id']."' style='display:flex;flex-direction:column;padding:2%;padding-bottom:2%;;width:80%;;margin-left:1%;border-radius: 30px ; border: 1px #009B9F solid'>";
                        echo "    <h2 class='nomprenom' style='margin-right:0px;color:#727272'>".$row['username'].":</h2><div id='".$row['id']."' style='width:100%;height:66px;overflow:hidden;'><span id='text".$row['id']."' style='width:100%;height:60px;overflow:hidden;' >" . $row['text'] . "</span></div>";
                        echo "    <div id='btnto" . $row['id'] . "'></div>";

                        echo "</div>";

                        echo "</div>";

                        echo "<script>
                                var longueur =document.getElementById('text".$row['id']."').offsetHeight;


                                if(longueur > 66){

                                  document.getElementById('btnto".$row['id']."').innerHTML='<button id=".'"btn'.$row['id'].'"'." class=".'"btn"'." >show more</button>';
                                  let div =document.getElementById('div".$row['id']."');
                                  let sousdiv = document.getElementById('sousdiv".$row['id']."');
                                  let the=document.getElementById('".$row['id']."');
                                  let thetext=document.getElementById('text".$row['id']."');
                                  let btn = document.getElementById('btn".$row['id']."');
                                  btn.onclick = function(){
                                    if(div.className=='cls'){
                                      div.className ='';
                                      sousdiv.className ='';
                                      div.style.height='210px';
                                      the.style.height='60px';
                                      thetext.style.height='60px';     
                                      the.style.overflow='hidden';
                                      thetext.style.overflow='hidden';
                                      btn.innerHTML ='show more';
                                    } else {
                                      div.className = 'cls';
                                      sousdiv.className ='cls';                              
                                      div.style.height='';
                                      the.style.height='';
                                      thetext.style.height='';    
                                      the.style.overflow='show';                                
                                      thetext.style.overflow='show';                                
                                       btn.innerHTML = 'show less'; 

                                    }
                                  }
                                }
                              </script>";
                                        $conn1->close();  

                    }
                } else {
                    echo "Aucune note trouvée.";
                }

            $conn->close();
            ?>






        </div>
      </div>
    </div>
        <script>
        if(x>800){
                  for (let i = 0; i < <?php echo json_encode($nombrenote); ?> ; i++) {
                    document.getElementsByClassName("nomprenom")[i].style.fontSize=20+'px';
                    document.getElementsByClassName("images")[i].style.width=200+'px';
                    document.getElementsByClassName("images")[i].style.height=200+'px';
                  }  
        }else{
                  for (let i = 0; i < <?php echo json_encode($nombrenote); ?> ; i++) {
                  document.getElementsByClassName("nomprenom")[i].style.fontSize=x*5/100+'px';
                  document.getElementsByClassName("images")[i].style.marginTop=x/12+'px';
                  document.getElementsByClassName("images")[i].style.height=x*3/10+'px';
                  document.getElementsByClassName("images")[i].style.height=x*3/10+'px';
                  
                }
        }
    </script>
  </body>
</html>
