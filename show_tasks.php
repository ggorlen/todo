<?php
require_once 'todolist.php';

$list = TodoList::getInstance();
$tasks = $list->getTasks();

if ($tasks->num_rows) {
  echo '<table id="tasks"><tr><th>Task</th><th>Due</th><th>Added</th><th>Delete</th></tr>';
  while ($task = $tasks->fetch_object()) {
    echo '<tr><td>' . stripslashes($task->description) . '</td>
          <td class="centered">' . ($task->due ? substr($task->due, 0, -3) : '-') . 
          '<td class="centered">' . substr($task->created, 0, -3)  . '</td>
          </td><td class="centered"><a id="' . $task->id .
          '" onclick="deleteTask(this)" href="javascript:void(0)"><em>x</em></a></td></tr>';
  }
  echo '</table>';
}
?>
