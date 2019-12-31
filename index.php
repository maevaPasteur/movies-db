<?php
include 'func.php';

$pdo = connection();

$movies =  $pdo->query('SELECT * FROM movie')->fetchAll(PDO::FETCH_ASSOC);

?>


<?= template_header('Read') ?>

    <main>

        <?= template_table('Liste des films', $movies, 'movieID', 'Titre', 'movieTitle', 'Description', 'movieDesc') ?>

    </main>

<?= template_footer() ?>