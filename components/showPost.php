<section class="postPage">
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $connection = mysqli_connect("localhost", "root", "", "blog");
        if(isset($_GET['action']) && isset($_GET['comment']) && $_GET['action'] == 'deleteComment'){
            $deleteCommentQuery = "delete from comments where id=".$_GET['comment'].";";
            mysqli_query($connection, $deleteCommentQuery);
            $location = 'Location: index.php?strona=posts&operation=showPost&id='.$_GET['id'].'';
            header($location);
        }
        $getPost = "SELECT `posts`.`title`, `posts`.`contents`, `posts`.`date`, `users`.`username` AS `owner`, count(`comments`.`comment`), `images`.`route`, `images`.`alt`
                        FROM `posts` 
                            LEFT JOIN `users` ON `posts`.`owner` = `users`.`id` 
                            LEFT JOIN `comments` ON `comments`.`owner` = `users`.`id` 
                            LEFT JOIN `images` ON `images`.`owner` = `users`.`id`
                    WHERE `posts`.`id` = '1';";
        $getPostImages = 'SELECT route, alt from images where post = ' . $_GET['id'] . ';';
        $getPost = 'SELECT posts.title, posts.contents, posts.date, users.username AS owner FROM posts LEFT JOIN users ON posts.owner = users.id WHERE posts.id = ' . $_GET['id'] . ';';
        $getComments = 'SELECT comments.id, comments.comment, users.username AS owner FROM comments LEFT JOIN users ON comments.owner = users.id WHERE comments.post = ' . $_GET['id'] . ';';
        $getPostImagesResponse = mysqli_query($connection, $getPostImages);
        $getPostResponse = mysqli_query($connection, $getPost);
        $getCommentsResponse = mysqli_query($connection, $getComments);
        $post = mysqli_fetch_array($getPostResponse);

        echo '<h1>' . $post['title'] . '</h1>
        <p class="postPageDetails">Autor: ' . $post['owner'] . ', Dodano: ' . $post['date'] . '</p>';
        while ($image = mysqli_fetch_array($getPostImagesResponse)) {
            echo '<img src="' . $image['route'] . '" alt="' . $image['alt'] . '">';
        }

        echo '<p class="postPageContent">' . $post['contents'] . '</p>';

        if (isset($_SESSION['username'])) {
            echo '<h2>Dodaj komentarz</h2>
            <form action="index.php?strona=posts&operation=showPost&id=' . $_GET['id'] . '" method="post">
            <textarea name="newComment" id="newComment" cols="60" rows="3"></textarea>
            <input class="button" type="submit" value="Dodaj Komentarz">
            </form>';
        }

        echo '<h2 class="komentarze">Komentarze</h2>';

        while ($comment = mysqli_fetch_array($getCommentsResponse)) {
            echo '<div class="komentarz"><h3>' . $comment['owner'] . '</h3><p>' . $comment['comment'] . '</p>';
            if(isset($_SESSION['username']) && isset($_SESSION['admin']))
            echo '<a class="" href="index.php?strona=posts&operation=showPost&id='.$_GET['id'].'&action=deleteComment&comment=' . $comment['id'] . '"><button class="button btnRed btnDelete">Usuń komentarz</button></a>';
            echo '</div>';
        }
    }
    ?>

</section>