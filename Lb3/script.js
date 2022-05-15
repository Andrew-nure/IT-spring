function get_rq_book()
{
    ajax.onload = load_data_book;
    var book_name = document.getElementById("book_name").value;

    ajax.open("POST", "requests.php");
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("book_name=" + book_name); 
}

function get_rq_year()
{
    ajax.onload = load_data_year;
    var yearMin = document.getElementById("yearMin").value;
    var yearMax = document.getElementById("yearMax").value;
    ajax.open("POST", "requests.php");
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("yearMin=" + yearMin + "&" + "yearMax=" + yearMax);
}

function get_rq_author()
{
    ajax.onload = load_data_author;
    var author_name = document.getElementById("author_name").value;
    ajax.open("POST", "requests.php");
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax.send("author_name=" + author_name); 
}

function load_data_book()
{
    if (ajax.status === 200)
    {
        // Text
        if (document.getElementById('result_book') != null)
        {
            document.getElementById('result_book').innerHTML = ajax.response;
        }
    }
}

function load_data_year()
{
    if (ajax.status === 200)
    {
        // XML
        if (document.getElementById('yearMin') != null || document.getElementById('yearMax') != null) 
        {
            let rows = ajax.responseXML.firstChild.childNodes;
            let result = "";
            for (var i = 0; i < rows.length; i++)
            {
                result += "<tr>";
                result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                result += "<td>" + rows[i].children[1].textContent + "</td>";
                result += "</tr>";
            }
            document.getElementById('result_year').innerHTML = result;
            console.dir(result);
        }
    }
}

function load_data_author()
{
    if (ajax.status === 200)
    {
        // JSON
        if (document.getElementById('author_name') != null) 
        {
            let rows = JSON.parse(ajax.response);
            console.dir(rows);

            let result = "";
            for (var i = 0; i < rows.length; i++)
            {
                result += "<tr>";
                result += "<td>" + rows[i].name_book + "</td>";
                result += "<td>" + rows[i].name_author + "</td>";
                result += "</tr>";
            }
            document.getElementById('result_author').innerHTML = result;
        }
    }
}

var ajax = new XMLHttpRequest();