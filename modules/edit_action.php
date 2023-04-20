<?php

include("../init.php");

if (isset($_GET['payload'])) {
    $vars['action'] = 'do_edit';
    $vars['item_id'] = $_GET['payload'];
    $vars['item_title'] = $_GET['title'];
}

if (!isset($vars['action'])){
    $vars['action']='list';
}

include("todo.php");
?>