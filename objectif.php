<?php
session_start();

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'] ?? null;

    if ($amount === null || $amount === '' || $amount <= 0) {
        $error = "Merci d'indiquer un montant supérieur à 0.";
    } else {
        // On peut aussi forcer un format numérique propre
        $amount = (float) $amount;
        $_SESSION['objectif_montant'] = $amount;

        header('Location: date_debut.php');
        exit;
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

    <?php if ($error !== null): ?>
        <p style="color: red;">
            <?php echo htmlspecialchars($error); ?>
        </p>
    <?php endif; ?>

    <button type="submit">Continuer</button>
  </form>
</body>
</html>