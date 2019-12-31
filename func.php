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

function template_table($title, $items, $type, $param1Title, $param1Content, $param2Title, $param2Content) {
    $html = "
<div class='box-1 pb-20' id=\"$type\">
            <h2 class='p-20'>$title</h2>
            <hr>
            <table class='p-20'>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>$param1Title</th>
                    ";
    if($param2Title) {
        $html.="<th>$param2Title</th>";
    }
    $html.= "
                    <th></th>
                </tr>
                </thead>
                <tbody>";
                foreach ($items as $item) {
                    $id = $type.'ID';
                    $html.= "
                        <tr>
                            <td>$item[$id]</td>
                            ";
                    if($type === 'poster') {
                        $html.= "<td><img src=\"$item[$param1Content]\" alt='poster'></td>";
                    } else {
                        $html.= "<td>$item[$param1Content]</td>";
                    }
                    if($param2Content) {
                        if($type === 'song') {
                            $html.= "<td><a href=\"$item[$param2Content]\">$item[$param2Content]</a></td>";
                        } else {
                            $html.="<td>$item[$param2Content]</td>";
                        }
                    }
                    $html.= "
                            <td>
                                <a href=\"update.php?id=$item[$id]\"><img class='icon' src='assets/images/edit.svg' alt='edit'></a>
                                <a href=\"delete.php?id=$item[$id]\"><img class='icon' src='assets/images/delete.svg' alt='delete'></a>
                            </td>
                        </tr>
                    ";
                }
                $html.= "
                </tbody>
            </table>
            <a href='create.php' class='link-1 new-client'>Nouveau</a>
        </div>
    ";
    echo $html;
}
?>

