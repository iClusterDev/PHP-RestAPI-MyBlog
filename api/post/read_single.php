<?php
  // headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // instantiate blog post obj
  $post = new Post($db);

  // get id from url
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // read single
  $post->read_single();

  // create array
  $post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'created_at' => $post->created_at,
    'category_name' => $post->category_name,
    'category_id' => $post->category_id
  );

  // make json
  // print_r(json_encode($post_arr));
  echo json_encode($post_arr);