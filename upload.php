<?php
    require_once('class/post.class.php');
    require_once('class/user.class.php');
    session_start();
    if(!empty($_POST) && isset($_SESSION['user'])) {
        Post::CreatePost($_POST['postTitle'], $_POST['postDescription']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new post</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="postTitle">Post title: </label>
        <input type="text" name="postTitle" id="postTitle">
        <br>
        <label for="postDescription">Description: </label>
        <input type="text" name="postDescription" id="postDescription">
        <br>
        <label for="file">File: </label>
        <input type="file" name="file" id="file">
        <br>
        <input type="submit" value="Submit!">
    </form>
</body>
</html>