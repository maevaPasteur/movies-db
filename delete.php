<?php
include 'func.php';
$pdo = connection();
$success = false;

$id = $_GET['id'];
$table = $_GET['table'];
$idName = $table.'ID';

if (isset($id) && isset($table)) {

    $item = getItem($pdo, $table);
    $cols = getColumns($pdo, $table);

    if (!$item) {
        die ('Rien ne correspond à cet iD.');
    }

    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare("DELETE FROM $table WHERE $idName = ?");
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

    <main class="box-1">
        <div class="p-20">
            <h2>Supprimer <?= '#'.$id ?> de la table <?= $table ?></h2>
            <table>
                <thead>
                <tr>
                    <?php foreach ($cols as $col): ?>
                        <th><?= $col ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($cols as $col): ?>
                        <td><?= $item[$col] ?></td>
                    <?php endforeach; ?>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="p-20">
            <?php if ($success): ?>
                <p class="msg">Suppression réussie !</p>
            <?php else: ?>
                <p>Êtes vous certain de vouloir le supprimer ?<br>Cette action est définitive.</p>
                <div>
                    <a class="link-2" href="delete.php?id=<?= $id.'&table='.$table ?>&confirm=yes">Yes</a>
                    <a class="link-3" href="delete.php?id=<?= $id.'&table='.$table ?>&confirm=no">No</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

<?=template_footer()?>