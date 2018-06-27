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

  // get query parameter ID
  $postId = (isset($_GET['id']) ? $_GET['id'] : die());

  printf(json_encode($post->readOne($postId)));