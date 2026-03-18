<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $amount = $_POST['amount'] ?? null;

  if ($amount !== null && $amount > 0) {
    $_SESSION['objectif_montant'] = $amount;

    header('Location: date_debut.php');
    exit();
  } else {
    // A faire : message d'erreur montant invalide
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MoneyBrain - Objectif</title>
</head>
<body>
  <h1>Quel est ton objectif d'économie ?</h1>

  <form action="objectif.php" method="post">
    <input type="number" id="amount" name="amount" min="1" step="0.01" required>
    <span>€</span>

    <button type="submit">Continuer</button>
  </form>
</body>
</html>