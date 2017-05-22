<?php
    include_once 'includes/ambassador.php';
//grab by index so not array anymore
    if ($action == "index") {
        echo $forum->displayCategories();
    }
    if ($action == "category") {
        echo $forum->displayTopicsByCategory($_GET['category']);
    }
    if ($action == "topics") {
        echo $forum->displayTopicReplies($_GET['category'], $_GET['topic'], $path[0]);
    }
?>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
