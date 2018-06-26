<?php
  
  // set headers
  header('Application-Control-Allwo_Origin: *');
  header('Content-Type: aplication/json');
  header('Access-Control-Allow-Method: DELETE');
  header('Access-Control_Allow-Headers: Access-Control_Allow-Headers, Access-Control-Allow-Method, Content-Type, Authorization, X-Requested-With');

  // includes
  include_once('../../config/Database.php');
  include_once('../../models/Category.php');

  // DB instance & connection
  $database = new Database();
  $connection = $database->connect();

  // category instance
  $category = new Category($connection);

  // get request data
  $dataObj = json_decode(file_get_contents('php://input'));

  printf(json_encode($category->delete($dataObj)));