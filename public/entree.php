<?php
session_start();

// Tableau des entrées en session
if (!isset($_SESSION['entree'])) {
    $_SESSION['entree'] = [];
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'add';

    if ($action === 'add' || $action === 'edit') {
        $categorie = trim($_POST['categorie'] ?? '');
        $montant   = $_POST['montant'] ?? '';

        if ($categorie === '' || $montant === '') {
            $error = "Merci de renseigner une catégorie et un montant.";
        } else {
            $montant = (float) $montant;

            if ($montant <= 0) {
                $error = "Le montant doit être supérieur à 0.";
            } else {
                if ($action === 'add') {
                    $_SESSION['entree'][] = [
                        'id'        => uniqid('', true),
                        'categorie' => $categorie,
                        'montant'   => $montant,
                    ];
                } elseif ($action === 'edit') {
                    $id = $_POST['id'] ?? null;

                    if ($id !== null) {
                        foreach ($_SESSION['entree'] as $index => $entree) {
                            if ($entree['id'] === $id) {
                                $_SESSION['entree'][$index]['categorie'] = $categorie;
                                $_SESSION['entree'][$index]['montant']   = $montant; // [web:164]
                                break;
                            }
                        }
                    }
                }
            }
        }
    }
}
if (($_GET['action'] ?? null) === 'delete') {
    $id = $_GET['id'] ?? null;

    if ($id !== null) {
        foreach ($_SESSION['entree'] as $index => $entree) {
            if ($entree['id'] === $id) {
                unset($_SESSION['entree'][$index]);
                $_SESSION['entree'] = array_values($_SESSION['entree']);
                break;
            }
        }
    }
}

$totalEntrees = 0;
foreach ($_SESSION['entree'] as $entree) {
    $totalEntrees += $entree['montant']; // [web:158]
}

$editEntry = null;
$editIndex = null;

if (isset($_GET['edit_id'])) {
    $editId = $_GET['edit_id'];

    foreach ($_SESSION['entree'] as $index => $entree) {
        if ($entree['id'] === $editId) {
            $editEntry = $entree;
            $editIndex = $index;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyBrain - Entrées</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/entree.css">
    </head>
    <body>
    
    <header class="header-fixed">
        <div class="header-logo">
            <img src="images/logo_MB.png" alt="logo_MB" class="logo-img">
            <span>MoneyBrain</span>
        </div>
    </header>

    <div class="container">
        <h1>Entrées du mois :</h1>

        <form action="entree.php" method="post" class="entrees-form">
        <input type="hidden" name="action" value="<?php echo $editEntry ? 'edit' : 'add'; ?>">
        <?php if ($editEntry): ?>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($editEntry['id']); ?>">
        <?php endif; ?>

        <label for="categorie">Catégorie</label>
        <div>
            <input
            type="text"
            id="categorie"
            name="categorie"
            required
            placeholder="Salaire, Aide, Autre..."
            value="<?php echo $editEntry ? htmlspecialchars($editEntry['categorie']) : ''; ?>"
            >
        </div>


        <label for="montant">Montant</label>
        <div>
            <input
            type="number"
            id="montant"
            name="montant"
            min="0.01"
            step="0.01"
            required
            value="<?php echo $editEntry ? htmlspecialchars($editEntry['montant']) : ''; ?>"
            >
            <span>€</span>
        </div>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <div>
            <button type="submit" class="button-primary">
            <?php echo $editEntry ? "Mettre à jour l'entrée" : "Ajout Entrée"; ?>
            </button>
        </div>
        </form>

        <br>

        <div class="container">
        <div class="tableau">
            <?php if (!empty($_SESSION['entree'])): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Montant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['entree'] as $entree): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($entree['categorie']); ?></td>
                                <td><?php echo number_format($entree['montant'], 2, ',', ' '); ?> €</td>
                                <td>
                                <div class="btn-tableau-container">
                                    <a
                                    href="entree.php?edit_id=<?php echo htmlspecialchars($entree['id']); ?>"
                                    class="btn-tableau"
                                    >
                                    Modifier
                                    </a>

                                    <a
                                    href="entree.php?action=delete&id=<?php echo htmlspecialchars($entree['id']); ?>"
                                    class="btn-tableau btn-delete"
                                    >
                                    Supprimer
                                    </a>
                                </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune entrée pour l'instant.</p>
            <?php endif; ?>
        </div>
        </div>

        <br>

        <p class="sous-titre">
        Total des entrées du mois :
        <?php echo number_format($totalEntrees, 2, ',', ' '); ?> €
        </p>
    </div>

    <footer class="footer-fixed">
        <a href="recap.php" class="button-retour">Récap</a>
    </footer>

    <section class="section-fixed">
        <a href="sortie.php" class="button-suivant">Tb Sorties</a>
    </section>
</body>
</html>