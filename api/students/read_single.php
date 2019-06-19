<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Student.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $student = new Student($db);

  // Get ID
  $student->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post
  $student->read_single();

  // Create array
  $students_arr = array(
    'id' => $student->id,
    'student_name' => $student->student_name
  );

  // Make JSON
  print_r(json_encode($students_arr));
?>