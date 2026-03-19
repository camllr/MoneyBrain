<?php
session_start();

require_once __DIR__ . '/../app/logic.php';

if (
    !isset(
        $_SESSION['objectif_montant'],
        $_SESSION['date_debut_mois'],
        $_SESSION['date_fin_mois']
    )
) {
    header('Location: objectif.php');
    exit;
}

$amount = $_SESSION['objectif_montant'];
$start  = $_SESSION['date_debut_mois'];
$end    = $_SESSION['date_fin_mois'];          

$error = null;
$nb_months = null;
$monthly_needed = null;

$nb_months = calculerNombreMois($start, $end, true);

if ($nb_months <= 0) {
    $error = "Problème de calcul sur les dates. Merci de vérifier ton objectif.";
} else {
    $monthly_needed = $amount / $nb_months;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyBrain - Récapitulatif</title>

    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/recap.css">

</head>

<body>
    <header class="header-fixed">
        <div class="header-logo">
            <img src="images/logo_MB.png" alt="logo_MB" class="logo-img">
            <span>MoneyBrain</span>
        </div>
    </header>

    <div class="container">
        <h1>Récapitulatif de ton objectif</h1>
    
        <p>
            Objectif total : <?php echo htmlspecialchars($amount); ?>€<br>
            Mois de début : <?php echo htmlspecialchars($start); ?><br>
            Mois de fin : <?php echo htmlspecialchars($end); ?><br>
        </p>
    
        <?php if ($error !== null): ?>
                <p style="color: red;">
                    <?php echo htmlspecialchars($error); ?>
                </p>
            <?php else: ?>
                <p>
                    Durée : <?php echo htmlspecialchars($nb_months); ?> mois<br>
                    Épargne mensuelle nécessaire : 
                    <?php echo number_format($monthly_needed, 2, ',', ' '); ?> € / mois
                </p>
            <?php endif; ?>
    
                <div>
                    <button type="submit">Continuer</button>
                </div>
    </div>

    <footer class="footer-fixed">
        <a href="date_fin.php" class="button-retour">Date Fin</a>
    </footer>
</body>

</html>