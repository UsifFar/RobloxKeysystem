<?php
//CAN ONLY READ THE DATABASE CANT WRITE OR CHANGE ANYTHING // USED TO CHECK IF THE TOKEN EXISTS IN THE DATABASE
$database = include('database.php');
if (isset($_POST['Request'])) {
    if ($_POST['Request'] == 'Checkfortoken') {
        if (in_array($_POST['token'], $database)){
        echo "Exists";
        }else{
        echo "Null";
        }
    }else{
        echo 'Bypassing detected. It\'s okay. I dont use mysql anyways Lmao :)';
    }
}else{
    echo 'Accessing the page is forbidden';
}
//CAN ONLY READ THE DATABASE CANT WRITE OR CHANGE ANYTHING // USED TO CHECK IF THE TOKEN EXISTS IN THE DATABASE
?>