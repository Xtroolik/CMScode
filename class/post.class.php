<?php
class Post{
    private $id;
    private $author;
    private $title;
    private $timestamp;
    private $imgUrl;

    public function __construct(int $id, int $author, string $title, string $timestamp, string $imgUrl)
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
        $sql = "SELECT * FROM post";
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        $posts = [];
        while($row = $result->fetch_assoc()) {
            $post = new Post($row['ID'], $row['Author'], $row['title'], $row['timestamp'], $row['imgUrl']);
            $posts[] = $post;
        }
        return $posts;
    }
}

?>