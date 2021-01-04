<?php
$database = include('database.php');
if (isset($_POST['Request'])) {
    if ($_POST['Request'] == 'Checkfortoken') {
        if (in_array($_POST['token'], $database)){
        echo "Exists";
        }else{
        echo "Null";
        }
    }else{
        echo 'Bypassing detected. It\'s okay. I dont use mysql anywasy Lmao :)';
    }
}else{
    echo 'Accessing the page is forbidden';
}
?>