<?php

  // headers (for post request) 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // instantiate blog post obj
  $post = new Post($db);

  // get POSTED data
  $data = json_decode(file_get_contents('php://input'));

  // set the ID to delete
  $post->id = $data->id;

  if ($post->DELETE()) {
    echo json_encode(
      array('message' => 'Post Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Deleted')
    );
  }