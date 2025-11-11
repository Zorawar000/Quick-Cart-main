<?php

    include('db.php');
    include('new_project_class.php');

if(isset($_POST['submit']))
{
    $new_project= new new_project_work;
    $register = $new_project->new_project_register($connect);
}

?>