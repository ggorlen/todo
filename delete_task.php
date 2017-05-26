<?php
require_once 'todolist.php';

$list = TodoList::getInstance();
if (isset($_POST) && count($_POST)) {
  if ($id = intval($_POST['id'])) {
    echo $list->deleteTask($id);
  }
}
?>
