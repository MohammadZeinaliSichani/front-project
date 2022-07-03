<?php
 
header("Content-Type: application/json");
require_once "posts.php";
 
if (empty($_POST['post_id'])) {
    die(json_encode(["msg" => "post id does not set", "status" => 0]));
}
 
if (!is_row_exits($_POST['post_id'])) {
    die(json_encode(["msg" => "post not found", "status" => 0]));
}
 
$posts_like = [];
$operation = "+";
 
if (!empty($_COOKIE['posts_like_list'])) {
 
    $posts_like = json_decode($_COOKIE['posts_like_list'], true);
 
    foreach ($posts_like as $post_like) {
        if ($_POST['post_id'] == $post_like) {
            $operation = "-";
            break;
        }
    }
 
} else {
    $posts_like[] = $_POST['post_id'];
}
 
$res = like_post($_POST['post_id'], $operation);
 
if ($res) {
 
    if ($operation == "-") {
        $array_key_like = array_search($_POST['post_id'], $posts_like);
        if ($array_key_like !== false) {
            unset($posts_like[$array_key_like]);
        }
 
    } else if ($operation == "+" && !empty($_COOKIE['posts_like_list'])) {
        $posts_like[] = $_POST['post_id'];
    }
 
    setcookie("posts_like_list", json_encode($posts_like), time() + 86400);
     
    $current_post_data = get_posts($_POST['post_id'])[0];
 
    echo json_encode(["msg" => "success" , "status" => 1 , "post_like" => $current_post_data['post_like'] , "post_id" => $current_post_data['id']]);
}else
    echo json_encode(["msg" => "something went wrong DB", "status" => 0]);
 
?>