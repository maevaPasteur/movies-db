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

} else {
    die ('Vous devez renseigner un ID.');
}
?>

<?=template_header('Read')?>

    <main class="box-1 p-20">
        <h2>Détail</h2>
        <table class="p-20">
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
        <div class="p-20 f-1">
            <a href="update.php?id=<?= $id ?>&table=<?= $table ?>" class="link-1" >Modifier</a>
            <a href="delete.php?id=<?= $id ?>&table=<?= $table ?>">supprimer</a>
        </div>
    </main>

<?=template_footer()?>