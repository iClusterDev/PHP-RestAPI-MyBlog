<?php
  class Database {
    // DB params
    private $host = 'localhost';
    private $user = 'root';
    private $password = '123456';
    private $dbname = 'myblog';
    private $connection;

    // DB Connect
    public function connect() {
      $this->connection = null;

      try {
        $dsn = 'mysql:host='. $this->host.';dbname='.$this->dbname;
        $this->connection = new PDO($dsn, $this->user, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      } catch(PDOException $e) {
        echo 'DB Connection Error'.$e->getMessage();
      }

      return $this->connection;
    }
  }