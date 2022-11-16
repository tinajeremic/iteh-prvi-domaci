<?php

class User
{

    public $id;
    public $ime;
    public $prezime;
    public $datumRodj;
    public $pol;
    public $username;
    public $password;

    public function __construct($id=null,$ime=null, $prezime=null, $datumRodj=null, $pol=null, $username=null, $password=null)
    {   $this->id=$id;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->datumRodj = $datumRodj;
        $this->pol = $pol;
        $this->username = $username;
        $this->password = $password;
    }


    public function add(mysqli $conn){
        $querry = "INSERT INTO users (ime,prezime,datumRodj,pol,username,password) 
                 VALUES ('$this->ime','$this->prezime','$this->datumRodj','$this->pol','$this->username','$this->password');";
        return $conn->query($querry);
    }

    public function update(mysqli $conn){
        $querry = "UPDATE users set ime = '$this->ime',prezime = '$this->prezime',
                   datumRodj = '$this->datumRodj',pol = '$this->pol', username='$this->username',
                   password='$this->password'   WHERE id=$this->id";
        return $conn->query($querry);
    }

    public function delete(mysqli $conn){
        $querry = "DELETE FROM users WHERE id='$this->id'";
        return $conn->query($querry);
    }

    public static function getAll(mysqli $conn)
    {
        $querry = "SELECT * FROM users";
        return $conn->query($querry);
    }


    public static function getUser($id, mysqli $conn){
        $querry = "SELECT * FROM users WHERE id='$id'";

        $user = array();
        if($obj = $conn->query($querry)){
            while($red = $obj->fetch_array(1)){
                $user[]= $red;
            }
        }

        return $user;
    }
    public static function getUserUsername($username, mysqli $conn){
        $querry = "SELECT * FROM users WHERE username='$username'";

        $user = array();
        if($obj = $conn->query($querry)){
            while($red = $obj->fetch_array(1)){
                $user[]= $red;
            }
        }

        return $user;
    }


}