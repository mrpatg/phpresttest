<?php
    // Headers - All access, no auth/tokens
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instatntiate and connect to DB
    $database = new Database();
    $db = $database->connect();

    // Instantiate post object
    $post = new Post($db);

    // Post query
    $result = $post->read();

    // Get row count
    $count = $result->rowCount();

    // Check if posts
    if($count > 0) {
        // Post array
        $posts_arr = array();
        $posts_arr['data'] = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );

            // Add data
            array_push($posts_arr['data'], $post_item);

        }

        // Convert to json
        echo json_encode($posts_arr);

    } else {
        // No posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }
