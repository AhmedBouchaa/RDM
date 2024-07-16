<?php
// Connexion à la base de données avec PDO
$servername = "localhost";
$username = "root";
$password = "";
$database = "cabinet";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Paramétrage de PDO pour lever une exception en cas d'erreur SQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $telephone = $_POST['telephone'];
    $sexe=$_POST['sexe'];
    $post = $_POST['post'];
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_content = file_get_contents($image_tmp);
        // Vérification si les deux mots de passe sont identiques
    if ($password1 !== $password2) {
        // Redirection vers la page d'inscription avec un message d'erreur
        header("Location: index.php?error=password_mismatch");
        exit(); // Arrêt du script
    }

    
    // Hash du mot de passe
    $password_hashed = password_hash($password1, PASSWORD_DEFAULT);

   // Préparer la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO users (nom, prenom, date_naissance, telephone, image, sexe, username, hashed_password,post) VALUES (:nom, :prenom, :date_naissance, :telephone, :image, :sexe, :username, :password,:post)");
    
    // Bind des paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':image', $image_content, PDO::PARAM_LOB);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password_hashed);
    $stmt->bindParam(':post', $post);
    
    // Exécution de la requête
    $stmt->execute();
    session_start();
    $_SESSION['username'] = $username;
                $image_encodee = base64_encode($image_content);
            $_SESSION['userimage']="data:image/jpeg;base64,$image_encodee";
    if(strcmp($post,"Patient")==0){
        header("Location:patient/index.php");
    }
    else{
        header("Location:doctor/index.php");
    }
} catch(PDOException $e) {
        if ($e->errorInfo[1] === 1062) {
        // 1062 is the MySQL error code for duplicate entry
        // Handle the duplicate username error here, for example:
        header("Location: index.php?error=Le nom d'utilisateur est déjà utilisé. Veuillez en choisir un autre.");
    } else {
        // Handle other PDOException errors
        echo "Erreur : " . $e->getMessage();
    }
}
// Fermer la connexion
$conn = null;
?>
