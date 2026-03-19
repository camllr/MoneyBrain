<?php
session_start();

if (!isset($_SESSION['objectif_montant'])) {
    header('Location: objectif.php');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'] ?? null;

    if ($amount === null || $amount === '') {
        $error = "Merci d'indiquer un montant (mets 0 si tu n'as rien encore).";
    } else {
        $amount = (float) $amount;

        if ($amount < 0) {
            $error = "Le montant ne peut pas être négatif.";
        } else {
            $_SESSION['epargne_deja_realisee'] = $amount;

            header('Location: date_fin.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MoneyBrain - Épargne déjà réalisée</title>

  <link rel="stylesheet" href="css/base.css">

</head>

<body>
  <header class="header-fixed">
      <div class="header-logo">
        <img src="images/logo_MB.png" alt="logo_MB" class="logo-img">
        <span>MoneyBrain</span>
      </div>
  </header>

  <div class="container">
    <h1>As-tu déjà réalisé une épargne ?</h1>
  
    <p class="sous-titre">Objectif actuel : <?php echo htmlspecialchars($_SESSION['objectif_montant']); ?>€</p>
  
    <form action="economie_realisee.php" method="post">
      <label for="start_month" class="sous-titre">Montant déjà épargné</label>
      
      <div>
                <input type="number" id="amount" name="amount" min="0" step="0.01" required>
                <span>€</span>
            </div>

            <?php if ($error !== null): ?>
            <p style="color: red;">
                <?php echo htmlspecialchars($error); ?>
            </p>
            <?php endif; ?>

      <div>
        <button type="submit">Continuer</button>
      </div>
    </form>
  </div>

  <footer class="footer-fixed">
        <a href="date_debut.php" class="button-retour">Date Début</a>
  </footer>
  
</body>
</html>