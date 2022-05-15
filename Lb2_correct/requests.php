<?php
require_once __DIR__ . "/vendor/autoload.php";
$collection = (new MongoDB\Client)->lb2->forlab;

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['btnAuthor']))
    {
        $author = $_POST['author'];
        $request = array('Тип' => 'Книга', 'Автор' => $author);
        $prj = array('projection' => ['_id' => false]);
        $cursor = $collection->find($request, $prj);
        
        $data = array();
        foreach ($cursor as $entry)
        {
            $entry_arr = json_decode(json_encode($entry), true);
            array_push($data, array_values($entry_arr));
        }
        
        $res = "<table border=\'1\'>";
        $res .= "<tr><th>Тип</th><th>Название</th><th>Год</th><th>Номер</th><th>Издатель</th><th>Кол. страниц</th><th>ISBN</th></tr>";
        foreach ($data as $class)
        {
            $res .= "<tr><td>$class[0]</td><td>$class[1]</td><td>$class[2]</td><td>$class[3]</td><td>$class[4]</td><td>$class[5]</td><td>$class[6]</td></tr>";
        }
        $res .= "</table>";
        echo $res;
        
        $script_save = "<script>localStorage.setItem('data_by_author', '$res');</script>"; 
        echo $script_save;
        echo "<br>";
    }
    else if (isset($_POST['btnYear']))
    {
        $yearMin = $_POST['yearMin'];
        $yearMax = $_POST['yearMax'];
        $request = array();
        $prj = array('projection' => ['_id' => false, 'Год' => false]);
        $cursor = $collection->find($request, $prj);
        
        $data = array();
        foreach ($cursor as $entry)
        {
            $entry_arr = json_decode(json_encode($entry), true);
            array_push($data, array_values($entry_arr));
        }
        
        $res = "<table border=\'1\'>";
        $res .= "<tr><th>Тип</th><th>Название</th><th>Год</th><th>Номер</th><th>Издатель</th><th>Кол. страниц</th><th>ISBN</th><th>Автор</th></tr>";
        foreach ($data as $class)
        {
            if ($class[2] > $yearMax || $class[2] < $yearMin)
            {
                continue;
            }
            $author_names = "";
            if (is_string($class[7]))
            {
                $author_names = $class[7];
            }
            else
            foreach ($class[7] as $author)
            {
                $author_names .= $author . ', ';
            }
            $res .= "<tr><td>$class[0]</td><td>$class[1]</td><td>$class[2]</td><td>$class[3]</td><td>$class[4]</td><td>$class[5]</td><td>$class[6]</td><td>$author_names</td></tr>";
        }
        $res .= "</table>";
        echo $res;
        
        $script_save = "<script>localStorage.setItem('data_by_year', '$res');</script>"; 
        echo $script_save;
        echo "<br>";
        
    }
    else if (isset($_POST['btnPublisher']))
    {
        $publisher = $_POST['publisher'];
        $request = array('Издатель' => $publisher);
        $prj = array('projection' => ['_id' => false, 'Издатель' => false]);
        $cursor = $collection->find($request, $prj);
        
        $data = array();
        foreach ($cursor as $entry)
        {
            $entry_arr = json_decode(json_encode($entry), true);
            array_push($data, array_values($entry_arr));
        }
        
        $res = "<table border=\'1\'>";
        $res .= "<tr><th>Тип</th><th>Название</th><th>Год</th><th>Номер</th><th>Кол. страниц</th><th>ISBN</th><th>Автор</th></tr>";
        foreach ($data as $room)
        {
            $publisher_names = "";
            if (is_string($room[6]))
            {
                $publisher_names = $room[6];
            }
            else
            foreach ($room[6] as $pbl)
            {
                $publisher_names .= $pbl . ', ';
            }
            $res .= "<tr><td>$room[0]</td><td>$room[1]</td><td>$room[2]</td><td>$room[3]</td><td>$room[4]</td><td>$room[5]</td><td>$publisher_names</td></tr>";
        }
        $res .= "</table>";
        echo $res;
        
        $script_save = "<script>localStorage.setItem('data_by_publisher', '$res');</script>"; 
        echo $script_save;
        
    }
}
?>