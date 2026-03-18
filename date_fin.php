<?php
session_start();

if (!isset($_SESSION['objectif_montant'], $_SESSION['date_debut_mois'])) {
    header('Location: objectif.php');
    exit;
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $end_month = $_POST['end_month'] ?? null;

    if (!empty($end_month)) {
        $_SESSION['date_fin_mois'] = $end_month;

        // A faire : redirection vers la page suivant : recap.php
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MoneyBrain - Date de fin</title>
</head>
<body>

  <h1>Jusqu'à quand souhaites-tu économiser ?</h1>

  <p>Objectif actuel : <?php echo htmlspecialchars($_SESSION['objectif_montant']); ?>
    €<br>
    Mois de début : <?php echo htmlspecialchars($_SESSION['date_debut_mois']); ?>
  </p>

  <form action="date_fin.php" method="post">
    <label for="end_month">Mois de fin (MM/AAAA)</label>
    <input type="text" id="end_month" name="end_month" required placeholder="03/2026" pattern="^(0[1-9]|1[0-2])\/[0-9]{4}$">

    <button type="submit">Continuer</button>
  </form>
</body>
</html>