<?php

  // set headers
  header('Application-Control-Allwo_Origin: *');
  header('Content-Type: aplication/json');
  header('Access-Control-Allow-Method: DELETE');
  header('Access-Control_Allow-Headers: Access-Control_Allow-Headers, Access-Control-Allow-Method, Content-Type, Authorization, X-Requested-With');

  // includes
  include_once('../../config/Database.php');
  include_once('../../models/Post.php');

  // DB instance & connection
  $database = new Database();
  $connection = $database->connect();

  // category instance
  $post = new Post($connection);

  // get request data
  $dataObj = json_decode(file_get_contents('php://input'));

  printf(json_encode($post->delete($dataObj)));