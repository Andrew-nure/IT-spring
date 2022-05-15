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
    <script type="text/javascript" src="script.js"></script>
    <title>Library</title>
</head>
<body>
        <span>Выберите название: </span> 
        <select id="book_name">
            <?php
            $names = select_entities($dbh, $select_names);
            foreach($names as $name)
            {?>
                <option value="<?=$name?>"><?=$name?></option>
            <?php
            }
            ?>
        </select>
        <br>
        <button id="executeBtn_book" value="get" onclick="get_rq_book()">Отправить</button>
        <br><br>
            
        <span>Выберите временной период в годах: </span><br>
        <span>C </span><input id="yearMin" type="text">
        <span>По </sp><input id="yearMax" type="text">
        <br>
        <button id="executeBtn_year" value="get" onclick="get_rq_year()">Отправить</button>
        <br><br>

        <span>Выберите имя автора: </span>
        <select id="author_name">
            <?php
            $authors = select_entities($dbh, $select_authors);
            foreach($authors as $author)
            {?>
                <option value="<?=$author?>"><?=$author?></option>
            <?php
            }
            ?>
        </select>
        <br>
        <button id="executeBtn_author" value="get" onclick="get_rq_author()">Отправить</button>
        <br><br>

        <table border='1'>
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Год выхода</th>
                    <th>Издание</th>
                    <th>ISBN</th>
                    <th>Кол-во страниц</th>
                </tr>
            </thead>
            <tbody id="result_book"></tbody>
        </table>
        <br>

        <table border='1'>
            <thead>
                <tr>
                    <th>Год</th>
                    <th>Название</th>
                </tr>
            </thead>
            <tbody id="result_year"></tbody>
        </table>
        <br>

        <table border='1'>
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Издатель</th>
                </tr>
            </thead>
            <tbody id="result_author"></tbody>
        </table>
</body>
</html>