<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoggedIn
 *
 * @author kryst
 */
class LoggedIn {

    //put your code here
    function loggedInForm() {
        ?>
        <p>
        <form action="testLogin.php" method="post">
            <input type="submit" value="Kup Teraz" name="Kup" />
            <input type="submit" value="Sprawdź zamówienie" name="Sprawdz" />
            <input type="submit" value="Edytuj zamówienie" name="Edytuj" />
            <input type="submit" value="Usuń zamówienie" name="Usun" />
        </form>
        </p>
        <?php
    }

    function OrderForm() {
        ?>
        <form action="kupno.php" method="post">
            <h4>Wybierz produkt</h4
            <p>
                <?php
                $produkt = ["Standard Edition", "Deluxe Edition", "Seasson pass"];
                foreach ($produkt as $a) {
                    echo "<input name='produkt[]' type='checkbox' value='$a' />$a</br>";
                }echo '</br>'
                ?>
            <h4>Wybierz platformę</h4>
            <select name="platforma" id="platforma">
                <option value="PS4" >Playstation 4</option>
                <option value="PC">Steam PC</option>
                <option value="XONE">Xbox one</option>
            </select><br>
            <h4>Sposób zapłaty:</h4>
            <p><input name="zaplata" id="zaplata" type="radio" value="Master Card" />Master Card
                <input name="zaplata" type="radio" value= "Visa" />Visa
                <input name="zaplata" type="radio" value= "Przelew" />Przelew<br>
            <p>
                <input type="submit" value="Zamów" name="Zamow" />
                <input type="submit" value="Wroc" name="Wroc" />
        </form>
        <?php
    }
    function EditionForm() {
        ?>
        <form action="Edycja.php" method="post">
            <h4>Wybierz produkt</h4
            <p>
                <?php
                $produkt = ["Standard Edition", "Deluxe Edition", "Seasson pass"];
                foreach ($produkt as $a) {
                    echo "<input name='produkt[]' type='checkbox' value='$a' />$a</br>";
                }echo '</br>'
                ?>
            <h4>Wybierz platformę</h4>
            <select name="platforma" id="platforma">
                <option value="PS4" >Playstation 4</option>
                <option value="PC">Steam PC</option>
                <option value="XONE">Xbox one</option>
            </select><br>
            <h4>Sposób zapłaty:</h4>
            <p><input name="zaplata" id="zaplata" type="radio" value="Master Card" />Master Card
                <input name="zaplata" type="radio" value= "Visa" />Visa
                <input name="zaplata" type="radio" value= "Przelew" />Przelew<br>
            <p>
                <input type="submit" value="Potwierdz Edycje" name="Potwierdz" />
                <input type="submit" value="Wroc" name="Wroc" />
        </form>
        <?php
    }
}
