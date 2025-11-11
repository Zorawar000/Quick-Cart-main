<?php
include('db.php');
include('new_project_class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_project = new new_project_work;
    $new_project->change_password($connect);
}
