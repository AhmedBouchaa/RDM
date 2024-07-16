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
        $jourde = $_GET['de'];
        $jourvers = $_GET['vers'];

        if (!empty($jourde) && !empty($jourvers)) {
            $start = new DateTime($jourde);
            $end = new DateTime($jourvers);
            $today = new DateTime();
            if ($start > $today || $end > $today) {
                if ($start < $end) {
                    $end->modify('+1 day');

                    $period = new DatePeriod($start, new DateInterval('P1D'), $end);

                    foreach ($period as $date) {
                        $day = $date->format("Y-m-d");

                        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM conge WHERE doctor=:doctor and  date = :day");
                        $checkStmt->bindParam(':day', $day);
                        $checkStmt->bindParam(':doctor',$_SESSION['username']);
                        $checkStmt->execute();
                        $dateExists = $checkStmt->fetchColumn();

                        if ($dateExists == 0) {
                            $stmt = $conn->prepare("INSERT INTO conge (date,doctor) VALUES (:day,:doctor)");
                            $stmt->bindParam(':day', $day);
                            $stmt->bindParam(':doctor', $_SESSION['username']);
                            $stmt->execute();
                        } else {
                            header("Location: abscence.php?error=La date $day existe déjà dans la base de données.");
                            exit();
                        }
                    }
                    header("Location: abscence.php?message=Votre absence est enregistrée.");
                    exit();
                } else {
                    header("Location: abscence.php?error=La date de fin doit être supérieure à la date de début");
                    exit();
                }
            }else{
                header("Location: abscence.php?error=les dates doivent être futures.");
                exit();
            }
        } else {
            header("Location: abscence.php?error=dates non valides.");
            exit();
        }
    } else {
        header("Location: abscence.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit();
}

$conn = null;
?>
