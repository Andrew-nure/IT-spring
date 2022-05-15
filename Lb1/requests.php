<?php
$host = "sqlite:library.db";

$dbh = new PDO($host);

// By book name 
$book = $_GET['book_name'];
$select_books = "SELECT name, year, publisher, quantity, ISBN 
                FROM literature
                WHERE literate='Книга' AND name=?";
$request = $dbh->prepare($select_books);
$request->execute(array($book));
$request = $request->fetchAll();
    
echo "<table border='1'>";
echo "<tr><th>Название</th>
          <th>Год выхода</th>
          <th>Издание</th>
          <th>ISBN</th>
          <th>Кол-во страниц</th></tr>";
foreach($request as $book)
{
    $name = $book['name'];
    $year = $book['year'];
    $publisher = $book['publisher'];
    $isbn = $book['ISBN'];
    $quantity = $book['quantity'];
    echo "<tr><td>$name</td>
              <td>$year</td>
              <td>$publisher</td>
              <td>$isbn</td>
              <td>$quantity</td></tr>";
}

echo "</table><br>";

// By year
$yearMin = $_GET['yearMin'];
$yearMax = $_GET['yearMax'];
$select_type = "SELECT name, strftime('%Y', year) as year_release
                FROM literature
                WHERE year_release BETWEEN ? AND ?";
$request = $dbh->prepare($select_type);
$request->execute(array($yearMin, $yearMax));
$request = $request->fetchAll();

echo "<table border='1'>";
echo "<tr><th>Название</th>
          <th>Год выхода</th></tr>";
foreach($request as $type)
{  
    $name = $type['name'];
    $year = $type['year_release'];
    echo "<tr><td>$name</td>
              <td>$year</td></tr>";
}
echo "</table><br>";

// By author name
$author = $_GET['author_name'];
$select_author = "SELECT literature.ID_book AS id_book,
                    literature.name AS name_book,
                    authors.ID_authors AS id_authors,
                    authors.name AS name_author 
                  FROM
                    literature 
                    LEFT JOIN book_authors ON literature.ID_book = book_authors.FID_book
                    LEFT JOIN authors ON book_authors.FID_authors = authors.ID_authors
                  WHERE 
                    name_author = ?";
$request = $dbh->prepare($select_author);
$request->execute(array($author));
$request = $request->fetchAll();

echo "<span>Автор: $author</span>";
echo "<table border='1'>";
echo "<tr><th>Название</th></tr>";
foreach($request as $row)
    {
        $book = $row['name_book'];
        echo "<tr><td>$book</td></tr>";
    }
echo "</table><br>";
?>