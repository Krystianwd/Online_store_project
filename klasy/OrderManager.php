<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderForm
 *
 * @author kryst
 */
class OrderManager {

    function dodajdoBD($bd, $userId) {
// pobierz dane z formularza, dokonaj ich walidacji
// jeśli dane są poprawne - sformułuj zapytanie $sql typu insert np.:
//  INSERT INTO klienci VALUES (NULL, 'Babacka', '22', 'Niemcy','bbbp@ollub.pl', 'Java,CPP', 'Przelew');
// i wywołaj metodę:
        $args = [
            'platforma' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'produkt' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' => FILTER_REQUIRE_ARRAY],
            'zaplata' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
//zdefiniuj pozostałe filtry
// . . .
        ];
//przefiltruj dane z GET/POST zgodnie z ustawionymi w $args filtrami:
        $dane = filter_input_array(INPUT_POST, $args);
//pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania:
        var_dump($dane);
//Sprawdź czy dane w tablicy $dane nie zawierają błędów walidacji:
        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
        }
        if ($errors === "") {
//Dane poprawne - zapisz do pliku
//wykorzystaj pomocniczą funkcję:
            $jezyk = "";
            foreach ($dane["produkt"] as $klucz => $wartosc) {
                $jezyk = $jezyk . $wartosc . ",";
            }
            $sql = "INSERT INTO `order` (orderId,userId,platform,product,payment) VALUES (NULL,$userId,'$dane[platforma]','$jezyk','$dane[zaplata]')";
            echo "$sql";
            $bd->insert($sql);
        } else {
            echo "<br>Nie poprawnie dane: " . $errors;
        }
    }

    function updateorder($bd, $userId) {
// pobierz dane z formularza, dokonaj ich walidacji
// jeśli dane są poprawne - sformułuj zapytanie $sql typu insert np.:
//  INSERT INTO klienci VALUES (NULL, 'Babacka', '22', 'Niemcy','bbbp@ollub.pl', 'Java,CPP', 'Przelew');
// i wywołaj metodę:
        $args = [
            'platforma' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'produkt' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' => FILTER_REQUIRE_ARRAY],
            'zaplata' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
//zdefiniuj pozostałe filtry
// . . .
        ];
//przefiltruj dane z GET/POST zgodnie z ustawionymi w $args filtrami:
        $dane = filter_input_array(INPUT_POST, $args);
//pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania:
        var_dump($dane);
//Sprawdź czy dane w tablicy $dane nie zawierają błędów walidacji:
        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
        }
        if ($errors === "") {
//Dane poprawne - zapisz do pliku
//wykorzystaj pomocniczą funkcję:
            $jezyk = "";
            foreach ($dane["produkt"] as $klucz => $wartosc) {
                $jezyk = $jezyk . $wartosc . ",";
            }
            //$sql = "INSERT INTO `order` (orderId,userId,platform,product,payment) VALUES (NULL,$userId,'$dane[platforma]','$jezyk','$dane[zaplata]')";
            $sql = "UPDATE `order` SET platform = '$dane[platforma]',product = '$jezyk',payment = '$dane[zaplata]' where userId = $userId";
            echo "$sql";
            $bd->insert($sql);
        } else {
            echo "<br>Nie poprawnie dane: " . $errors;
        }
    }

}
