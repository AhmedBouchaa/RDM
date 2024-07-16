<?php

    
        session_start();
        $p1 = $_POST['p1'];
        $p2 = $_POST['p2'];
        $p3 = $_POST['p3'];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "cabinet";
        try {
        if ($p2 !== $p3) {
            header("Location: profile.php?error=password_mismatch");
            exit(); // Arrêt du script
            }
        else{
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $username = $_SESSION['username'];

            $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($p1, $user['hashed_password'])) {
                        $stmt = $conn->prepare("UPDATE users
                        SET hashed_password = :pass WHERE username=:username");    
                        $password_hashed = password_hash($p2, PASSWORD_DEFAULT);
                        $stmt->bindParam(':pass', $password_hashed);
                        $stmt->bindParam(':username', $username);
                            $stmt->execute();
                    header("Location: ../index.php?message=mot de passe a ete change avec succees");
                    
                } else{
                    header("Location: profile.php?error=mot de passe incorrect");
                    exit();
                }
            } else {
                header("Location: profile.php?error=user_not_found");
                exit();
            }
        } }catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        // Fermer la connexion
        $conn = null;
?>
