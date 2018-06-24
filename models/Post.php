<?php
  class Post {
    // Post DB properties
    private $conn;
    private $table = 'posts';

    // Post fields
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // get posts
    public function read() {
      $query = 'SELECT 
          c.name as category_name,
          p.id, 
          p.category_id, 
          p.title, 
          p.body, 
          p.author, 
          p.created_at 
        FROM
          ' . $this->table . ' p 
        LEFT JOIN 
          categories c ON p.category_id = c.id 
        ORDER BY
          p.created_at DESC';

      // prepare statement
      $stmt = $this->conn->prepare($query);

      // execute query
      $stmt->execute();

      return $stmt;
    }

    // get single post
    public function read_single() {
      $query = 'SELECT 
          c.name as category_name,
          p.id, 
          p.category_id, 
          p.title, 
          p.body, 
          p.author, 
          p.created_at 
        FROM
          ' . $this->table . ' p 
        LEFT JOIN 
          categories c ON p.category_id = c.id 
        WHERE 
          p.id = ? 
        LIMIT 0,1';

      // prepare statement
      $stmt = $this->conn->prepare($query);

      // execute query
      $stmt->bindParam(1, $this->id);
      $stmt->execute();

      // fecth properties
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->title = $row['title'];
      $this->body = $row['body'];
      $this->author = $row['author'];
      $this->created_at = $row['created_at'];
      $this->category_name = $row['category_name'];
      $this->category_id = $row['category_id'];
    }
  }