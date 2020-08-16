<?php

require_once './business.php';

function home(&$model) {

    $recordsOnPage = 8;
  
    $site = 1;
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $site = $_GET['page'];
    }
    $startFrom = (($site - 1) * $recordsOnPage);

    if (isset($_GET['order']) && isset($_GET['by'])) {
        $order = $_GET['order'];
        $by = $_GET['by'];

        $result = db_request("SELECT * FROM books ORDER BY `$by` $order LIMIT $startFrom, $recordsOnPage");
    }
    else {
        $result = db_request("SELECT * FROM books LIMIT $startFrom, $recordsOnPage");
    }
    

    $model['books'] = [];
    while($row = mysqli_fetch_array($result))
    {
        $model['books'][] = $row;
    }

    $allRows = mysqli_num_rows(db_request("SELECT * FROM books"));
    $model['pages'] = ceil($allRows / $recordsOnPage);
    $model['page'] = $site;

    if (isset($_GET['order']) && isset($_GET['by'])) {
        $model['orderby'] = "&&order=$order&&by=$by";
    }
    else {
        $model['orderby'] = "";
    }

    unset($_SESSION['response']);

    return 'index';
}

function add(&$model) {
    return 'add';
}

function addItem(&$model) {

    $request = 'INSERT INTO `test`.`books` (`id`, `title`, `author`, `genre`, `year`, `condition`) VALUES (NULL, "' . $_POST['title'] . '", "' . $_POST['author'] . '", "' . $_POST['genre'] . '", ' . $_POST['year'] . ', ' . $_POST['condition'] . ');';

    db_request($request);

    return 'redirect: ' . $_SERVER['HTTP_REFERER'];
}

function formTriggerHandler(&$model) {

    if (isset($_POST['delete_btn']) && !empty($_POST['id'])) {
        $idStr = implode(',', $_POST['id']);

        $request = "DELETE FROM `test`.`books` WHERE ID in ($idStr)";
        db_request($request);
    }

    unset($_SESSION['response']);

    return 'redirect: ' . $_SERVER['HTTP_REFERER'];
}

function search(&$model) {
    $result = db_request("SELECT * FROM books");
    $model['books'] = [];
    while($row = mysqli_fetch_array($result))
    {
        $model['books'][] = $row;
    }

    $model['jsonArray'] = json_encode($model['books'], JSON_UNESCAPED_UNICODE);

    return 'search';
}

function exportToCSV(&$model) {

    date_default_timezone_set('Europe/Warsaw');

    //get records from database
    $query = db_request("SELECT * FROM books ORDER BY id ASC");

    if($query->num_rows > 0) {

        $delimiter = ",";
        $filename = "TheBouquiniste_" . date('Y-m-d') . ".csv";
        
        //create a file pointer
        $f = fopen('php://memory', 'w');
        
        //set column headers
        $fields = array('ID', 'Title', 'Author', 'Genre', 'Year', 'Condition');
        fputcsv($f, $fields, $delimiter);
        
        //output each row of the data, format line as csv and write to file pointer
        while($row = $query->fetch_assoc()){
            $lineData = array($row['id'], $row['title'], $row['author'], $row['genre'], $row['year'], $row['condition']);
            fputcsv($f, $lineData, $delimiter);
        }
        
        //move back to beginning of file
        fseek($f, 0);
        
        //set headers to download file rather than displayed
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        
        //output all remaining data on a file pointer
        fpassthru($f);
    }
}