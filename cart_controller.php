<?php
include("db.php");
include("new_project_class.php");

$new_project = new new_project_work;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add_to_cart':
            echo $new_project->add_to_cart($connect);
            break;

        case 'remove_item':
            echo $new_project->remove_cart_item($connect);
            break;

        case 'update_quantity':
            echo $new_project->update_cart_quantity($connect);
            break;

        default:
            echo "invalid_action";
    }
}
?>
