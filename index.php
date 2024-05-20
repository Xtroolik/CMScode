<?php
require_once('class/user.class.php');
require_once('class/post.class.php');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>breaddit</h1>
    </header>

    <div id="login">
    <a>Nawigacja</a>
            <?php if(User::isLogged()) : ?>
                <!-- zalogowany -->
                <a href="profile.php">
                    <button>
                        Profil
                    </button>
                </a>
            <?php else: ?>
                <!-- nie zalogowany -->
                <a href="login.php">
                    <button>
                        Zaloguj się
                    </button>
                </a>
                <?php endif; ?>  
    </div>
    <div id="mid">
        <?php   
        $postList = Post::fetchPosts();
        foreach ($postList as $post) {
            echo '<div class="post">';
            echo '<h2 class="posttitle">'.$post->GetTitle().'</h2>';
            echo '<h3 class="postauthor">'.$post->GetAuthor().'</h3>';
            echo '<img src="'.$post->GetImageUrl().'" alt="obrazekposta" class=postimage>';
            echo '<p class=postdesc>Post Description </p>';
            echo '<div class="postfooter">
            <span class="postmeta">'.$post->GetTimestamp().'</span>
            <span class="postscore">POINTS</span>
                </div>';
        }
        ?>

    

        <!--<div class="post">
            <h3 class="posttitle">Title</h3>
            <h6 class="postauthor">Author</h6>
            <img src="https://picsum.photos/800/600" alt="" class="postimage">
            <p class="postdesc">Post Description</p>
            <div class="postfooter">
                <span class="postmeta">Date and time</span>
                <span class="postscore">+ / -</span>
            </div>
        </div>
        </div>
    -->
    </div>
</body>
</html>