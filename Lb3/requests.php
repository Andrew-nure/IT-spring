<?php
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
$host = "sqlite:library.db";

$dbh = new PDO($host);

if (isset($_REQUEST["book_name"]))
{
    $book = $_REQUEST['book_name'];
    $select_books = "SELECT name, year, publisher, quantity, ISBN 
                    FROM literature
                    WHERE literate='Книга' AND name=?";
    $request = $dbh->prepare($select_books);
    $request->execute(array($book));
    $request = $request->fetchAll();
        
    foreach($request as $book)
    {
        $name = $book['name'];
        $year = $book['year'];
        $publisher = $book['publisher'];
        $isbn = $book['ISBN'];
        $quantity = $book['quantity'];
        print "<tr><td>$name</td>
                <td>$year</td>
                <td>$publisher</td>
                <td>$isbn</td>
                <td>$quantity</td></tr>";
    }
}
else if (isset($_REQUEST["yearMin"]) or isset($_REQUEST['yearMax']))
{
    $yearMin = $_REQUEST['yearMin'];
    $yearMax = $_REQUEST['yearMax'];
    $select_type = "SELECT name, strftime('%Y', year) as year_release
                    FROM literature
                    WHERE year_release BETWEEN ? AND ?";
    $request = $dbh->prepare($select_type);
    $request->execute(array($yearMin, $yearMax));
    $request = $request->fetchAll();

    echo "<?xml version='1.0' encoding='utf8' ?>";
    echo "<root>";
    foreach ($request as $type)
    {
        $name = $type['name'];
        $year = $type['year_release'];
        print "<row><Name>$name</Name><Year>$year</Year></row>";

    }
    echo "</root>";
}
else if (isset($_REQUEST['author_name']))
{
    $author = $_REQUEST['author_name'];
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
    $timetable = $request->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($timetable);
}
// ?>