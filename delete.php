<?php
include '_header.php';



// Vérifie si le bouton Supprimer a été cliqué
if (isset($_POST['delete_key'])) {

    try {
        // // Récupère la clé à supprimer
        $delete_key = $_POST['delete_key'];
        // Prépare et exécute la requête SQL pour supprimer l'utilisateur
        $stmt = $db->prepare("DELETE FROM movie WHERE movie_id = :id");
        $stmt->bindParam(':id', $delete_key);
        $stmt->execute();
    } catch (Exception $e) {

        var_dump($e->getMessage());
    }
    // Recharger la page ou rediriger vers la même page pour refléter les changements
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
