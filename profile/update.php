<?php
    session_start();
    $profileusername = $_SESSION['username'];
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
    $stmt = $conn->prepare("UPDATE users
SET nom = :nom, prenom = :prenom,date_naissance = :date_naissance, telephone = :telephone,image = :image
WHERE username=:username");    
    // Bind des paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':image', $image_content, PDO::PARAM_LOB);
    $stmt->bindParam(':username', $profileusername);

    
    // Exécution de la requête
    $stmt->execute();
    header("Location:profile.php");
} catch(PDOException $e) {
        if ($e->errorInfo[1] === 1062) {

        header("Location: profile.php?error=Il y a une erreur.");
    } else {
        // Handle other PDOException errors
        echo "Erreur : " . $e->getMessage();
    }
}
// Fermer la connexion
$conn = null;
?>
