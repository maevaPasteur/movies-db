<?php
include 'func.php';

$pdo = connection();

$movies =  $pdo->query('SELECT * FROM movie')->fetchAll(PDO::FETCH_ASSOC);
$songs =  $pdo->query('SELECT * FROM song')->fetchAll(PDO::FETCH_ASSOC);
$studios =  $pdo->query('SELECT * FROM studio')->fetchAll(PDO::FETCH_ASSOC);
$artistes =  $pdo->query('SELECT * FROM artiste')->fetchAll(PDO::FETCH_ASSOC);
$roles =  $pdo->query('SELECT * FROM role')->fetchAll(PDO::FETCH_ASSOC);
$posters =  $pdo->query('SELECT * FROM poster')->fetchAll(PDO::FETCH_ASSOC);
$genres =  $pdo->query('SELECT * FROM genre')->fetchAll(PDO::FETCH_ASSOC);
$soundtrack =  $pdo->query('SELECT * FROM soundtrack')->fetchAll(PDO::FETCH_ASSOC);
$trailers =  $pdo->query('SELECT * FROM trailer')->fetchAll(PDO::FETCH_ASSOC);
$users =  $pdo->query('SELECT * FROM person')->fetchAll(PDO::FETCH_ASSOC);
$bands =  $pdo->query('SELECT * FROM band')->fetchAll(PDO::FETCH_ASSOC);


?>


<?= template_header('Read') ?>

    <main>

        <?= template_table('Les films', $movies, 'movie', 'Titre', 'movieTitle', 'Description', 'movieDesc') ?>
        <?= template_table('Les musiques', $songs, 'song', 'Titre', 'songName', 'Lien', 'songURL') ?>
        <?= template_table('Les studios', $studios, 'studio', 'Nom', 'studioName', 'Pays', 'studioAddress') ?>
        <?= template_table('Les artistes', $artistes, 'artiste', 'Nom', 'artisteName', 'Nationalité', 'artisteNationality') ?>
        <?= template_table('Les rôles', $roles, 'role', 'Titre', 'roleDesc', null, null) ?>
        <?= template_table('Les affiches', $posters, 'poster', 'Image', 'posterLink', null, null) ?>
        <?= template_table('Les genres', $genres, 'genre', 'Titre', 'genreType', 'Description', 'genreDesc') ?>
        <?= template_table('Les bandes sons', $soundtrack, 'soundtrack', 'Titre', 'soundtrackName', 'Taille', 'soundtrackSize') ?>
        <?= template_table('Les bandes annonces', $trailers, 'trailer', 'Url', 'trailerURL', null, null) ?>
        <?= template_table('Les personnes', $users, 'person', 'Prénom', 'personFirstName', 'Nom', 'personLastName') ?>
        <?= template_table('Les groupes', $bands, 'band', 'Nom', 'bandName', null, null) ?>

    </main>

<?= template_footer() ?>