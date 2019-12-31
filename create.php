<?php
include 'func.php';
$pdo = connection();
$success = false;

$table = $_GET['table'];
$cols = getColumns($pdo, $table);

if (!empty($_POST) && isset($table)) {

    $values = array();
    $i=0;
    foreach ($cols as $col) {
        if($i===0) {
            $values[] = isset($_POST[$col]) && !empty($_POST[$col]) && $_POST[$col] != 'auto' ? $_POST[$col] : NULL;
        } else {
            $values[] = isset($_POST[$col]) ? $_POST[$col] : '';
        };
    }
    $sql = "INSERT INTO $table VALUES (";
    $i=0;
    foreach ($values as $val) {
        if($i!==0) {
            $sql.= ', ';
        }
        $i++;
        $sql.= '?';
    }
    $sql.=')';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);

    $success = true;
}
?>

<?=template_header('Create')?>

<main class="box-1">
    <h2 class="p-20">Nouvel élément dans la table <?= $table ?></h2>
    <hr>
    <form class="p-20" action="create.php?table=<?= $table ?>" method="post">
        <?php $i=0; foreach ($cols as $col): $i++ ?>
            <div>
                <label for="<?= $col ?>"><?= $col ?></label>
                <input
                        type="text"
                        name="<?= $col ?>"
                        <?php if($i===1): ?>
                            value="auto"
                        <?php endif; ?>
                        id="<?= $col ?>">
            </div>
        <?php endforeach; ?>
        <button class="link-1" type="submit">Créer</button>
    </form>
    <?php if ($success): ?>
        <p class="msg">Création réussie !</p>
    <?php endif; ?>
</main>

<?=template_footer()?>
