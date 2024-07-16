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
    


    $username = $_SESSION['username'];
     $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($_POST['mdp'], $user['hashed_password'])) {

                    $stmt = $conn->prepare("DELETE FROM conge WHERE doctor = :username");
                    $stmt->bindParam(':username', $profileusername);
                    $stmt->execute();
                        
                    
                    $stmt = $conn->prepare("DELETE FROM note WHERE doctor = :username");
                    $stmt->bindParam(':username', $profileusername);
                    $stmt->execute();

                    $stmt = $conn->prepare("DELETE FROM rdvs WHERE doctor = :username");
                    $stmt->bindParam(':username', $profileusername);
                    $stmt->execute();
                    
                    $stmt = $conn->prepare("DELETE FROM users WHERE username = :username");
                    $stmt->bindParam(':username', $profileusername);
                    $stmt->execute();

                    setcookie('username',null, time() - (86400 * 30), "/");
                    setcookie('password',null, time() - (86400 * 30), "/");
                    $_SESSION['username'];
                    $_SESSION['userimage'];


                    header("Location: ../index.php?error=le compte a ete supprimer");
                    
                } else{
                    header("Location: profile.php?error=mot de passe incorrect");
                    exit();
                }
            } else {
                header("Location: profile.php?error=user_not_found");
                exit();
            }


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
