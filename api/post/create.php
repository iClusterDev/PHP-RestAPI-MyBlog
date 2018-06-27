<?php
  // // headers (for post request) 
  // header('Access-Control-Allow-Origin: *');
  // header('Content-Type: application/json');
  // header('Access-Control-Allow-Methods: POST');
  // header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  // include_once '../../config/Database.php';
  // include_once '../../models/Post.php';

  // // instantiate DB & connect
  // $database = new Database();
  // $db = $database->connect();

  // // instantiate blog post obj
  // $post = new Post($db);

  // // get POSTED data
  // $data = json_decode(file_get_contents('php://input'));

  // $post->title = $data->title;
  // $post->body = $data->body;
  // $post->author = $data->author;
  // $post->category_id = $data->category_id;

  // if ($post->create()) {
  //   echo json_encode(
  //     array('message' => 'Post Created')
  //   );
  // } else {
  //   echo json_encode(
  //     array('message' => 'Post Not Created')
  //   );
  // }

    // set headers
    header('Application-Control-Allwo_Origin: *');
    header('Content-Type: aplication/json');
    header('Access-Control-Allow-Method: POST');
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
  
    printf(json_encode($post->create($dataObj)));