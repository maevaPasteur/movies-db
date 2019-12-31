<?php
include 'func.php';
$pdo = connection();
$success = false;

if (isset($_GET['id'])) {

    $stmt = $pdo->prepare('SELECT * FROM clients WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$client) {
        die ('Aucun client ne correspond à cet iD.');
    }

    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM clients WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $success = true;
        } else {
            header('Location: index.php');
            exit;
        }
    }
} else {
    die ('Vous devez renseigner un ID.');
}
?>

<?=template_header('Delete')?>

    <main class="box-1 p-20">
        <h2>Supprimer le client #<?=$client['id']?></h2>
        <?php if ($success): ?>
            <p class="msg">Le client a bien été supprimé</p>
        <?php else: ?>
            <p>Êtes vous certain de vouloir supprimer <?= $client['prenom'].' '.$client['nom']?> de vos clients ?</p>
            <div>
                <a class="link-2" href="delete.php?id=<?=$client['id']?>&confirm=yes">Yes</a>
                <a class="link-3" href="delete.php?id=<?=$client['id']?>&confirm=no">No</a>
            </div>
        <?php endif; ?>
    </main>

<?=template_footer()?>