<?php 

require_once(dirname(__FILE__, 2).'/src/config/database.php');
$result = Database::getResultFromQuery("SELECT * FROM users");

while($row = $result->fetch_assoc()){
    print_r($row);
    echo '<br> <hr>';
}

