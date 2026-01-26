<?php

    include('db.php');
    include('new_project_class.php');

if(isset($_POST['submit']))
{
    $new_project= new new_project_work;
    $contact_us = $new_project->contact_us($connect);
}

?>