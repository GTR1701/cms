<?php
if (isset($_GET['post'])) {
    $pol = mysqli_connect('localhost', 'root', '', 'blog');
    $oldPostQuery = 'SELECT * from posts where id=' . $_GET['post'] . ';';
    $oldPostResponse = mysqli_query($pol, $oldPostQuery);
    $oldPost = mysqli_fetch_array($oldPostResponse);
    mysqli_close($pol);
    echo "<script>
            generateActiveInputs()
        </script>";
}
?>

<form method="post" action="index.php?strona=posts&operation=showPost&id=<?php echo $_GET['post']; ?>"
    enctype="multipart/form-data">
    <div class="forminputs">
        <div class="input-container">
            <input class="is-valid" type="text" name="newTitle" id="newTitle" value="<?php echo $oldPost['title']; ?>"
                required />
            <label for="newTitle">Tytuł</label>
        </div>
        <div class="big-input-container">
            <textarea class="is-valid" type="text" name="newContent" id="newContent" maxlength="2047" required>
                <?php echo $oldPost['contents']; ?>
            </textarea>
            <label for=" newContent">Zawartość</label>
        </div>
        <input type="submit" value="Zapisz">
    </div>
</form>