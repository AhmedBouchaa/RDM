<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "cabinet";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $daych = $_GET['day'];

        // Ensure $daych is not empty and in correct format
        if (!empty($daych) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $daych)) {
            $today = new DateTime();
            $day = new DateTime($daych);

            // Check if the chosen date is greater than today
            if ($day > $today) {
                $dayFormatted = $day->format('Y-m-d'); // Format the date to match SQL format
                
                // Check if the date already exists in the database
                $checkStmt = $conn->prepare("SELECT COUNT(*) FROM conge WHERE doctor=:doctor and date = :day");
                $checkStmt->bindParam(':day', $dayFormatted);
                $checkStmt->bindParam(':doctor',$_SESSION['username']);
                $checkStmt->execute();
                $dateExists = $checkStmt->fetchColumn();

                if ($dateExists == 0) {
                    // If the date does not exist, insert it into the database
                    $stmt = $conn->prepare("INSERT INTO conge (date,doctor) VALUES (:day,:doctor)");
                    $stmt->bindParam(':day', $dayFormatted);
                    $stmt->bindParam(':doctor', $_SESSION['username']);
                    $stmt->execute();

                    header("Location: abscence.php?message=Votre absence est enregistrée.");
                    exit();
                } else {
                    header("Location: abscence.php?error=La date existe déjà dans la base de données.");
                    exit();
                }
            } else {
                header("Location: abscence.php?error=Date invalide ou bien déjà passée.");
                exit();
            }
        } else {
            header("Location: abscence.php?error=Date invalide fournie.");
            exit();
        }
    } else {
        header("Location: abscence.php");
        exit();
    }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}

$conn = null;
?>
