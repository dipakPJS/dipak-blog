<?php

session_start();

require '../includes/autoload.inc.php';

$deletePost = new DatabasePost();

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    /* ======= */

    if ($_SESSION['user_id'] !== $posts['user_id']) {
        header('location: http://localhost/clean-blog/index.php');
    }

    $deletePost->deleteImage($id);

    foreach ((array) $deletePost->deleteImage($id) as $posts) {
        unlink('images/'.$posts['img'].'');
    }

    $deletePost->deletePost($id);
} else {
    header('location: http://localhost/clean-blog/404.php');
}
