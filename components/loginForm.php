<form action="index.php" method="post" class="loginform">
    <h1>Zaloguj się do serwisu</h1>
    <div class="forminputs">
        <div class="input-container">
            <input type="text" name="username" id="username" required />
            <label for="username">Nazwa Użytkownika</label>
        </div>
    
        <div class="input-container">
            <input type="password" name="password" id="password" required />
            <label for="password">Hasło</label>
        </div>

        <p>Nie masz konta? <a href="index.php?strona=login&operation=register">Zarejestruj się</a></p>
        <input type="submit" value="ZALOGUJ">
    </div>
</form>