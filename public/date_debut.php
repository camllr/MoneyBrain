<?php
session_start();

if(!isset($_SESSION['objectif_montant'])) {
  // A faire : redirection vers la page précédente : objectif.php
  header('Location: objectif.php');
  exit();
}

$error = null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $start_month = $_POST['start_month'] ?? null;

  if (empty($start_month)) {
    $error = "Merci d'indiquer un mois de début.";
    } else {
        if (!preg_match('/^(0[1-9]|1[0-2])\/[0-9]{4}$/', $start_month)) {
            $error = "Format invalide. Utilise le format MM/AAAA (ex : 03/2026).";
        } else {
            $_SESSION['date_debut_mois'] = $start_month;

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
  <title>MoneyBrain - Date de début</title>

  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/date_debut.css">

</head>
<header class="header-fixed">
    <div class="header-logo">
      <img src="images/logo_MB.png" alt="logo_MB" class="logo-img">
      <span>MoneyBrain</span>
    </div>
</header>

<body>
  <div class="container">
    <h1>Quand souhaites-tu commencer ?</h1>
  
    <p class="sous-titre">Objectif actuel : <?php echo htmlspecialchars($_SESSION['objectif_montant']); ?>€</p>
  
    <form action="date_debut.php" method="post">
      <label for="start_month" class="sous-titre">Mois de début</label>
      
      <div>
        <input type="text" id="start_month" name="start_month" required placeholder="03/2026" pattern="^(0[1-9]|1[0-2])\/[0-9]{4}$">
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
</body>
</html>