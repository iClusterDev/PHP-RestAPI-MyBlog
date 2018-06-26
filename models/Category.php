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


    // get categories
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
    public function readOne() {

      // prepare statement

      // execute query

      // fecth properties
    }


    // create a category
    public function create() {

      // prepare statement

      // clean data
      
      // execute query

    }


    // update a category
    public function update() {

      // prepare statement

      // clean data
      
      // execute query

    }

    
    // delete category
    public function delete() {

      // prepare statement

      // clean data

      // execute query

    }

  }