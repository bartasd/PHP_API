<?php 
error_reporting(E_ALL);ini_set('display_errors', '1');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('../core/initialize.php');

$post = new Post($db);

$result = $post->read();

$num = $result->rowCount();

if($num > 0){
    $post_arr = [];
    $post_arr['data'] = [];

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category' => $category,
            'category_name' => $category_name
        );
        array_push($post_arr['data'], $post_item);
    }
    echo json_encode($post_arr, JSON_PRETTY_PRINT);
}
else{
    echo json_encode(array('message' => 'No posts found.'));
}