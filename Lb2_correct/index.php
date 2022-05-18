<?php
require_once __DIR__ . "/vendor/autoload.php";
$collection = (new MongoDB\Client)->lb2->forlab;

// ####################################################

$authors = $collection->find(['Тип' => 'Книга'], ['projection' => ['_id' => false, 'Автор' => true]]);
$unique_authors = array();
foreach ($authors as $entry)
{
    if (is_string($entry['Автор']))
    {
        array_push($unique_authors, $entry['Автор']);
    }
    else
    foreach ($entry['Автор'] as $author)
    {
        if ($author != null)
        {
            array_push($unique_authors, $author);
        }
    }
}
$unique_authors = array_unique($unique_authors);

echo "<form action='requests.php' method='post'>";
echo "<select name='author'>";
foreach ($unique_authors as $el)
{
    echo "<option>$el</option>";
}
echo "</select>  ";
echo "<button name='btnAuthor' value='get'>Выполнить</button>";
echo "</form>";

$script = "<script>
    if (localStorage.getItem('data_by_author'))
    {
        document.write('Предыдущий запрос: ' + localStorage.getItem('data_by_author'));   
    }
</script>";
echo $script;
echo "<br>";

// ####################################################

echo "<form action='requests.php' method='post'>";
echo "<span>Выберите временной период в годах: </span><br>";
echo "<span>C </span><input name='yearMin' type='text'>";
echo "<span>По </sp><input name='yearMax' type='text'>";
echo "<br>";
echo "<button name='btnYear' value='get'>Выполнить</button>";
echo "</form>";
echo "<br>";

$script = "<script>
    if (localStorage.getItem('data_by_year'))
    {
        document.write('Предыдущий запрос: ' + localStorage.getItem('data_by_year'));   
    }
</script>";
echo $script;
echo "<br>";
echo "<br>";

// ####################################################

$publisher = $collection->find(['Тип' => 'Книга'], ['projection' => ['_id' => false, 'Издатель' => true]]);
$unique_publisher = array();
foreach ($publisher as $entry)
{
    if ($entry['Издатель'] != null)
    {
        array_push($unique_publisher, $entry['Издатель']);
    }
}
$unique_publisher = array_unique($unique_publisher);

echo "<form action='requests.php' method='post'>";
echo "<select name='publisher'>";
foreach ($unique_publisher as $el)
{
    echo "<option>$el</option>";
}
echo "</select>  ";
echo "<button name='btnPublisher' value='get'>Выполнить</button>";
echo "</form>";

$script = "<script>
    if (localStorage.getItem('data_by_publisher'))
    {
        document.write('Предыдущий запрос: ' + localStorage.getItem('data_by_publisher'));   
    }
</script>";
echo $script;
echo "<br>";
?>