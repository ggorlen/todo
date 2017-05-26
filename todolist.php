<?php
/**
 * A simple todo list
 */
final class TodoList {
  private static $db;
  private static $instance;


  /**
   * Sets and returns a single instance of a TodoList
   *
   * @return a TodoList object
   */
  public static function getInstance() {
    if (!isset(self::$instance)) {
      include_once('/students/ggorlen/secure/dbvars.php');
      self::$db = new mysqli('localhost', $dbuser, $dbpass, 'test_todolist');
      unset($dbhost, $dbuser, $dbpass, $database);
      if (self::$db) {
        self::$instance = new TodoList();
      }
      return self::$instance;
    }
  } // end getInstance

  /**
   * Adds a new task to the database
   *
   * @param $desc a description of the task
   * @param $due the due datetime for the task
   * @return true if successful, false otherwise
   */
  public function addTask($desc, $due) {
    $desc = self::$db->real_escape_string($desc);
    if ($due) {
      $due = self::$db->real_escape_string($due);
    }
    else {
      $due = NULL;
    }

    // Write and run the query
    $query = "INSERT INTO tasks (
                description,
                due
              ) VALUES (?, ?);";
    $statement = self::$db->prepare($query);
    $statement->bind_param('ss', $desc, $due);

    if ($statement->execute()) {
      $statement->close();
      return true;
    }
    else {
      // todo: write to error log
      return false;
    }
  } // end addTask

  /**
   * Permanently removes a task from the database
   *
   * @param $id the id of the task to remove
   * @return true if successful, false otherwise
   */
  public function deleteTask($id) {
    $id = self::$db->real_escape_string($id);

    // Write and run the query
    $query = "DELETE FROM tasks 
              WHERE id = ?;";
    $statement = self::$db->prepare($query);
    $statement->bind_param('i', $id);

    if ($statement->execute()) {
      $statement->close();
      return true;
    }
    else {
      // todo: write to error log
      return false;
    }
  } // end deleteTask

  /**
   * Returns a list of tasks
   *
   * @return the list as a mysqli object
   */
  public function getTasks() {
    $query = "SELECT *
              FROM tasks
              ORDER BY 
              due DESC,
              created DESC;";
    $result = self::$db->query($query);
    // todo: error logging
    return $result;
  } // end showTasks


  // Disallowed--use getInstance to construct
  private function __construct() { }
} // end TodoList
?>
