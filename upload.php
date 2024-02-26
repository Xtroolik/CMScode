<?php
    if(!empty($_POST)) {
        $postTitle = $_POST['postTitle'];
        $postDescription = $_POST['postDescription'];
        $targetDirectory = "img/";
        $fileName = $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory.$fileName);
        $authorID = 1;
        $image = "http://localhost/cms/img/".$fileName;

        $db = new mysqli('localhost', 'root', '', 'breaddit');
        $q = $db->prepare("INSERT INTO post (author, image, title) VALUES (?, ?, ?)");
        $q->bind_param("iss", $authorID, $image, $postTitle);
        $q->execute();
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