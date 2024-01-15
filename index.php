<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>CMS Dawid Kowal</title>
</head>

<body onload="generateInputs()">
    <?php
    session_start();
    //Logowanie
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $connection = mysqli_connect('localhost', 'root', '', 'blog');
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                if ($row['admin'] == 1) {
                    $_SESSION['admin'] = $row['admin'];
                }
            } else {
                header('Location: index.php?strona=login&operation=login&error=badUser');
            }
        } else {
            header('Location: index.php?strona=login&operation=login&error=badUser');
        }
        mysqli_close($connection);
    }
    //Rejestracja
    if (isset($_POST['newUsername']) && isset($_POST['newPassword'])) {
        $connection = mysqli_connect('localhost', 'root', '', 'blog');
        $newUsername = $_POST['newUsername'];
        $newPassword = $_POST['newPassword'];
        $checkIfUserExistsQuery = "SELECT * FROM users WHERE username='$newUsername'";
        $checkIfUserExistsResult = mysqli_query($connection, $checkIfUserExistsQuery);
        if (mysqli_num_rows($checkIfUserExistsResult) > 0) {
            header('Location: index.php?strona=login&operation=register&error=userexists');
        } else {
            $createUserQuery = "INSERT INTO users (username, password) VALUES ('$newUsername', '" . password_hash($newPassword, PASSWORD_BCRYPT) . "')";
            mysqli_query($connection, $createUserQuery);
            echo '<script>
                showAlert("Użytkownik utworzony pomyślnie")
            </script>';
        }
        mysqli_close($connection);
    }
    //Edytowanie posta
    if (isset($_POST['newTitle']) && isset($_POST['newContent']) && $_GET['id']) {
        $connection = mysqli_connect('localhost', 'root', '', 'blog');
        $updatePostQuery = 'update posts set title="' . $_POST['newTitle'] . '", contents="' . $_POST['newContent'] . '" where id=' . $_GET['id'] . ';';
        mysqli_query($connection, $updatePostQuery);
        header('Location: index.php?strona=posts&operation=showPost&id=' . $_GET['id'] . '');
        mysqli_close($connection);
    }
    ?>
    <header>
        <div class="navbar">
            <a href="index.php?strona=home&count=1">Home</a>
            <?php
            if (isset($_SESSION['admin'])) {
                echo '<a href="index.php?strona=cms">Admin Panel</a>';
            }
            if (isset($_SESSION['username'])) {
                echo '<a href="index.php?strona=posts&operation=showAll&count=1">Posty</a>';
                echo '<a href="index.php?strona=login&operation=logout">Wyloguj</a>';
            } else {
                echo '<a href="index.php?strona=login&operation=login">Zaloguj</a>';
            }
            ?>
        </div>
    </header>
    <?php
    if (isset($_GET['strona'])) {
        $strona = $_GET['strona'];
        switch ($strona) {
            case 'home':
                include('home.php');
                break;
            case 'omnie':
                include('omnie.php');
                break;
            case 'cms':
                include('cms.php');
                break;
            case 'login':
                include('./routers/loginPage.php');
                break;
            case 'posts':
                include('./routers/postsPage.php');
                break;
            default:
                include('home.php');
                break;
        }
    } else {
        include('home.php');
    }
    ?>
    <footer>Autor: Dawid Kowal</footer>

    <script>
        function showAlert(alertText) {
            alert(alertText);
        }

        function showErrorOnRegisterInput() {
            let usernameInput = document.getElementById('newUsername');
            let userError = document.getElementById('userError');
            usernameInput.style.borderBottom = '2px solid red';
            userError.innerHTML = 'Użytkownik o podanej nazwie już istnieje';
        }
        function showErrorOnLoginInput() {
            let usernameInput = document.getElementById('username');
            let passwordInput = document.getElementById('password');
            let userError = document.getElementById('userError');
            usernameInput.style.borderBottom = '2px solid red';
            passwordInput.style.borderBottom = '2px solid red';
            userError.innerHTML = 'Nieprawidłowa nazwa użytkownika lub hasło';
        }


        function generateInputs() {
            const inputs = document.querySelectorAll("input");
            const textareas = document.querySelectorAll("textarea")
            inputs.forEach((input) => {
                input.addEventListener("blur", (event) => {
                    if (event.target.value) {
                        input.classList.add("is-valid");
                    } else {
                        input.classList.remove("is-valid");
                    }
                });
            });
            textareas.forEach((textarea) => {
                textarea.addEventListener("blur", (event) => {
                    if (event.target.value) {
                        textarea.classList.add("is-valid");
                    } else {
                        textarea.classList.remove("is-valid");
                    }
                });
            });
        }
    </script>

    <?php
    //Błędy przy logowaniu i rejestracji
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        switch ($error) {
            case 'badUser':
                echo '<script>
                    showErrorOnLoginInput()
                </script>';
                break;
            case 'userexists':
                echo '<script>
                    showErrorOnRegisterInput()
                </script>';
        }
    }
    //Tworzenie posta
    if (isset($_POST['title']) && isset($_POST['content']) && isset($_FILES['image'])) {
        $connection = mysqli_connect('localhost', 'root', '', 'blog');
        $getUserQuery = "SELECT id from users where username = '" . $_SESSION['username'] . "';";
        $getUser = mysqli_query($connection, $getUserQuery);
        $owner = mysqli_fetch_array($getUser)['id'];

        $targetDir = './images/';
        $fileName = $_SESSION['username'] . date('U', time()) . '.' . pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION);
        $fileName = $targetDir . $fileName;

        $createPostQuery = 'INSERT INTO posts (`title`, `contents`, `date`, `owner`) VALUES ("' . $_POST['title'] . '", "' . $_POST['content'] . '", "' . date_format(date_create(), "Y-m-d H:i:s") . '", "' . $owner . '")';
        mysqli_query($connection, $createPostQuery);

        $countPostsQuery = 'SELECT id from posts order by id desc limit 1';
        $getPostNumber = mysqli_query($connection, $countPostsQuery);
        $postNumber = mysqli_fetch_array($getPostNumber)['id'];

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        $uploadImagesQuery = 'INSERT INTO images (`route`, `post`, `owner`, `cover`, `alt`) values ("' . $fileName . '", "' . $postNumber . '", "' . $owner . '", 1, "' . $_FILES['image']['name'] . '")';
        if ($check !== false) {
            mysqli_query($connection, $uploadImagesQuery);
            move_uploaded_file($_FILES['image']['tmp_name'], $fileName);
        }
        header('Location: index.php?strona=posts&operation=showAll');
        mysqli_close($connection);
    }
    //Dodawanie komentarza
    if (isset($_POST['newComment']) && isset($_GET['id'])) {
        $connection = mysqli_connect('localhost', 'root', '', 'blog');
        $getUserQuery = "SELECT id from users where username = '" . $_SESSION['username'] . "';";
        $getUser = mysqli_query($connection, $getUserQuery);
        $owner = mysqli_fetch_array($getUser)['id'];
        $addCommentQuery = 'insert into comments (comment, post, owner) values ("' . $_POST['newComment'] . '", ' . $_GET['id'] . ', ' . $owner . ')';
        mysqli_query($connection, $addCommentQuery);
        header('Location: index.php?strona=posts&operation=showPost&id=' . $_GET['id'] . '');
        mysqli_close($connection);
    }
    ?>

</body>

</html>