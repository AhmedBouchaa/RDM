<?php
session_start();
// Connexion à la base de données avec PDO
$servername = "localhost";
$username = "root";
$password = "";
$database = "cabinet";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si les données du formulaire ont été soumises
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $date = $_POST['date'];
        $seance = $_POST['seance'];
        $doct = $_POST['ID_DU_Doctor'];

        // Vérifier si la séance est déjà réservée pour la date sélectionnée
        $stmt = $conn->prepare("SELECT COUNT(*) FROM RDVs WHERE date = :date AND num_seance = :seance and doctor=:doctor");
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':seance', $seance);
        $stmt->bindParam(':doctor', $_POST["ID_DU_Doctor"]);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            header("Location:select_seance.php?error=La séance sélectionnée est déjà réservée. Veuillez choisir une autre séance.");
        } else {
            // La séance est disponible, insérer le rendez-vous dans la base de données
            $stmt = $conn->prepare("INSERT INTO RDVs (date, num_seance,username,doctor) VALUES (:date, :seance,:username,:doctor)");
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':seance', $seance);
            $stmt->bindParam(':doctor', $doct);
            $stmt->bindParam(':username',$_SESSION['username']);
            $stmt->execute();
            header("Location: ../index.php?message=Le rendez-vous a été enregistré avec succès pour le " . $date . " à la séance " . $seance . ".");
        }
    } else {
        // Rediriger vers la première page si les données du formulaire ne sont pas soumises
        header("Location: select_date.php?error=La séance sélectionnée est déjà réservée. Veuillez choisir une autre séance.");
        exit;
    }
} catch(PDOException $e) {
    header("Location: ../index.php?error=une erreur se produite.");
}

// Fermer la connexion
$conn = null;
exit;
?>
