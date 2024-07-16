<?php
session_start();
$target_dir = "../../uploads/"; // Répertoire de destination
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Vérifier si le fichier est une image réelle ou une fausse image
if(isset($_POST["submit"])) {
   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
   if($check !== false) {
       echo "";
       header("Location: choisirdoss_m.php?message=Le fichier est une image - " . $check["mime"] . ".");
       $uploadOk = 1;
   } else {
       echo "Le fichier n'est pas une image.";
       $uploadOk = 0;
   }
}

// // Vérifier si le fichier existe déjà
// if (file_exists($target_file)) {
//    echo "";
//    header("Location: choisirdoss_m.php?error=Désolé, le fichier existe déjà.");
//    $uploadOk = 0;
// }

// // Vérifier la taille du fichier
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//    echo "Désolé, le fichier est trop volumineux.";
//    $uploadOk = 0;
// }

// Autoriser certains formats de fichier
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
   echo "";
   header("Location: choisirdoss_m.php?error=Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.");
   $uploadOk = 0;
}

// Vérifier si $uploadOk est défini à 0 par une erreur
if ($uploadOk == 0) {
// Si tout est correct, essayer de télécharger le fichier
} else {
   // Insérer les données dans la base de données
   $titre = $_POST['titre'];
   $date_submit = date("Y-m-d"); // Date actuelle
   $user_name = $_SESSION['username'];
   $descr = $_POST['descrHidden'];
   
   // Déplacer le fichier vers le répertoire de destination
   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       // Connexion à la base de données (remplacez les valeurs par les vôtres)
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "cabinet";
       $conn = new mysqli($servername, $username, $password, $dbname);

       // Vérifier la connexion
       if ($conn->connect_error) {
           die("La connexion a échoué : " . $conn->connect_error);
       }

       // Préparer et exécuter la requête SQL pour insérer les données
       $sql = "INSERT INTO doss_m (titre, File, descr, date, username) VALUES (?, ?, ?, ?, ?)";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("sssss", $titre, $target_file, $descr, $date_submit, $user_name);

       if ($stmt->execute()) {
           header("Location: ../index.php?message=Le fichier et les données ont été enregistrés avec succès dans la base de données.");
       } else {
           echo "Erreur : " . $stmt->error;
       }

       // Fermer la connexion à la base de données
       $stmt->close();
       $conn->close();
   } else {
       header("Location: ../index.php?error=Désolé, une erreur s'est produite lors du téléchargement de votre fichier.");
   }
}
?>
