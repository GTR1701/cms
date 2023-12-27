<?php
if (isset($_GET['operation'])) {
    $operation = $_GET['operation'];
    switch($operation) {
        case 'showAll':
            include('./components/posts.php');
            break;
        case 'create':
            include('./components/createPost.php');
            break;
        case 'edit':
            include('./components/editPost.php');
            break;
        case 'showPost':
            include('./components/showPost.php');
            break;
    }
}
?>