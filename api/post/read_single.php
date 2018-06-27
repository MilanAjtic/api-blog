<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate blog post object
    $post = new Post($db);

    // Get ID
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get post
    $row = $post->read_single();

    // Create array
    extract($row);
    $post_arr = array(
        'id' => $post->id,
//        'title' => $post->title,
//        'body' => $post->body,
//        'author' => $post->author,
//        'category_id' => $post->category_id,
//        'category_name' => $post->category_name
        'title' => $title,
        'body' => html_entity_decode($body),
        'author' => $author,
        'category_id' => $category_id,
        'category_name' => $category_name
    );

    // Make JSON
//    print_r($post_arr);
    print_r(json_encode($post_arr));