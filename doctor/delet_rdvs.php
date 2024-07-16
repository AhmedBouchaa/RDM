<?php
// Database connection details
$serveur = "localhost"; 
$utilisateur = "root"; 
$motdepasse = ""; 
$basededonnees = "cabinet"; 

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$basededonnees", $utilisateur, $motdepasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['rdv_id']) && !empty($_POST['rdv_id'])) {
        $id = $_POST['rdv_id'];
        $sql = 'DELETE FROM rdvs WHERE id = :id';
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header("Location:index.php?message=Rendez-vous supprimé avec succès.");
        } else {
            header("Location: index.php?error=Erreur lors de la suppression du rendez-vous.");
        }
    } else {
        header("Location: index.php?error=Aucun ID de rendez-vous fourni.");
    }
} catch(PDOException $e) {
    header("Location: index.php?error=Erreur de connexion : " . $e->getMessage());
}

$connexion = null;
exit; 
?>
