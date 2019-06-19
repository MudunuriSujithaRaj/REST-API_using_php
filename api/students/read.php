<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Student.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $student = new Student($db);
  // Blog post query
  $result = $student->read();
  // Get row count
  $num = $result->rowCount();
  // Check if any posts
  if($num > 0) {
    // Post array
    $students_arr = array();
    // $students_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $student_item = array(
        'id' => $id,
        'student_name' => $student_name,
        'percentage' => $percentage,
        
      );
      // Push to "data"
      array_push($students_arr, $student_item);
      // array_push($students_arr['data'], $student_item);
    }
    // Turn to JSON & output
    echo json_encode($students_arr);
  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No students Found')
    );
  }