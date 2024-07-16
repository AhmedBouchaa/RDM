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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparer la requête de recherche de l'utilisateur
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Vérifier si l'utilisateur existe
    if ($stmt->rowCount() > 0) {
        // L'utilisateur existe, récupérer ses données
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Vérifier si le mot de passe correspond
        if (password_verify($password, $user['hashed_password'])) {
            // Mot de passe correct, rediriger vers home.php
            if (isset($_POST['souviens_toi_de_moi'])) {
            setcookie('remember_me', 'true', time() + (86400 * 30), "/");
            setcookie('username', $username, time() + (86400 * 30), "/");
            setcookie('password', $password, time() + (86400 * 30), "/");
            }
            session_start();
            $_SESSION['username'] = $username;
            $image_encodee = base64_encode($user["image"]);
            $_SESSION['userimage']="data:image/jpeg;base64,$image_encodee";
            if( strcmp($user['post'],'Patient')==0){
                header("Location: patient/index.php");
                exit();
            }
            else{
                header("Location:doctor/index.php");
                exit();
            }
        } else {
            // Mot de passe incorrect, redirection vers login.php avec un message d'erreur
            header("Location: index.php?error=invalid_password");
            exit();
        }
    } else {
        // L'utilisateur n'existe pas, redirection vers login.php avec un message d'erreur
        header("Location: index.php?error=user_not_found");
        exit();
    }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermer la connexion
$conn = null;
?>
