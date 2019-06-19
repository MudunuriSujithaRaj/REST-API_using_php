<?php
  class Category {
    // DB Stuff
    private $conn;
    private $table = 'shopping';
    // Properties
    
    public $product_name;
	public $category;
	public $price;
    public $colour;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT
        product_name,
	    category,
	    price,
        colour 
      FROM
        ' . $this->table . '
      ORDER BY
        created_at DESC';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Execute query
      $stmt->execute();
      return $stmt;
    }
    // Get Single Category
  public function read_single(){
    // Create query
    $query = 'SELECT
          product_name,
	    category,
	    price,
        colour
        FROM
          ' . $this->table . '
      ';
      //Prepare statement
      $stmt = $this->conn->prepare($query);
      // Bind ID
      $stmt->bindParam(1, $this->id);
      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // set properties
      
      $this->product_name = $row['product_name'];
	  $this->category = $row['category'];
	  $this->price = $row['price'];
	  $this->colour = $row['colour'];
  }
  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      product_name = :product_name';
  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  // Clean data
  $this->product_name = htmlspecialchars(strip_tags($this->product_name));
  // Bind data
  $stmt-> bindParam(':product_name', $this->product_name);
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);
  return false;
  }
  // Update Category
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      product_name = :product_name
      WHERE
      id = :id';
  // Prepare Statement
  $stmt = $this->conn->prepare($query);
  // Clean data
  $this->product_name = htmlspecialchars(strip_tags($this->product_name));
  $this->id = htmlspecialchars(strip_tags($this->id));
  // Bind data
  $stmt-> bindParam(':product_name', $this->product_name);
  $stmt-> bindParam(':id', $this->id);
  // Execute query
  if($stmt->execute()) {
    return true;
  }
  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);
  return false;
  }
  // Delete Category
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