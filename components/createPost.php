<form method="post" action="index.php?strona=posts&operation=showAll" enctype="multipart/form-data">
    <div class="forminputs">
        <div class="input-container">
            <input type="text" name="title" id="title" required />
            <label for="title">Tytuł</label>
        </div>
        <div class="big-input-container">
            <textarea type="text" name="content" id="content" required maxlength="2047"></textarea>
            <label for="content">Zawartość</label>
        </div>
        <input type="file" name="image" id="image" required>
        <input type="submit" value="Zapisz">
    </div>
</form>