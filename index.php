<?php
include 'func.php';

// Connect to MySQL database
$pdo = connection();

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page

$stmt = $pdo->query('SELECT * FROM clients');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<?= template_header('Read') ?>

    <main class="box-1 pb-20">
        <h2 class="p-20">Liste des clients</h2>
        <hr>
        <table class="p-20">
            <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Création</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['prenom'] ?></td>
                    <td><?= $user['nom'] ?></td>
                    <td><?= $user['telephone'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['horodatage'] ?></td>
                    <td>
                        <a href="update.php?id=<?= $user['id'] ?>"><img class="icon" src="assets/images/edit.svg" alt="edit"></a>
                        <a href="delete.php?id=<?= $user['id'] ?>"><img class="icon" src="assets/images/delete.svg" alt="delete"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="create.php" class="link-1 new-client">Nouveau client</a>
    </main>

<?= template_footer() ?>