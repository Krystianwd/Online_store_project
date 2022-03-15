<?php
class UserManager
{
    function loginForm()
    {
?>
        <h3>Formularz logowania</h3>
        (Musisz być zalogowany aby dokonać zakupu)
        <p>
            <form action="zaloguj.php" method="post">
                <span>Login</span>
                <input type="text" id="login" name="login" placeholder="login">
                <br>
                <span>Hasło</span>
                <input type="password" id="passwd" name="passwd" placeholder="hasło">
                <br>
                <input type="submit" value="Zaloguj" name="zaloguj" />
                <input type="reset" value="Anuluj" name="anuluj" />
            </form>
        </p>
<?php
    }

    function login($db)
    {
        $args =
            [
                'login' => FILTER_SANITIZE_SPECIAL_CHARS,
                'passwd' => FILTER_SANITIZE_SPECIAL_CHARS
            ];
        $dane = filter_input_array(INPUT_POST, $args);
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "users");
        if ($userId >= 0) {
            session_start();
            $sql = "DELETE FROM logged_in_users WHERE userId='$userId'";
            $db->delete($sql);

            $date = new DateTime();
            $current_date = $date->format('Y-m-d H:i:s');

            $id_session = session_id();

            $sql = "INSERT INTO logged_in_users (sessionId, userId, lastUpdate) VALUES ('$id_session', '$userId', '$current_date')";
            $db->insert($sql);
        }
        return $userId;
    }

    function logout($db)
    {
        session_start();
        $id_session = session_id();

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();

        $sql = "DELETE FROM logged_in_users WHERE sessionId='$id_session'";
        $db->delete($sql);
    }

    function getLoggedInUser($db, $sessionId)
    {
        $userId = -1;
        $sql = "SELECT userId FROM logged_in_users where sessionId='$sessionId'";
        if ($result = mysqli_query($db->getMysqli(), $sql)) {
            $row0 = mysqli_fetch_assoc($result);
            $userId = $row0["userId"];
        }
        return $userId;
    }
}
?>