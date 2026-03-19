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

    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/objectif.css">

</head>
<body>
    <header class="header-fixed">
        <div class="header-logo">
        <img src="images/logo_MB.png" alt="logo_MB" class="logo-img">
        <span>MoneyBrain</span>
        </div>
    </header>

    <div class="container">
        <h1>Quel est ton objectif d'économie ?</h1>
    
        <form class="objectif-container" action="objectif.php" method="post">
            <div>
                <input type="number" id="amount" name="amount" min="1" step="0.01" required>
                <span>€</span>
            </div>
            <button type="submit">Continuer</button>
        </form>
    </div>

</body>
</html>