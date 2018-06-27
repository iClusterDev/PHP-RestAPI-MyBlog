<?php
  
  // set headers
  header('Application-Control-Allwo_Origin: *');
  header('Content-Type: aplication/json');

  // includes
  include_once('../../config/Database.php');
  include_once('../../models/Post.php');

  // DB instance & connection
  $database = new Database();
  $connection = $database->connect();

  // category instance
  $post = new Post($connection);

  printf(json_encode($post->read()));