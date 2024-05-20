<?php
class Post{
    private $id;
    private $author;
    private $title;
    private $timestamp;
    private $imgUrl;

    public function __construct(int $id, string $author, string $title, string $timestamp, string $imgUrl)
    {
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;  
        $this->timestamp = $timestamp;
        $this->imgUrl = $imgUrl;

    } 
    public function GetTitle() : string{
        return $this->title;
    }

    public function GetAuthor() : string{
        return "";
    }
    
    public function GetAuthorEmail() : string {
        return "";
    }
    public function GetImageUrl() : string{
        return $this->imgUrl;
    }
    public function GetTimestamp() : string{
        return $this->timestamp;
    }

    static function fetchPosts() : array {
        $db = new mysqli('localhost', 'root', '', 'breaddit');
        $sql = "SELECT post.id, post.title, post.timestamp, post.image, user.login AS author
        from post
        INNER JOIN user ON user.id = post.author
        ORDER BY timestamp DESC
        LIMIT 10";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        $posts = [];
        while($row = $result->fetch_assoc()) {
            $post = new Post($row['id'], $row['author'], $row['title'], $row['timestamp'], $row['image']);
            $posts[] = $post;
        }
        return $posts;
    }
    static function CreatePost(string $title, string $description) : bool {
        $postTitle = $_POST['postTitle'];
        $postDescription = $_POST['postDescription'];
        $targetDirectory = "img/";
        //$fileName = $_FILES['file']['name'];
        // sha256
        $fileName = hash('sha256', $_FILES['file']['name'].microtime());
        //move_uploaded_file($_FILES['file']['tmp_name'], $targetDirectory.$fileName);

        $fileString = file_get_contents($_FILES['file']['tmp_name']);

        $gdImage = imagecreatefromstring($fileString);

        $finalUrl = "http://localhost/cms/img/".$fileName.".webp";
        $internalUrl = "img/".$fileName.".webp";

        imagewebp($gdImage, $internalUrl);

        $authorID = 1;

        $db = new mysqli('localhost', 'root', '', 'breaddit');
        $q = $db->prepare("INSERT INTO post (author, image, title) VALUES (?, ?, ?)");
        $q->bind_param("iss", $authorID, $image, $Title);
        if($q->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>