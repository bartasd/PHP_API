<?php 
error_reporting(E_ALL);ini_set('display_errors', '1');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../core/initialize.php');

$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category = $data->category;

if($post->insert()){
    echo json_encode(
        array('message' => 'Post inserted')
    );
}
else{
    echo json_encode(
        array('message' => 'Post not inserted')
    );
}