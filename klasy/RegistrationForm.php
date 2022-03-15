<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of RegistrationForm
 *
 * @author student
 */
//include 'Klasy/User.php';
//require_once 'Klasy/User.php';

class RegistrationForm {

    protected $user;

    function __construct() {
        ?>
        <h3>Formularz rejestracji</h3><p>
        <form action="rejestracja.php" method="post">
            Nazwa użytkownika: <br/><input name="userName"/><br/>
            Imie: <br/><input name="fullName"/><br/>
            Haslo: <br/><input name="passwd" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"/><br/>
            Email: <br/><input name="email" /><br/>
            <input type="submit" name="submit" value="Zapisz">
            <input type="submit" name="submit" value="Pokaz">
            <input type="reset" value="Anuluj">
        </form></p>
        <?php
    }

    function checkUser() { // podobnie jak metoda validate z lab4
        $args = [
            'userName' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'fullName' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'passwd' => ['filter' => FILTER_SANITIZE_SPECIAL_CHARS],
            'email' => ['filter' => FILTER_VALIDATE_EMAIL],
        ];
//przefiltruj dane:
        $dane = filter_input_array(INPUT_POST, $args);
        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
        }

        if ($errors === "") {
//Dane poprawne – utwórz obiekt user
            $this->user = new User($dane['userName'], $dane['fullName'],
                    $dane['email'], $dane['passwd']);
        } else {
            echo "<p>Błędne dane:$errors</p>";
            $this->user = NULL;
        }
        return $this->user;
    }

}
