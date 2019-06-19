<?php
  class Student {
    // DB Stuff
    private $conn;
    private $table = 'students';
    // Properties
    public $id;
    public $student_name;
    public $percentage;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Get students
    public function read() {
      // Create query
      $query = 'SELECT
        id,
        student_name,
        percentage
      FROM
        ' . $this->table . '
      ORDER BY
        percentage DESC';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get Single Student
  public function read_single(){
    // Create query
    $query = 'SELECT
          id,
          student_name
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';
      //Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->id);
      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // set properties
      $this->id = $row['id'];
      $this->student_name = $row['student_name'];
  }
  // Create Student
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      student_name = :student_name';
  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  // Clean data
  $this->student_name = htmlspecialchars(strip_tags($this->student_name));
  // Bind data
  $stmt-> bindParam(':student_name', $this->student_name);
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);
  return false;
  }
  // Update Student
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      student_name = :student_name
      WHERE
      id = :id';
  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  // Clean data
  $this->student_name = htmlspecialchars(strip_tags($this->student_name));
  $this->id = htmlspecialchars(strip_tags($this->id));
  // Bind data
  $stmt-> bindParam(':student_name', $this->student_name);
  $stmt-> bindParam(':id', $this->id);
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);
  return false;
  }
  // Delete Student
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    // Prepare Statement
    $stmt = $this->conn->prepare($query);
    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    // Bind Data
    $stmt-> bindParam(':id', $this->id);
    // Execute query
    if($stmt->execute()) {
      return true;
    }
    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);
    return false;
    }
  }