<form action="index.php" method="post" class="loginform">
    <h1>Zarejestruj się</h1>
    <div class="forminputs">
        <div class="input-container">
            <input type="text" name="newUsername" id="newUsername" required />
            <label for="newUsername">Nazwa Użytkownika</label>
        </div>
        <p id="userError"></p>
    
        <div class="input-container">
            <input type="password" name="newPassword" id="newPassword" required />
            <label for="newPassword">Hasło</label>
        </div>
        <p>Masz już konto? <a href="index.php?strona=login&operation=login">Zaloguj się</a></p>
        <input type="submit" value="ZAREJESTRUJ">
    </div>
</form>