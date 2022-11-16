<?php

class Uloga
{
    private $id;
    private $glumac;
    private $predstava_id;
    private $user_id;
    private $naziv;


    public function __construct($id=null, $glumac=null, $predstava_id=null, $user_id=null, $naziv=null)
    {
        $this->id = $id;
        $this->glumac = $glumac;
        $this->predstava_id = $predstava_id;
        $this->user_id = $user_id;
        $this->naziv = $naziv;
    }


    public function add(mysqli $conn){
        $upit = "INSERT INTO uloge (glumac,predstava_id,user_id,naziv) 
                 VALUES ('$this->glumac','$this->predstava_id','$this->user_id','$this->naziv');";
        return $conn->query($upit);
    }

    public function update(mysqli $conn){
        $upit = "UPDATE uloge set glumac = '$this->glumac',predstava_id = '$this->predstava_id',
                   user_id = '$this->user_id',naziv = '$this->naziv'  WHERE id=$this->id";
        return $conn->query($upit);
    }

    public function delete(mysqli $conn){
        $upit = "DELETE FROM uloge WHERE id='$this->id'";
        return $conn->query($upit);
    }

    public static function getAll(mysqli $conn)
    {
        $upit = "SELECT * FROM uloge";
        return $conn->query($upit);
    }


    public static function getUloga($id, mysqli $conn){
        $upit = "SELECT * FROM uloge WHERE id='$id'";

        $uloga = array();
        if($obj = $conn->query($upit)){
            while($red = $obj->fetch_array(1)){
                $uloga[]= $red;
            }
        }

        return $uloga;
    }
}