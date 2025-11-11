<?php


include("db.php");
include("new_project_class.php");


$new_project = new new_project_work;

if(isset($_POST['processuser']))
{
    $login = $new_project->new_project_login($connect);
}


?>