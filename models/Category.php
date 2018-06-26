<?php
  class Category {

    // Category DB properties
    private $connection;
    private $table = 'categories';

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
          'name' => $name
        ));
      }  
      return $dataArray;
    }


    // get all categories
    public function read() {
      // sql query
      $query = 'SELECT * FROM '.$this->table.' ORDER BY created_at DESC';

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
    public function readOne($categoryId) {
      // sql query
      $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';

      // prepare query, 
      // execute & fetch
      try {
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $categoryId);
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
      $dataObj->id = htmlspecialchars(strip_tags($dataObj->id));
      $dataObj->name = htmlspecialchars(strip_tags($dataObj->name));

      // query
      $query = 'INSERT INTO ' . $this->table . ' SET id = :id, name = :name';

      // prepare query, 
      // execute & fetch
      try {
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $dataObj->id);
        $stmt->bindParam(':name', $dataObj->name);
        $stmt->execute();
        return array('data' => array(
          'id' => $dataObj->id,
          'name' => $dataObj->name
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
      $dataObj->name = htmlspecialchars(strip_tags($dataObj->name));

      // prepare statement
      $query = 'UPDATE ' . $this->table . ' SET name = :name WHERE id = :id';

      // prepare query, 
      // execute & fetch
      try {
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $dataObj->id);
        $stmt->bindParam(':name', $dataObj->name);
        $stmt->execute();
        return array('data' => array(
          'id' => $dataObj->id,
          'name' => $dataObj->name
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