<?php
$host = "sqlite:library.db";

$dbh = new PDO($host);
$select_names = "SELECT name FROM literature";
$select_authors = "SELECT name FROM authors";
?>

<?php
function select_entities($dbh, $request)
{
    $lines = array();
    foreach($dbh->query($request) as $line)
    {
        $lines[] = $line[0];
    }
    $lines = array_unique($lines);
    return $lines;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
</head>
<body>
    <form action="requests.php" method="get">
        <span>Выберите название: </span> 
        <select name="book_name">
            <?php
            $names = select_entities($dbh, $select_names);
            foreach($names as $name)
            {?>
                <option value="<?=$name?>"><?=$name?></option>
            <?php
            }
            ?>
        </select>
        <br><br>
            
        <span>Выберите временной период в годах: </span><br>
        <span>C </span><input name="yearMin" type="text">
        <span>По </sp><input name="yearMax" type="text">
        <br><br>

        <span>Выберите имя автора: </span>
        <select name="author_name">
            <?php
            $authors = select_entities($dbh, $select_authors);
            foreach($authors as $author)
            {?>
                <option value="<?=$author?>"><?=$author?></option>
            <?php
            }
            ?>
        </select>
        <br><br>

        <button id="executeBtn" value="get">Отправить</button>
    </form>
</body>
</html>