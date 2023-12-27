<?php
if (isset($_GET['operation'])) {
    $operation = $_GET['operation'];
    switch($operation) {
        case 'login':
            include('./components/loginForm.php');
            break;
        case 'register':
            include('./components/registerForm.php');
            break;
        case 'logout':
            session_destroy();
            header('Location: index.php?strona=home');
            break;
    }
}
?>