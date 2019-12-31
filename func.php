<?php
function connection() {
    $db = 'crud';
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
?>