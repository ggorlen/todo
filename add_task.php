<?php
require_once 'todolist.php';

$list = TodoList::getInstance();

if (isset($_POST) && count($_POST)) {
  if ($description = $_POST['description']) {
    $due = $_POST['due'];

    if (strlen($due)) {
      if (preg_match('/^(\d{4})-([01]\d)-(\d{2}) ([0-2][0-6]):([0-5])\d$/', $due, $result)) {
        $year = $result[1];
        $month = $result[2];
        $day = $result[3];
        $hour = $result[4];
        $min = $result[5];
        $datetime = date("Y-m-d H:i", mktime($hour, $min, 0, $month, $day, $year));
        echo $list->addTask($description, $datetime);
      }
      else {
        return false;
      }
    }
    else {
      echo $list->addTask($description, $datetime);
    }
  }
}
?>
