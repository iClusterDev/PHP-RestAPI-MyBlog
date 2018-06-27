<?php
  class Post {

    // Category DB properties
    private $connection;
    private $table = 'posts';

    // Constructor with DB
    public function __construct($connection) {
      $this->connection = $connection;
    }

    // Private methods
    private function fetchData($queryResult) {
      $dataArray = array( 'data' => array() );
      while ($row = $queryResult->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        array_push($dataArray['data'], array(
          'id' => $id,
          'category_id' => $category_id,
          'category_name' => $category_name,
          'title' => $title,
          'body' => $body,
          'author' => $author
        ));
      }  
      return $dataArray;
    }


    // get all categories
    public function read() {
      // sql query
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

      // prepare query, 
      // execute & fetch
      try {
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $this->fetchData($stmt);
      }
      catch(PDOException $e) {
        return array(
          'error' => $e->getMessage()
        );
      };
    }


    // get single category
    public function readOne($postId) {
      // sql query
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
          p.id = :id 
        LIMIT 0,1';

      // prepare query, 
      // execute & fetch
      try {
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $postId);
        $stmt->execute();
        return $this->fetchData($stmt);
      }
      catch(PDOException $e) {
        return array(
          'error' => $e->getMessage()
        );
      };
    }


    // create a category
    public function create($dataObj) {
      // clean data
      $dataObj->title = htmlspecialchars(strip_tags($dataObj->title));
      $dataObj->body = htmlspecialchars(strip_tags($dataObj->body));
      $dataObj->author = htmlspecialchars(strip_tags($dataObj->author));
      $dataObj->category_id = htmlspecialchars(strip_tags($dataObj->category_id));

      // query
      $query = 'INSERT INTO ' . 
          $this->table . ' 
        SET 
          title = :title, 
          body = :body, 
          author = :author, 
          category_id = :category_id';

      // prepare query, 
      // execute & fetch
      try {
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':title', $dataObj->title);
        $stmt->bindParam(':body', $dataObj->body);
        $stmt->bindParam(':author', $dataObj->author);
        $stmt->bindParam(':category_id', $dataObj->category_id);
        $stmt->execute();
        return array('data' => array(
          'title' => $dataObj->title,
          'body' => $dataObj->body,
          'author' => $dataObj->author,
          'category_id' => $dataObj->category_id
        ));
      }
      catch(PDOException $e) {
        return array(
          'error' => $e->getMessage()
        );
      };
    }


    // update a category
    public function update($dataObj) {
      // clean data
      $dataObj->id = htmlspecialchars(strip_tags($dataObj->id));
      $dataObj->title = htmlspecialchars(strip_tags($dataObj->title));
      $dataObj->body = htmlspecialchars(strip_tags($dataObj->body));
      $dataObj->author = htmlspecialchars(strip_tags($dataObj->author));
      $dataObj->category_id = htmlspecialchars(strip_tags($dataObj->category_id));

      // prepare statement
      $query = 'UPDATE ' . 
          $this->table . ' 
        SET 
          title = :title, 
          body = :body, 
          author = :author, 
          category_id = :category_id 
        WHERE 
          id = :id';

      // prepare query, 
      // execute & fetch
      try {
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $dataObj->id);
        $stmt->bindParam(':title', $dataObj->title);
        $stmt->bindParam(':body', $dataObj->body);
        $stmt->bindParam(':author', $tdataObj->author);
        $stmt->bindParam(':category_id', $thdataObj->category_id);
        $stmt->execute();
        return array('data' => array(
          'id' => $dataObj->id,
          'title' => $dataObj->title,
          'body' => $dataObj->body,
          'author' => $dataObj->author,
          'category_id' => $dataObj->category_id
        ));
      }
      catch(PDOException $e) {
        return array(
          'error' => $e->getMessage()
        );
      };
    }

    
    // delete category
    public function delete($dataObj) {
      // clean data
      $dataObj->id = htmlspecialchars(strip_tags($dataObj->id));

      // prepare query, 
      // execute & fetch
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      // execute query
      try {
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $dataObj->id);
        $stmt->execute();
        return array('data' => array());
      }
      catch(PDOException $e) {
        return array(
          'error' => $e->getMessage()
        );
      };
    }
  }