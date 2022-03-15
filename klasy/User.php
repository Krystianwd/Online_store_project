<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of User
 *
 * @author student
 */
class User {

//put your code here
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;

    protected $username, $passwd, $fullName, $email, $date, $status;

    function __construct($username, $fullName, $email, $passwd) {
        $datetime = (new DateTime())->format("Y-m-d");
        $this->username = $username;
        $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
        $this->fullName = $fullName;
        $this->email = $email;
        $this->date = $datetime;
        $this->status = User::STATUS_USER;
    }

    public function show() {
        echo $this->username . " " . $this->fullName . " " . $this->email . " " . $this->status . " " . $this->date . " " . "</br>";
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPasswd() {
        return $this->passwd;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setUsername($username): void {
        $this->username = $username;
    }

    public function setPasswd($passwd): void {
        $this->passwd = $passwd;
    }

    public function setFullName($fullName): void {
        $this->fullName = $fullName;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setDate($date): void {
        $this->date = $date;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }

    function saveDB($db) {

     $sql = "INSERT INTO users (id,userName,fullName,email,passwd,status,date) VALUES (NULL,'$this->username','$this->fullName','$this->email','$this->passwd','$this->status','$this->date')";
     $db->insert($sql);
    }

    static function getallusersfromDB($bd) {
        echo $bd->select("select id,userName,fullName,email,passwd,status,date from users", ["id","userName","fullName","email","passwd","status","date"]);

    }
}
