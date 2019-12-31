<?php
include 'func.php';

$pdo = connection();
$success = false;

$id = $_GET['id'];
$table = $_GET['table'];

if (isset($id) && isset($table)) {

    $item = getItem($pdo, $table);
    $cols = getColumns($pdo, $table);
    $inputs = array();

    if (!empty($_POST)) {
        $sql = "UPDATE $table SET ";
        $length = count($cols);
        $i=0;
        foreach ($cols as $col) {
            $i++;
            if($i===1) {
                $inputs[] = isset($_POST[$col]) && !empty($_POST[$col]) && $_POST[$col] != 'auto' ? $_POST[$col] : NULL;
            } else {
                $inputs[] = isset($_POST[$col]) ? $_POST[$col] : '';
            }
            $sql.= "$col = ?";
            if($i !== $length) {
                $sql.=", ";
            }
        }
        $sql.=" WHERE $cols[0] = ?";
        $inputs[] = $id;
        $stmt = $pdo->prepare($sql);
        $stmt->execute($inputs);
        $success = true;
        $item = getItem($pdo, $table);
    }

    if (!$item) {
        die ('Rien ne correspond à cet ID.');
    }
} else {
    die ('Un ID est nécéssaire.');
}

function getColumns($pdo, $table) {
    $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = :table";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':table', $table, PDO::PARAM_STR);
    $stmt->execute();
    $output = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $output[] = $row['COLUMN_NAME'];
    }
    return $output;
}

function getItem($pdo, $table) {
    $idName = $table.'ID';
    $stmt = $pdo->prepare("SELECT * FROM $table WHERE $idName = ?");
    $stmt->execute([$_GET['id']]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    return $item;
}

?>

<?= template_header('Read') ?>

<main class="box-1">
    <h2 class="p-20">Table <?= $table ?></h2>
    <form class="p-20" action="update.php?id=<?= $id ?>&table=<?= $table ?>" method="post">
        <?php foreach ($cols as $col): ?>
            <div>
                <label for="<?= $col ?>"><?= $col ?></label>
                <input type="text" name="<?= $col ?>" value="<?= $item["$col"] ?>" id="<?= $col ?>">
            </div>
        <?php endforeach; ?>
        <button class="link-1" type="submit">Mettre à jour</button>
    </form>
    <?php if ($success): ?>
        <p class="msg">Mise à jour réussie !</p>
    <?php endif; ?>
</main>

<?= template_footer() ?>
