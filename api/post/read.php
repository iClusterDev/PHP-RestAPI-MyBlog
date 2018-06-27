<?php
  // // headers
  // header('Access-Control-Allow-Origin: *');
  // header('Content-Type: application/json');

  // include_once '../../config/Database.php';
  // include_once '../../models/Post.php';

  // // instantiate DB & connect
  // $database = new Database();
  // $db = $database->connect();

  // // instantiate blog post obj
  // $post = new Post($db);

  // // blog post query
  // $result = $post->read();

  // // get row count
  // $num = $result->rowCount();

  // // check if any post
  // if ($num > 0) {
  //   // post array contains only a 'data' key
  //   // which is an array where we'll push all
  //   // the post items
  //   $posts_arr = array('data' => array());

  //   // iterate through the result to fetch the post items
  //   while($row = $result->fetch(PDO::FETCH_ASSOC)) {
  //     extract($row);

  //     $post_item = array(
  //       'id' => $id,
  //       'title' => $title,
  //       'body' => html_entity_decode($body),
  //       'author' => $author,
  //       'category_id' => $category_id,
  //       'category_name' => $category_name
  //     );

  //     // push to data
  //     array_push($posts_arr['data'], $post_item);
  //   }

  //   // turn to json
  //   echo json_encode($posts_arr);

  // } else {
  //   echo json_encode(
  //     array('message' => 'No posts found')
  //   );
  // }


  
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