<?php


    //error_reporting(0);
    session_start();
    $host = "localhost";
    $user = "root";
    $password = "";
    $db_name = "new_project";

    $connect = mysqli_connect($host,$user,$password,$db_name);

    /*$query = mysqli_query($connect);

    if($connect)
    {
        echo 'Database Connected';
    }
    else
    {
        echo 'Database not Connected';
    }*/

?>