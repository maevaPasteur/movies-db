<?php
include 'func.php';
$pdo = connection();
$success = false;


if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $date = new DateTime();
    $date = $date->format('Y-m-d H:i:s');

    $stmt = $pdo->prepare('INSERT INTO clients VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $firstname, $lastname, $email, $phone, $date]);

    $success = true;
}
?>

<?=template_header('Create')?>

<main class="box-1">
    <h2 class="p-20">Nouveau client</h2>
    <hr>
    <form class="p-20" action="create.php" method="post">
        <div>
            <label for="id">ID</label>
            <input type="text" name="id" placeholder="26" value="auto" id="id">
        </div>
        <div>
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" placeholder="Marion" id="firstname">
        </div>
        <div>
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" placeholder="Jouchoux" id="lastname">
        </div>
       <div>
           <label for="email">Email</label>
           <input type="text" name="email" placeholder="johndoe@example.com" id="email">
       </div>
        <div>
            <label for="phone">Phone</label>
            <input type="text" name="phone" placeholder="06.21.48.65.13" id="phone">
        </div>
        <button class="link-1" type="submit">Créer</button>
    </form>
    <?php if ($success): ?>
        <p class="msg">Le nouveau client a bien été créé !</p>
    <?php endif; ?>
</main>

<?=template_footer()?>
