<?php
function connection() {
    $db = 'movie_db';
    $charset = 'utf8mb4';
    $host = "localhost";
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $user = 'root';
    $pass = '';
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
function template_header($title) {
    echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="assets/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
    <header class="box-1">
    	<h1>Excercice </h1>
        <a class="link-1 icon-home" href="index.php">Accueil</a>
    </header>
EOT;
}

function template_footer() {
    echo <<<EOT
    </body>
</html>
EOT;
}

function template_table($title, $items, $id, $param1Title, $param1Content, $param2Title, $param2Content) {
    $html = <<<EOT
<div class="box-1 pb-20">
            <h2 class="p-20">$title</h2>
            <hr>
            <table class="p-20">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>$param1Title</th>
                    <th>$param2Title</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
EOT;
    foreach ($items as $item) {
        $html .= <<<EOT
        <tr>
                        <td>$item[$id]</td>
                        <td>$item[$param1Content]</td>
                        <td>$item[$param2Content]</td>
                        <td>
                            <a href="update.php?id=$item[$id]"><img class="icon" src="assets/images/edit.svg" alt="edit"></a>
                            <a href="delete.php?id=$item[$id]"><img class="icon" src="assets/images/delete.svg" alt="delete"></a>
                        </td>
                    </tr>
EOT;
    }
    $html .= <<<EOT
                </tbody>
            </table>
            <a href="create.php" class="link-1 new-client">Nouveau</a>
        </div>
EOT;
    echo $html;
}
?>

