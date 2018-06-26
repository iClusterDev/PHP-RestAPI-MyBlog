<?php
  
  // set headers
  header('Application-Control-Allwo_Origin: *');
  header('Content-Type: aplication/json');

  // includes
  include_once('../../config/Database.php');
  include_once('../../models/Category.php');

  // DB instance & connection
  $database = new Database();
  $connection = $database->connect();

  // category instance
  $category = new Category($connection);

  printf(json_encode($category->read()));
