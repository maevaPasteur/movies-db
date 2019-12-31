<?php
include 'func.php';

$pdo = connection();
$success = false;

if (isset($_GET['id'])) {
    if (!empty($_POST)) {

        $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : '';

        $stmt = $pdo->prepare('UPDATE clients SET id = ?, prenom = ?, nom = ?, email = ?, telephone = ?, horodatage = ? WHERE id = ?');
        $stmt->execute([$id, $firstname, $lastname, $email, $phone, $date, $_GET['id']]);
        $success = true;
    }

    $stmt = $pdo->prepare('SELECT * FROM clients WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$client) {
        die ('Aucun client ne correspond à cet ID.');
    }
} else {
    die ('Un ID est nécéssaire.');
}
?>

<?= template_header('Read') ?>

<main class="box-1">
    <h2 class="p-20">Informations de <?=$client['prenom'].' '.$client['nom']?></h2>
    <hr>
    <form class="p-20" action="update.php?id=<?= $client['id'] ?>" method="post">
        <div>
            <label for="id">ID</label>
            <input type="text" name="id" value="<?= $client['id'] ?>" id="id">
        </div>
       <div>
           <label for="firstname">Prénom</label>
           <input type="text" name="firstname" value="<?= $client['prenom'] ?>" id="firstname">
       </div>
        <div>
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" value="<?= $client['nom'] ?>" id="lastname">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" value="<?= $client['email'] ?>" id="email">
        </div>
       <div>
           <label for="phone">Phone</label>
           <input type="text" name="phone" value="<?= $client['telephone'] ?>" id="phone">
       </div>
       <div>
           <label for="date">Created</label>
           <input type="text" name="date" value="<?= $client['horodatage'] ?>" id="date">
       </div>
       <button class="link-1" type="submit">Mettre à jour</button>
    </form>
    <?php if ($success): ?>
        <p class="msg">Le profil de ce client a bien été mis à jour.</p>
    <?php endif; ?>
</main>

<?= template_footer() ?>
