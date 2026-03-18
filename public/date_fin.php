<?php
session_start();

require_once __DIR__ . '/../app/logic.php';

if (!isset($_SESSION['objectif_montant'], $_SESSION['date_debut_mois'])) {
    header('Location: objectif.php');
    exit;
} 

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $end_month = $_POST['end_month'] ?? null;

    if (!empty($end_month)) {
        $start = $_SESSION['date_debut_mois'];

        $nb_months = calculerNombreMois($start, $end_month, true);

        if ($nb_months === null) {
            $error = "Le mois de fin doit être postérieur ou égal au mois de début.";
        } else {
            $_SESSION['date_fin_mois'] = $end_month;

            header('Location: recap.php');
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
    <title>MoneyBrain - Date de fin</title>

    <link rel="stylesheet" href="css/style.css">
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

        <?php if ($error !== null): ?>
            <p style="color: red;">
                <?php echo htmlspecialchars($error); ?>
            </p>
        <?php endif; ?>

        <button type="submit">Continuer</button>
    </form>
</body>
</html>