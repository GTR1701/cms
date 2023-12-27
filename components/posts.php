<section class="postButtons">
    <?php
    if (strpos($_SERVER['REQUEST_URI'], 'action=editPosts')) {
        echo '
        <a class="postButtonContainer" href="index.php?strona=posts&operation=showAll">
            <button class="button btnControl btnBlue">Edytuj posty</button>
        </a>';
    } else {
        echo '
        <a class="postButtonContainer" href="index.php?strona=posts&operation=showAll&action=editPosts">
            <button class="button btnControl btnBlue">Edytuj posty</button>
        </a>';
    }
    ?>
    <a class="postButtonContainer" href="index.php?strona=posts&operation=create">
        <button class="button btnControl btnGreen">Dodaj post</button>
    </a>
</section>

<?php
if (isset($_SESSION['username'])) {
    if (isset($_GET['count']))
        $counter = $_GET['count'];
    else
        $counter = 2;
    $posts = 5 * $counter;

    $connection = mysqli_connect("localhost", "root", "", "blog");
    $userQuery = "SELECT id from users where username = '" . $_SESSION['username'] . "';";
    $userResponse = mysqli_query($connection, $userQuery);
    $userId = mysqli_fetch_array($userResponse)['id'];
    $query = "SELECT * FROM posts where owner = '" . $userId . "' limit " . $posts . ";";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result)) {
        $commentQuery = "SELECT count(id) as comments from comments where post = " . $row['id'] . ";";
        $commentResponse = mysqli_query($connection, $commentQuery);
        $coverImageQuery = "SELECT route from images where post = " . $row['id'] . " && cover = 1;";
        $coverImageResponse = mysqli_query($connection, $coverImageQuery);
        $coverImage = mysqli_fetch_array($coverImageResponse)['route'];
        $commentRow = mysqli_fetch_array($commentResponse);
        $content = strlen($row['contents']) >= 256 ? substr($row['contents'], 0, 256) . '...' : $row['contents'];
        echo '<div class="postCard">';
        echo '<div class="left">';
        echo '<img src="' . $coverImage . '" alt="post image">';
        echo '</div>';
        echo '<div class="right">';
        echo '<a href="index.php?strona=posts&operation=showPost&id=' . $row['id'] . '"><h1>' . $row['title'] . '</h1></a>';
        echo '<p class="content">' . $content . '</p>';
        echo '<p class="author postDetails"><b>Autor:</b> ' . $_SESSION['username'] . '<b> Data: </b>' . $row['date'] . ' <b> Komentarze: </b> ' . $commentRow['comments'] . '</p>';
        echo '</div>';
        if (isset($_GET['action']) && $_GET['action'] == 'editPosts') {
            echo '<div class="postCardButtons">';
            echo '<a href="index.php?strona=posts&operation=edit&post=' . $row['id'] . '"><button class="button btnBlue author btnDelete">Edytuj post</button></a>';
            echo '<span></span>';
            echo '<a href="index.php?strona=posts&operation=showAll&action=delete&post=' . $row['id'] . '"><button class="button btnRed author btnDelete btnPostDelete">Usuń post</button></a>';
            echo '</div>';
        }
        echo '</div>';
    }

    if ((strpos($_SERVER['REQUEST_URI'], 'action=delete') && isset($userId) && isset($_GET['post']))) {
        $deleteQuery = "DELETE FROM posts WHERE id = " . $_GET['post'] . ";";
        mysqli_query($connection, $deleteQuery);
        header('Location: index.php?strona=posts&operation=showAll');
    }


    mysqli_close($connection);
}
?>

<form class="loadMoreForm" action="index.php?strona=posts&operation=showAll&count=<?php echo $counter++ ?>">
    <input class="loadMore" type="submit" value="Załaduj więcej">
</form>