<div class="center-div-home">
    <?php
    if (isset($_GET['count']))
        $counter = $_GET['count'];
    else
        $counter = 2;
    $posts = 5 * $counter;
    $connection = mysqli_connect("localhost", "root", "", "blog");
    $query = "SELECT posts.id, posts.contents, posts.date, posts.title, users.username as owner FROM posts inner join users on posts.owner=users.id limit " . $posts . ";";
    $result = mysqli_query($connection, $query);

    if ((strpos($_SERVER['REQUEST_URI'], 'action=delete') && isset($_GET['post']))) {
        $deleteQuery = "DELETE FROM posts WHERE id = " . $_GET['post'] . ";";
        $deleteImagesQuery = "DELETE from images where post = " . $_GET['post'] . ";";
        $deleteCommentsQuery = "DELETE from comments where post = " . $_GET['post'] . ";";
        mysqli_query($connection, $deleteCommentsQuery);
        mysqli_query($connection, $deleteImagesQuery);
        mysqli_query($connection, $deleteQuery);
        header('Location: index.php?strona=cms');
    }

    while ($row = mysqli_fetch_array($result)) {
        $commentQuery = "SELECT count(id) as comments from comments where post = '" . $row['id'] . "';";
        $commentResponse = mysqli_query($connection, $commentQuery);
        $coverImageQuery = "SELECT route, alt from images where post = " . $row['id'] . " && cover = 1;";
        $coverImageResponse = mysqli_query($connection, $coverImageQuery);
        $coverImage = mysqli_fetch_array($coverImageResponse);
        $commentRow = mysqli_fetch_array($commentResponse);
        $content = strlen($row['contents']) >= 256 ? substr($row['contents'], 0, 256) . '...' : $row['contents'];
        echo '<div class="postCard">';
        echo '<div class="left">';
        echo '<img src="' . $coverImage['route'] . '" alt="' . $coverImage['alt'] . '">';
        echo '</div>';
        echo '<div class="right">';
        echo '<a href="index.php?strona=posts&operation=showPost&id=' . $row['id'] . '"><h1>' . $row['title'] . '</h1></a>';
        echo '<p class="content">' . $content . '</p>';
        echo '<p class="author"><b>Autor:</b> ' . $row['owner'] . '<b> Data: </b>' . $row['date'] . ' <b> Komentarze: </b> ' . $commentRow['comments'] . '</p>';
        echo '</div>';
        echo '<div class="postCardButtons">';
        echo '<a href="index.php?strona=posts&operation=edit&post=' . $row['id'] . '"><button class="button btnBlue author btnDelete">Edytuj post</button></a>';
        echo '<span></span>';
        echo '<a href="index.php?strona=cms&action=delete&post=' . $row['id'] . '"><button class="button btnRed author btnDelete btnPostDelete">Usuń post</button></a>';
        echo '</div>';
        echo '</div>';
    }
    ?>
    <form class="loadMoreForm" action="index.php?strona=home&count=<?php echo $counter++ ?>">
        <input class="loadMore" type="submit" value="Załaduj więcej">
    </form>
</div>