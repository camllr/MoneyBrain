<?php
session_start();

if(!isset($_SESSION['objectif_montant'])) {
  // A faire : redirection vers la page précédente : objectif.php
  header('Location: objectif.php');
  exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $start_month = $_POST['start_month'] ?? null;

  if (!empty($start_month)) {
    $_SESSION['date_debut_mois'] = $start_month;

    // A faire : gérer le cas de date passée + épargne déjà réalisée

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_month = $_POST['start_month'] ?? null;

    if (!empty($start_month)) {
        $_SESSION['date_debut_mois'] = $start_month;

        header('Location: date_fin.php');
        exit;
    }
}

  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MoneyBrain - Date de début</title>
</head>
<body>
  
  <h1>Quand souhaites-tu commencer ?</h1>

  <p>Objectif actuel : <?php echo htmlspecialchars($_SESSION['objectif_montant']); ?>€</p>

  <form action="date_debut.php" method="post">
    <label for="start_month">Mois de début</label>
    <input type="text" id="start_month" name="start_month" required placeholder="03/2026" pattern="^(0[1-9]|1[0-2])\/[0-9]{4}$">

    <button type="submit">Continuer</button>
  </form>
</body>
</html>